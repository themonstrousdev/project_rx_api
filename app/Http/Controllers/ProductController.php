<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use Increment\Imarket\Checkout\Models\Checkout;
use Increment\Imarket\Product\Models\Product;
use Increment\Imarket\Merchant\Models\Merchant;
use Increment\Imarket\Merchant\Models\Location;
use Increment\Common\Rating\Models\Rating;
use Increment\Imarket\Cart\Models\Cart;
use Carbon\Carbon;

class ProductController extends APIController
{
    protected $dashboard = array(      
        "data" => null,
        "error" => array(),// {status, message}
        "debug" => null,
        "request_timestamp" => 0,
        "timezone" => 'Asia/Manila'
    );
    
    public function retrieveByCategory(Request $request){
        //Data to be passed: category, limit
        $dashboardarr = [];
        $conditions = $request['condition'];
        foreach ($conditions as $condition){
            $modifiedrequest['condition'] = [$condition];
            $modifiedrequest['limit'] = $request['limit'];
            //manual query without raw query;
            $result = Product::select('products.account_id','products.merchant_id','products.status','products.category', 'locations.latitude', 'locations.longitude', 'locations.route')->leftJoin('locations', 'products.account_id',"=","locations.account_id")->distinct("products.merchant_id")->where($condition['column'],$condition['value'])->limit($request['limit'])->get();
            array_push($dashboardarr, $result);
        }
        $dashboard["request_timestamp"]= date("Y-m-d h:i:s");
        $dashboard["data"] = $dashboardarr;
        return $dashboard;
    }

    public function retrieveByFeatured(Request $request){
        $dashboardarr = [];
        $conditions = $request['condition'];
        $modifiedrequest = new Request([]);
        $modifiedrequest['limit'] = $request['limit'];
        //manual query without raw query;
        $result = Product::select('products.account_id','products.merchant_id','products.category','locations.latitude', 'locations.longitude', 'locations.route')->leftJoin('locations', 'products.account_id',"=","locations.account_id")->where("status","featured")->limit($modifiedrequest['limit'])->get();
        array_push($dashboardarr, $result);
        $dashboard["request_timestamp"]= date("Y-m-d h:i:s");
        $dashboard["data"] = $dashboardarr;
        return $dashboard;
    }

    public function retrieveByShop(Request $request){
        //pass by code? pass by id?
        $dashboardarr = [];
        $conditions = $request['condition'];
        $modifiedrequest = new Request([]);
        if (isset($request["id"])){
            //grab by shop
            //$result = Merchant::with(['products'])->select('account_id','merchant_id','category')->distinct()->where("code",$request["id"])->limit($modifiedrequest['limit'])->get();
            $result = Merchant::select()->where("merchants.code",$request['id'])->leftJoin('locations','merchants.account_id',"=", "locations.account_id")->get();
            array_push($dashboardarr, $result);
        }else{
            //manual query without raw query;
            $result = Merchant::select("merchants.code","merchants.account_id","locations.latitude","locations.longitude","locations.route","locations.locality")->leftJoin('locations', 'merchants.account_id',"=","locations.account_id")->limit($request['limit'])->offset($request['offset'])->orderBy($request['sort'], 'desc')->get();
            //$result = Product::select('account_id','merchant_id','category')->where($condition['column'],$condition['value'])->limit($request['limit'])->offset($request['offset'])->orderBy($request['sort'], 'desc')->get();
            //$result[0]["location"] = Location::select('latitude', 'longitude', 'route')->where("account_id", $result[0]["account_id"])->get();
            array_push($dashboardarr, $result);
        }
        $dashboard["request_timestamp"]= date("Y-m-d h:i:s");
        $dashboard["data"] = $dashboardarr;
        return $dashboard;
    }

}
