<?php

namespace Increment\Finance\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use Increment\Finance\Models\Ledger;

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

    public function retrieveByCode(Request $request){
      $result = Ledger::select()
        ->where("ledgers.code",$request["code"])
        ->leftJoin('merchants', 'ledgers.account_id', "=", "merchants.account_id")
        ->get();
      return $result;      
    }

    public function retrieveByID(Request $request){
        $result = Ledger::select()
        ->where("ledgers.id",$request["id"])
        ->leftJoin('merchants', 'ledgers.account_id', "=", "merchants.account_id")
        ->get();
      return $result; 
    }
}
