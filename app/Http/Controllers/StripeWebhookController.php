<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sig     = $request->server('HTTP_STRIPE_SIGNATURE');
        $secret  = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent($payload, $sig, $secret);
        } catch (\Throwable $e) {
            return response('Invalid', 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object; // \Stripe\Checkout\Session
            // TODO: créer/mettre à jour la commande en BDD et marquer "paid"
            Log::info('Stripe paid', ['session' => $session->id, 'amount' => $session->amount_total]);
        }

        return response('OK', 200);
    }
}
