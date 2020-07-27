<?php

namespace Increment\Finance\Models;

use Illuminate\Database\Eloquent\Model;
use App\APIModel;

class CashPayment extends APIModel
{
    protected $table = 'cash_methods';
    protected $fillable = ['payload', 'checkout_id', 'rider', 'status'];
}