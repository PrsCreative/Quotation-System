<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\QuoteItems;//QuoteItems model.
use Auth;
use App\Http\Requests\QuoteItemsRequest;//quote items request 
class QuoteItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuoteItemsRequest $request)
    {
        $quote_item = QuoteItems::create([
            'quote_id' => $request['quote_id'],
            'product_id' => $request['product_id'],
            'quantity' => $request['item_qty'],
            'sale_price' => $request['item_price'],
            'subtotal' => $request['item_price'] * $request['item_qty'],
            'description' => $request['item_description'],
            'added_by' => Auth::user()->id
        ]);
        //return json response
        return response()->json(['status'=>'success','quoteItem_id'=>$quote_item->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuoteItemsRequest $request, $quoteItem_id)
    {
        try{
            //Get quote item object from model.
            $item = QuoteItems::findOrFail($quoteItem_id);
            //Set qutoe item object attributes
            $item->quantity = $request['item_qty'];
            $item->sale_price = $request['item_price'];
            $item->subtotal = $request['item_price'] * $request['item_qty'];
            $item->description = $request['item_description'];
            $item->updated_by = Auth::user()->id;
            //Save/update item.
            $item->save();
            //Show success message.
            return response()->json(['status'=>'success']);
        }
        catch(ModelNotFoundException $err){
            //Show error message
            
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            //Find the inventory object from model.
            QuoteItems::destroy($id);
            return response()->json('deleted');
        }
        catch(ModelNotFoundException $err){
            //Show error message
        }  
    }
}
