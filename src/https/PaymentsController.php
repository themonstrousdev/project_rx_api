<?php

namespace Increment\Finance\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use Increment\Finance\Models\Ledger;

class PaymentsController extends APIController
{
    //
    function __construct(){
        $this->model = new Payments();
        // $this->notRequired = array(
        //     'name', 'address', 'prefix', 'logo', 'website', 'email'
        // );
      }
    public function payByCreditCard(){

    }
    public function payByGCash(){

    }
    public function payByCOD(){

    }
    public function payByCOP(){

    }
    public function payByPaymaya(){
      
    }

}