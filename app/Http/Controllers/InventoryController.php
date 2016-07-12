<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\InventoryRequest;//to handle validation and error messages.
use App\Products;//Products model.
use App\Customers;//Customers model to fetch vendors.
use App\Inventory;//Inventory model.
use Auth;//for authentication!

class InventoryController extends Controller
{
    // Navbar links for add new product
    // Text = anchor text, Link = really?, Icon = fa icon name.
    private static $Links = [
    ['text'=>'Save Product','link'=>"javascript:submitForm();",'icon'=>'check'],
    ['text'=>'Cancel','link'=>"",'icon'=>'ban']
    ];

    public function __construct()
    {
        $this->middleware('auth');
        InventoryController::$Links[0]['link'] = InventoryController::$Links[1]['link'] = url('products');
    }

    //Display a listing of the resource.
    public function index()
    {
        //
    }


    // Show the form for creating a new resource.
    public function create()
    {
        $products = Products::all();
        $vendors = Customers::where('customer_vendor','Vendor')->get();
        return view('create_views/new_inventory',['title' => 'New Inventory', 'nav_links'=>InventoryController::$Links,'vendors'=>$vendors, 'products'=>$products]);
    }

    //Store a newly created resource in storage.
    public function store(InventoryRequest $request)
    {
        if($request->ajax())
        {
            $req = $request->all();
            Inventory::Create([
            'product_id' => $req['product_id'],
            'vendor' => $req['vendor'],
            'vendor_product_code' => $req['vendor_product_code'],
            'vendor_product_name' => $req['vendor_product_name'],
            'vendor_quantity' => $req['vendor_quantity'],
            'vendor_price' => $req['vendor_price'],
            'vendor_produce' => $req['vendor_produce'],
            'vendor_expiry' => $req['vendor_expiry'],
            'added_by' => Auth::user()->id
            ]);      
            return 'Success!';      
        }
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
    public function update(Request $request, $id)
    {
        //
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
            Inventory::destroy($id);

            return 'deleted';
        }
        catch(ModelNotFoundException $err){
            //Show error message
            $session->session()->flash('flash_msg', "Vendor Doesn't Exist");
            //Redirect to products page.
            return $this->index();
        }        
    }
}
