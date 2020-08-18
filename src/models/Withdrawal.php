<?php

namespace Increment\Finance\Models;

use Illuminate\Database\Eloquent\Model;
use App\APIModel;

class Withdrawal extends APIModel
{
    protected $table = 'withdrawals';
    protected $fillable = ['code', 'account_id', 'account_code', 'payment_payload', 'payment_payload_value', 'amount', 'currency', 'notes', 'status'];

    public function getAccountIdAttribute($value){
      return intval($value);
    }
}
