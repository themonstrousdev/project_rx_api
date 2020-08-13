<?php

namespace Increment\Finance\Models;

use Illuminate\Database\Eloquent\Model;
use App\APIModel;

class Ledger extends APIModel
{
    protected $table = 'ledgers';
    protected $fillable = ['account_id', 'payload', 'payload_value', 'status', 'url'];

    public function getAccountIdAttribute($value){
      return intval($value);
    }

}

