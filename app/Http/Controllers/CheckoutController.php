<?php

namespace App\Http\Controllers;

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
    public function success()
    {
        $order = session('checkout.last_order');
        if (!$order) {
            return redirect()->route('checkout.index');
        }
        return view('checkout', [
            'step'   => 4,
            'order'  => $order,
            'cart'   => [], // vide
            'totals' => ['subtotal' => 0, 'total' => 0],
            'shipping' => $order['shipping'] ?? null,
        ]);
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

