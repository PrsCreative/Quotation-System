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
        $products = Products::where('id',$id)->with('stock')->get();
        foreach ($products as $key => $product){//get qty
            $vendorQuantitySum = $product->stock->sum('vendor_quantity');//get total quantity
            $orderSum = $product->order->sum('quantity');//get quantity of orders
            $vendorQuantitySum -= $orderSum; //remaining quantity
            $products[$key]->qty = $vendorQuantitySum;
        }
        return response()->json($products[0]);
    }

    //Get a prodcut inventory information based on product id
    public function getInventory($id){
        //get all the stocks info with vendor name
        $inventory = Inventory::where('product_id',$id)->with('vendor')->get();
        return response()->json($inventory);
    }

    //Get items table based on quotation id
    public function getItemsTable($id){
        $rows = [];//to store results
        $result = [];//to store data!
        $total = 0;

        //check if id is empty
        if($id == 0 || $id == ''){
            $rows['data'] = $result;
            return response()->json($rows);
        }
        //query to get query items with their product name
        $items = QuoteItems::where('quote_id',$id)->with('product')->get();
        $count = 1;
        foreach ($items as $key => $value) {
            $total +=  $value->subtotal;
            $edit_btn = '<button id="edit-row-button" class="btn small-btn btn-success"><i class="fa fa-pencil"></i></button>';
            $del_btn = '<button id="delete-row-button" class="btn small-btn btn-danger" data-toggle="modal" data-target="#delete-row-modal"><i class="fa fa-ban"></i></button>';

            $result[] = [$value->id, $value->product->id, $count++, $value->product->product_name, $value->description, $value->quantity, $value->sale_price, $value->subtotal, $edit_btn, $del_btn];
        }
        $rows['data'] = $result;
        $rows['subtotal'] = $total;//return subtotal of all items
        return response()->json($rows);
    }
    //for test purposes only
    public function test(){
        return response()->json(new Quotations);
    }
}
