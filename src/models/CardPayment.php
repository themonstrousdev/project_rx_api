<?php

namespace Increment\Finance\Models;

use Illuminate\Database\Eloquent\Model;
use App\APIModel;

class CardPayment extends APIModel
{
    protected $table = 'card_methods';
    protected $fillable = ['account_id', 'account_code', 'last4', 'token', 'bank_name'];
}