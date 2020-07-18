<?php

namespace Increment\Finance\Models;

use Illuminate\Database\Eloquent\Model;
use App\APIModel;

class Ledger extends APIModel
{
    //
    protected $table = "ledgers";
    protected $fillable = ["code", "account_id", "amount", "description", "currency"];
}
