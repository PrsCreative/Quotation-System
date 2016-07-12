<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Products; //import product model
use App\Inventory; //import inventory model
use DB;
class SearchController extends Controller
{
	//Get a prodcut information based on product id
    public function getProduct($id){
    	$product = Products::find($id);
    	echo json_encode($product);
    }

    //Get a prodcut inventory information based on product id
    public function getInventory($id){
        $inventory = Inventory::select('inventory.id')->where('inventory.product_id',$id)->join('customers','customers.id','=','vendor')
        ->addSelect('customers.customer_name')
        ->addSelect('inventory.vendor_quantity')
        ->addSelect('inventory.vendor_price')
        ->addSelect('inventory.vendor_produce')
        ->addSelect('inventory.vendor_expiry')->get();
        echo json_encode($inventory);
    }
}
