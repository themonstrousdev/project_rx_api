<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use Increment\Imarket\Checkout\Models\Checkout;
use Increment\Imarket\Product\Models\Product;
use Increment\Imarket\Cart\Models\Cart;
use Carbon\Carbon;

class DashboardController extends APIController
{
    //
    public function getMenu(Request $request){
        //$user = app('Increment\Account\Http\AccountProfileController')->getAccountProfile($id);
        //TODO: function should support pagination, current function call below returns first product in said criteria
        $products = app('Increment\Imarket\Product\Http\ProductController')->retrieve($request);
        return $products;
        //TODO: assess products for listing

    }

    public function promotionItems(Request $request){
         
    }

}
