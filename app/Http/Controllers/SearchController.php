<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Products; //import product model
use App\Inventory; //import inventory model
use App\QuoteItems; //import inventory model
use DB;
class SearchController extends Controller
{
	//Get a prodcut information based on product id
    public function getProduct($id){
    	//$product = Products::find($id);
        $qty_query = ProductController::getQuantityQuery(); //products with quantity query
        $qty_query = $qty_query . ' WHERE id = ' . $id . ' LIMIT 1';//get only the product witht he passed id
        $product = DB::select(DB::raw($qty_query));
    	echo json_encode($product[0]);
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

    //Get items table based on quotation id
    public function getItemsTable($id){
        $rows = [];//to store results
        $result = [];//to store data!
        $total = 0;
        if($id == 0){
            $rows['data'] = $result;
            echo json_encode($rows);
            return;
        }
        //query to get query items with their product name
        $items = QuoteItems::select('quote_items.id')->where('quote_items.quote_id',$id)->join('products','products.id','=','quote_items.product_id')
                            ->addSelect('quote_items.description')
                            ->addSelect('quote_items.quantity')
                            ->addSelect('quote_items.sale_price')
                            ->addSelect('products.product_name')->get();
        
        foreach ($items as $key => $value) {
            $subtotal = $value->quantity *  $value->sale_price;
            $total += $subtotal;
            $result[] = [$value->id, $value->product_name, $value->description, $value->quantity, $value->sale_price,$subtotal];
        }
        $rows['data'] = $result;
        $rows['subtotal'] = $total;
        echo json_encode($rows);
    }
}
