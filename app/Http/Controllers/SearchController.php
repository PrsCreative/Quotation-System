<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Products; //import product model
use App\Inventory; //import inventory model
use App\Quotations; //import Quotations model
use App\QuoteItems; //import inventory model
use DB;
class SearchController extends Controller
{
	//Get a prodcut information based on product id
    public function getProduct($id){
        //get product info with quantity filterd by id
        $products = Products::find($id)->with('stock')->get();
        foreach ($products as $key => $product){//get qty
            $vendorQuantitySum = $product->stock->sum('vendor_quantity');//get sum
            $products[$key]->qty = $vendorQuantitySum;
        }
    	echo json_encode($products[0]);
    }

    //Get a prodcut inventory information based on product id
    public function getInventory($id){
        //get all the stocks info with vendor name
        $inventory = Inventory::where('product_id',$id)->with('vendor')->get();
        echo json_encode($inventory);
    }

    //Get items table based on quotation id
    public function getItemsTable($id){
        $rows = [];//to store results
        $result = [];//to store data!
        $total = 0;

        //check if id is empty
        if($id == 0 || $id == ''){
            $rows['data'] = $result;
            echo json_encode($rows);
            return;
        }
        //query to get query items with their product name
        $items = QuoteItems::where('quote_id',$id)->with('product')->get();
        
        foreach ($items as $key => $value) {
            $total +=  $value->subtotal;
            $result[] = [$value->id, $value->product->product_name, $value->description, $value->quantity, $value->sale_price, $value->subtotal];
        }
        $rows['data'] = $result;
        $rows['subtotal'] = $total;//return subtotal of all items
        echo json_encode($rows);
    }
    //for test purposes only
    public function test(){
        $quotes = Quotations::with('items','customer')->get();

        foreach ($quotes as $key => $quote){
            $subtotal = $quote->items->sum('subtotal');
            $quotes[$key]->subtotal = $subtotal;
            //echo '<pre>';
            //echo $quote;
            echo 'id = '.$quote->id.', '.$quote->customer->customer_name.', '.$quotes[$key]->subtotal . '<br>';
        }

    }
}
