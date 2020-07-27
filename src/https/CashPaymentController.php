<?php

namespace Increment\Finance\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use Increment\Finance\Models\CashPayment;

class CashPaymentController extends APIController
{
    function __construct(){
        $this->model= new CashPayment();
    }

    public function generateCode(){
        $code = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 32);
        $codeExist = CashPayment::where('id', '=', $code)->get();
        if(sizeof($codeExist) > 0){
          $this->generateCode();
        }else{
          return $code;
        }
    }
    
    public function addPayment(Request $request){
        $data = $request->all();
        $data["code"] = $this->generateCode();
        $data["status"] = "PENDING";
        $this->model = new CashPayment();
        $this->insertDB($data);
        return $this->response();
    }

    public function retrieveByCode(Request $request){
        $entry = CashPayment::where('code', $request["code"])->get();
        return $entry;
    }

    public function updateStatus(Request $request){
        $data = $request->all();
        $entry = $this->retrieveByCode($request);
        //TODO: Update DB once retrieved. Clarify if update value is from front-end.
    }
}