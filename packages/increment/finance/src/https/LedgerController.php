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
}
