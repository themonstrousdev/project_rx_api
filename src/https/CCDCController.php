<?php

namespace Increment\Finance\Http;

use Illuminate\Http\Request;
use Luigel\Paymongo\Facades\Paymongo;
use App\Http\Controllers\APIController;
use Increment\Finance\Models\Ledger;
use Increment\Common\Image\Models\Image;
use Increment\Imarket\Cart\Models\Checkout;
use Increment\Finance\Models\CardPayment;


class CCDCController extends APIController
{
    //
    function __construct(){
        $this->model = new CardPayment();
        // $this->notRequired = array(
        //     'name', 'address', 'prefix', 'logo', 'website', 'email'
        // );
    }

    public function createPaymentMethod($details){
        $paymentMethod = Paymongo::paymentMethod()->create([
            'type' => 'card',
            'details' => [
                'card_number' => $details['card_number'],
                'exp_month' => $details['exp_month'],
                'exp_year' => $details['exp_year'],
                'cvc' => $details['cvc'],
            ],
            'billing' => [
                'address' => [
                    'line1' => $details['line1'],
                    'city' => $details['city'],
                    'state' => $details['state'],
                    'country' => $details['country'],
                    'postal_code' => $details['postal_code'],
                ],
                'name' => $details['name'],
                'email' => $details['email'],
                'phone' => $details['phone']
            ],
        ]);
        return ($paymentMethod->getData());
    }
 
    public function createPaymentIntent($details){
        $paymentIntent = Paymongo::paymentIntent()->create([
            'amount' => $details['amount'],
            'payment_method_allowed' => [
                'card'
            ],
            'payment_method_options' => [
                'card' => [
                    'request_three_d_secure' => 'automatic'
                ]
            ],
            'description' => $details['description'],
            'statement_descriptor' => $details['descriptor'],
            'currency' => $details['currency'],
        ]);
        return ($paymentIntent->getData());
    }

    public function payByCreditCard(Request $request){
        $details = $request->all();
        $payables = $this->createPaymentIntent($details);
        $mop = $this->createPaymentMethod($payment);
        $paymentIntentId = $payables['id'];
        $paymentMethodId = $mop['id'];
    }
}