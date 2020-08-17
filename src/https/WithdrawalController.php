<?php

namespace Increment\Finance\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use Increment\Finance\Models\Withdrawal;
class WithdrawalController extends APIController
{
  function __construct(){
    $this->model = new Withdrawal();
    if($this->checkAuthenticatedUser() == false){
      return $this->response();
    }
    $this->localization();
    $this->notRequired = array(
      'notes'
    );
  }

}