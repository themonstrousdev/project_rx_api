<?php

namespace Increment\Finance\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use Increment\Finance\Models\Ledger;
use Increment\Common\Image\Models\Image;
use Increment\Imarket\Cart\Models\Checkout;

class LedgerController extends APIController
{
    //
    function __construct(){
        $this->model = new Ledger();
        // $this->notRequired = array(
        //     'name', 'address', 'prefix', 'logo', 'website', 'email'
        // );
      }
    
    public function generateCode(){
      $code = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 32);
      $codeExist = Ledger::where('id', '=', $code)->get();
      if(sizeof($codeExist) > 0){
        $this->generateCode();
      }else{
        return $code;
      }
    }

<<<<<<< HEAD
    public function addEntry($data){
      $amount = Checkout::select("total")->where("id", $data["checkout_id"])->get();
      $entry = array();
      $entry["payment_payload"] = $data["payment_payload"];
      $entry["payment_payload_value"] = $data["payment_payload_value"];
      $entry["code"] = $this->generateCode();
      $entry["account_id"] = $data["account_id"];
      $entry["account_code"] = $data["account_code"];
      $entry["description"] = $data["status"];
      $entry["currency"] = $data["currency"];
      $entry["amount"] = $amount[0]["total"];
      $this->model = new Ledger();
      $this->insertDB($entry);
      return $this->response();
    }

    public function retrieve(Request $request){
      //grabs by code
      //TODO: add security check for admin to grab bulk data
      //returns only one because of code constraint
      $result = Ledger::select("ledgers.*", "merchants.account_id AS merchant_id", "merchants.name")
        ->where("ledgers.code",$request["code"])
        ->leftJoin('merchants', 'ledgers.account_id', "=", "merchants.account_id")
        ->get();
      $result[0]["logo"] = Image::select()
      ->where("account_id", $result[0]["merchant_id"])
      ->get();
      return $result;      
    }

    public function retrieveForMerchant(Request $request){
      $data = $request->all();
      $result = Ledger::select()
      ->where("ledgers.account_code", $data["code"])
      ->leftJoin("cash_methods", "ledgers.payment_payload_value", "=", "cash_methods.code")
      ->limit($request['limit'])
      ->offset($request['offset'])
      ->get();
      return $result;
    }

    public function retrieveByID(Request $request){
      //retrieves ledger entry by ID and passes ledger and merchant info
        $result = Ledger::select("ledgers.id AS ledger", "ledgers.code AS ledgerc", "ledgers.created_at AS ledger_created", "ledgers.updated_at AS ledger_updated", "ledgers.*", "merchants.*")
=======
    public function retrieveByCode(Request $request){
      $result = Ledger::select()
        ->where("ledgers.code",$request["code"])
        ->leftJoin('merchants', 'ledgers.account_id', "=", "merchants.account_id")
        ->get();
      return $result;      
    }

    public function retrieveByID(Request $request){
        $result = Ledger::select()
>>>>>>> 8abffd811a5867e3374cfcad7bd0c35bab4bf52d
        ->where("ledgers.id",$request["id"])
        ->leftJoin('merchants', 'ledgers.account_id', "=", "merchants.account_id")
        ->get();
      return $result; 
    }
}
