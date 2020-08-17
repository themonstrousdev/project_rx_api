<?php

namespace Increment\Finance\Http;

use Illuminate\Http\Request;
use Stripe\PaymentIntent;
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
    

    public function retrievePaymentMethods(Request $request){
      $client = new \Adyen\Client();
      $client->setXApiKey("AQEjhmfuXNWTK0Qc+iSFoUcchM2oZbT2WRT8TN64AFhnWv8f4XEQwV1bDb7kfNy1WIxIIkxgBw==-jPVsG+S8dpnh4rHFop6N+P9WVptl2njWPRrsgBSg6VE=-BZw.I3]dnUY(VZa3");
      $client->setEnvironment(\Adyen\Environment::TEST);
      $service = new \Adyen\Service\Checkout($client);
      $params = array(
        "merchant_account" => "Company.USCDCISM",
        "country_code" => "PH",
        "amount" => array(
          "currency" => "PHP",
          "value" => 50000
        ),
        "channel" => "Web"
      );
      $result = $service->paymentMethods($params);
      return $result;
    }
    //   //integration using Stripe
    //   //tell frontend
    // public function createIntent(Request $request){
    //     \Stripe\Stripe::setApiKey('sk_test_51HA4X8JX9GMwJlz6Jx8onRvYYEeP5cxgZDkJHbeglmgnZFNjkSjYB3mh0Ac0f95g9r2pcqY7cMJSm0Oz0AvyZyS700aBw2qyDN');
    //     $paymentIntent = PaymentIntent::create([
    //         'amount' => 50000,
    //         'currency' => $request["currency"]
    //     ]);
    //     return $paymentIntent->id;
    // }
    // public function retrieveIntent(Request $request){
    //     \Stripe\Stripe::setApiKey('sk_test_51HA4X8JX9GMwJlz6Jx8onRvYYEeP5cxgZDkJHbeglmgnZFNjkSjYB3mh0Ac0f95g9r2pcqY7cMJSm0Oz0AvyZyS700aBw2qyDN');
    //     $paymentIntent = PaymentIntent::retrieve([
    //         'id' => $request["code"]
    //     ]);
    //     return $paymentIntent;
    // }

    // public function generateCode(){
    //     $code = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 32);
    //     $codeExist = Ledger::where('id', '=', $code)->get();
    //     if(sizeof($codeExist) > 0){
    //       $this->generateCode();
    //     }else{
    //       return $code;
    //     }
    //   }

    // public function createEntry(Request $request){
    //     $data = $request->all();
    //     $this->model = new CardPayment();
    //     $this->insertDB($data);
    //     $data["payment_payload"] = $data["payload"];
    //     $data["payment_payload_value"] = $data["code"];
    //     //TODO: Once payment added, add entry to ledger
    //     $test = app('Increment\Finance\Http\LedgerController')->addEntry($data);
    //     $test = $test->getData();
    //     $idfrominsert = new Request();
    //     $idfrominsert["id"] = $test->{"data"};
    //     $code = app('Increment\Finance\Http\LedgerController')->retrieveByID($idfrominsert);
    //     return $code;
    // }
}