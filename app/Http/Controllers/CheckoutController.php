<?php

namespace App\Http\Controllers;
use Illuminate\Support\Arr;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        // Récupérer le panier depuis localStorage (côté client) ou session
        $cart = session()->get('cart', []);
        $totals = $this->totals($cart);
        return view('checkout', compact('cart', 'totals'));
    }




    public function process(Request $request)
    {
        // Exemple de traitement (paiement fictif ici)
        session()->forget('cart'); // vide le panier après commande
        return redirect()->route('home')->with('success', 'Paiement effectué avec succès !');
    }




public function createStripeCheckout(Request $request)
{
    $cart = session('cart', []);
    if (empty($cart)) return back()->with('error', 'Panier vide.');

    $currency = strtolower(session('checkout.currency', 'eur'));

    $lineItems = [];
    foreach ($cart as $it) {
        $unitAmount = (int) round(((float)($it['price'] ?? 0)) * 100);
        $name = (string) Arr::get($it, 'name', 'Article');
        $qty  = max(1, (int) Arr::get($it, 'qty', 1));

        $lineItems[] = [
            'price_data' => [
                'currency' => $currency,
                'product_data' => ['name' => mb_substr($name, 0, 120)],
                'unit_amount' => $unitAmount,
            ],
            'quantity' => $qty,
        ];
    }

    $stripe = new StripeClient(config('services.stripe.secret'));
    $session = $stripe->checkout->sessions->create([
        'mode'        => 'payment',
        'line_items'  => $lineItems,
        'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url'  => route('checkout.cancel'),
'customer_email' => optional(Auth::user())->email, // null si pas connecté

        'metadata'    => ['order_ref' => 'KELU-' . now()->format('YmdHis')],
    ]);

    return redirect()->away($session->url);
}



    /** Synchroniser le panier depuis localStorage */
    public function syncCart(Request $request)
    {
        $cartData = $request->input('cart', []);
        session(['cart' => $cartData]);

        return response()->json(['success' => true]);
    }

    /** Mise à jour du panier (quantités / suppression) */
    public function updateCart(Request $r)
    {
        $cart = collect(session('cart', []));

        // Suppression ligne ?
        if ($r->filled('remove')) {
            $id = (string) $r->input('remove');
            $cart = $cart->reject(function($it) use ($id) {
                return (string)$it['id'] === $id;
            })->values();
        }

        // Mise à jour quantités ?
        foreach ((array) $r->input('qty', []) as $id => $qty) {
            $qty = max(0, (int)$qty);
            $cart = $cart->map(function ($it) use ($id, $qty) {
                if ((string)$it['id'] === (string)$id) {
                    $it['qty'] = $qty;
                }
                return $it;
            })->filter(function($it) {
                return $it['qty'] > 0;
            })->values();
        }

        session(['cart' => $cart->all()]);
        return redirect()->route('checkout.index');
    }

    /** Étape 2 -> sauvegarde livraison puis redirige paiement */
    public function saveDelivery(Request $r)
    {
        $data = $r->validate([
            'name'         => 'required|string|max:120',
            'address'      => 'required|string|max:255',
            'city'         => 'required|string|max:120',
            'zip'          => 'required|string|max:20',
            'country'      => 'required|string|max:2',
            'phone'        => 'required|string|max:40',
            'instructions' => 'nullable|string|max:500',
        ]);
        session(['checkout.delivery' => $data]);
        session(['checkout.currency' => $this->currencyForCountry($data['country'])]);

        return redirect()->route('checkout.payment');
    }

    /** Étape 3 : paiement */
    public function payment()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('checkout.index');
        }
        $totals = $this->totals($cart);
        return view('checkout', [
            'step'   => 3, // on sautera l’affichage de l’étape 2 via la vue
            'cart'   => $cart,
            'totals' => $totals,
            'shipping' => session('checkout.delivery', null),
        ]);
    }

    /** Étape 3 -> place la commande (paiement simulé) */
    public function place(Request $r)
    {
        $r->validate([
            'payment_method' => 'required|in:card,paypal,cod',
            'terms'          => 'accepted'
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('checkout.index');
        }

        $delivery = session('checkout.delivery');
        if (!$delivery) {
            return redirect()->route('checkout.index');
        }

        $totals = $this->totals($cart);

        // Ici tu peux créer une Order réelle en DB si tu as le modèle/migration.
        // Pour rester "simple Laravel", on stocke juste en session :
        $order = [
            'number'   => 'CMD-' . now()->format('Ymd-His'),
            'date'     => now(),
            'total'    => $totals['total'],
            'subtotal' => $totals['subtotal'],
            'payment'  => $r->payment_method,
            'items'    => $cart,
            'shipping' => $delivery,
        ];
        session(['checkout.last_order' => $order]);

        // vider le panier
        session()->forget('cart');

        return redirect()->route('checkout.success');
    }

    /** Étape 4 : confirmation */
public function success(Request $request)
{
    $sessionId = $request->query('session_id');

    // Cas non-Stripe (ex: paiement à la livraison)
    if (!$sessionId) {
        $order = session('checkout.last_order');
        if ($order) {
            return view('checkout', [
                'step'     => 4,
                'order'    => $order,
                'cart'     => [],
                'totals'   => ['subtotal' => 0, 'total' => 0],
                'shipping' => $order['shipping'] ?? null,
            ]);
        }
        return redirect()->route('checkout.index');
    }

    // ✅ Vérification côté serveur de la session Checkout
    try {
        $stripe  = new \Stripe\StripeClient(config('services.stripe.secret'));
        $session = $stripe->checkout->sessions->retrieve($sessionId, [
            'expand' => ['payment_intent', 'customer']
        ]);
    } catch (\Throwable $e) {
        // Mauvaise clé, réseau, id invalide, etc.
        return redirect()->route('checkout.index')->with('error', 'Erreur Stripe: '.$e->getMessage());
    }

    if ($session && $session->payment_status === 'paid') {
        // Ici tu marques la commande comme payée (DB idéalement)
        session()->forget('cart');

        $order = [
            'number'   => $session->metadata->order_ref ?? ('CMD-' . now()->format('Ymd-His')),
            'date'     => now(),
            'total'    => ($session->amount_total ?? 0) / 100,
            'payment'  => 'stripe',
            'shipping' => session('checkout.delivery'),
        ];
        session(['checkout.last_order' => $order]);

        return view('checkout', [
            'step'     => 4,
            'order'    => $order,
            'cart'     => [],
            'totals'   => ['subtotal' => $order['total'], 'total' => $order['total']],
            'shipping' => $order['shipping'] ?? null,
        ]);
    }

    return redirect()->route('checkout.index')->with('error', 'Paiement non confirmé.');
}


public function handle(Request $request)
{
    $payload = $request->getContent();
    $sig     = $request->header('Stripe-Signature');
    $secret  = config('services.stripe.webhook_secret'); // via services.php

    try {
        $event = \Stripe\Webhook::constructEvent($payload, $sig, $secret);
    } catch (\Throwable $e) {
        return response('Invalid', 400);
    }

    if ($event->type === 'checkout.session.completed') {
        /** @var \Stripe\Checkout\Session $session */
        $session = $event->data->object;

        // TODO: retrouver ta commande via $session->metadata->order_ref (ou $session->id)
        // Puis marquer "paid", stock décrémenté, email, etc.
        // Exemple (pseudo) :
        // $order = Order::where('reference', $session->metadata->order_ref)->first();
        // $order->update([
        //   'status' => 'paid',
        //   'amount' => $session->amount_total / 100,
        //   'currency' => strtoupper($session->currency),
        //   'stripe_session_id' => $session->id,
        // ]);
    }

    return response('OK', 200);
}

private function currencyForCountry(string $iso2): string
{
    $iso2 = strtoupper($iso2);
    return match ($iso2) {
        'FR','BE','DE','ES','IT','NL','IE','PT','AT','FI','GR','LU' => 'eur',
        'GB' => 'gbp',
        'US' => 'usd',
        'CA' => 'cad',
        'CH' => 'chf',
        // Afrique de l’Ouest (UEMOA) : on facture en EUR côté compte FR
        'CI','SN','BJ','BF','ML','NE','TG' => 'eur',
        default => 'eur',
    };
}

public function cancel()
{
    return redirect()->route('checkout.index')->with('error', 'Paiement annulé.');
}


    /** petit helper de totaux */
    private function totals(array $cart): array
    {
        $sub = 0.0;
        foreach ($cart as $item) {
            $price = (float)($item['price'] ?? 0);
            $qty   = (int)($item['qty'] ?? 0);
            $sub += $price * $qty;
        }
        return ['subtotal' => $sub, 'total' => $sub]; // pas de frais ni coupon ici
    }
}

