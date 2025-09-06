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
    $subtotal = collect($cart)->sum(fn($i) => ((float)($i['price'] ?? 0)) * ((int)($i['qty'] ?? 0)));
    $shipping = 0.0;
    $tax = 0.0;
    $total = $subtotal + $shipping + $tax;

    // 1) Créer la commande "pending"
    $order = \App\Models\Order::create([
        'user_id'          => Auth::id(),                // <- plus de "\Auth"
        'number'           => 'CMD-'.now()->format('Ymd-His'),
        'status'           => 'pending',
        'currency'         => strtoupper($currency),
        'subtotal'         => $subtotal,
        'shipping'         => $shipping,
        'tax'              => $tax,
        'total'            => $total,
        'shipping_address' => session('checkout.delivery'),
        'payment_provider' => 'stripe',
    ]);

    // 2) Lignes Stripe (en centimes)
    $lineItems = [];
    foreach ($cart as $it) {
        $lineItems[] = [
            'price_data' => [
                'currency'     => $currency,
                'product_data' => ['name' => mb_substr((string)($it['name'] ?? 'Article'), 0, 120)],
                'unit_amount'  => (int) round(((float)($it['price'] ?? 0)) * 100),
            ],
            'quantity' => max(1, (int)($it['qty'] ?? 1)),
        ];
    }
foreach ($cart as $it) {
    $order->items()->create([
        'product_id' => $it['id'] ?? null,
        'name'       => $it['name'] ?? 'Article',
        'price'      => (float)($it['price'] ?? 0),
        'quantity'   => (int)($it['qty'] ?? 1),
        'meta'       => ['image' => $it['image'] ?? null], // si tu veux
    ]);
}

    $stripe  = new \Stripe\StripeClient(config('services.stripe.secret'));
    $session = $stripe->checkout->sessions->create([
        'mode'           => 'payment',
        'line_items'     => $lineItems,
        'success_url'    => route('checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url'     => route('checkout.cancel'),
        'customer_email' => Auth::user()?->email,        // <- plus de "\Auth"
        'metadata'       => ['order_id' => (string)$order->id, 'order_number' => $order->number],
    ]);

    $order->update(['stripe_session_id' => $session->id]);

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

    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');
        if (!$sessionId) {
            return redirect()->route('checkout.index');
        }

        try {
            $stripe  = new StripeClient(config('services.stripe.secret'));
            $session = $stripe->checkout->sessions->retrieve($sessionId, ['expand' => ['payment_intent']]);
        } catch (\Throwable $e) {
            return redirect()->route('checkout.index')->with('error', 'Référence Stripe invalide.');
        }

        // On cherche d’abord par l’ID de session
        $order = \App\Models\Order::where('stripe_session_id', $sessionId)->first();

        // Fallback : si non trouvée, on tente via metadata (au cas où)
        if (!$order && isset($session->metadata->order_id)) {
            $order = \App\Models\Order::find($session->metadata->order_id);
        }

        if (!$order) {
            return redirect()->route('checkout.index')->with('error', 'Commande introuvable.');
        }

        // Sécurité : si la commande est liée à un utilisateur, on s’assure que c’est bien lui
        if ($order->user_id && Auth::check() && $order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($session && $session->payment_status === 'paid') {
            // Idempotent : on ne re-fait rien si déjà “paid”
            if ($order->status !== 'paid') {
                $order->update([
                    'status'                => 'paid',
                    'stripe_payment_intent' => is_string($session->payment_intent)
                                                ? $session->payment_intent
                                                : ($session->payment_intent->id ?? null),
                    'paid_at'               => now(),
                    'total'                 => ($session->amount_total ?? ($order->total * 100)) / 100,
                    'currency'              => strtoupper($session->currency ?? $order->currency),
                ]);

                // ➜ Ici, c’est l’endroit idéal pour :
                // - décrémenter le stock
                // - envoyer l’email de confirmation
                // - notifier ton back-office
                // dispatch(new SendOrderConfirmation($order));
            }

            session()->forget('cart');

            return view('checkout', [
                'step'     => 4,
                'order'    => $order,
                'cart'     => [],
                'totals'   => ['subtotal' => $order->total, 'total' => $order->total],
                'shipping' => $order->shipping_address,
            ]);
        }

        // Si tu ajoutes des moyens “asynchrones” (SEPA, etc.), tu peux mettre la commande en “processing” ici.
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

