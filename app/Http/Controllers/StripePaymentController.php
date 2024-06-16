<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class StripePaymentController extends Controller
{

    public function stripe()
    {
        $product = Config::get('stripe.product');
        return view('stripe', compact('product'));
    }

    public function stripeCheckout(Request $request)
    {
        $stripe = new \Stripe\StripeClient(Config::get('stripe.stripe_secret_key'));

        $redirectUrl = route('stripe.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}';
        
        $line_items = [];

        foreach (session()->get('cart') as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency'     => 'eur',
                    'unit_amount'  => $item['price'] * 100,
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                ],
                'quantity' => $item['quantity']
            ];
        }

        $response =  $stripe->checkout->sessions->create([
            'success_url' => $redirectUrl,
            'payment_method_types' => ['link', 'card'],
            'line_items' => $line_items,

            'mode' => 'payment',
            'allow_promotion_codes' => false
        ]);


        return redirect($response['url']);
    }

    public function stripeCheckoutSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(Config::get('stripe.stripe_secret_key'));

        $session = $stripe->checkout->sessions->retrieve($request->session_id);
        info($session);

        $successMessage = "We have received your payment request and will let you know shortly.";

        return view('success', compact('successMessage'));
    }
}
?>