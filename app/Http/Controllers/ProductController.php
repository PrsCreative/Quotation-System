<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ProductRequest;//to handle validation and error messages.
use App\Products;//Products model.
use App\Customers;//Customers model to fetch vendors.
use Auth;//for authentication!
use DB; //for raw query
class ProductController extends Controller
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
        ProductController::$Links[1]['link'] = url('products');
    }

    // Show all products
    public function index()
    {
        //Get all products form db through model.
        $products = Products::with('stock')->get();
        foreach ($products as $key => $product){
            $vendorQuantitySum = $product->stock->sum('vendor_quantity');//get total quantity
            $orderSum = $product->order->sum('quantity');//get quantity of orders
            $vendorQuantitySum -= $orderSum; //remaining quantity
            $products[$key]->qty = $vendorQuantitySum;
        }
        //Redirect to products page with title and all products data.
        return view('index_views/products',['title' => 'Products','products'=>$products]);
    }

	// Show add new product form.
    public function create()
    {
        //Redirect to new product form with title and nav links
        return view('create_views/new_product',['title' => 'New Product', 'nav_links'=>ProductController::$Links
            ,'product' => new Products]);
    } 

   
    // Add product.
    public function store(Request $session, ProductRequest $request)
    {
        //Insert product info to db through products model.
        Products::Create([
            'product_type' => $request['product_type'],
            'product_name' => $request['product_name'],
            'internal_reference' => $request['internal_reference'],
            'barcode' => $request['barcode'],
            'sale_price' => $request['sale_price'],
            'cost' => $request['cost'],
            'weight' => $request['weight'],
            'volume' => $request['volume'],
            'added_by' => Auth::user()->id
        ]);
        //Set success message.
        $session->session()->flash('flash_msg', 'Product Sucessfully Created');
        //Redirect to inventory page.
        return redirect()->action('InventoryController@create');
    }   

    // Show Edit product form.
    public function edit(Request $session, $product_id)
    {
        try{
            //Find the customer object from model.
            $product = Products::findOrFail($product_id);
            //Redirect to edit customer form with the customer info found above.
            return view('create_views/new_product',[
                'title' => 'Edit Product',
                'nav_links'=>ProductController::$Links,
                'product'=>$product
                ]);
        }
        catch(ModelNotFoundException $err){
            //Show error message
            $session->session()->flash('flash_msg', "Product Doesn't Exist");
            //Redirect to products page.
            return $this->index();
        }
    } 

    // Update customer
    public function update(ProductRequest $request, $product_id)
    {
        try{
            //Get product object from model.
            $product = Products::findOrFail($product_id);
            //Set product object attributes
            $product->product_type = $request['product_type'];
            $product->product_name = $request['product_name'];
            $product->internal_reference = $request['internal_reference'];
            $product->barcode = $request['barcode'];
            $product->sale_price = $request['sale_price'];
            $product->cost = $request['cost'];
            $product->weight = $request['weight'];
            $product->volume = $request['volume'];
            $product->added_by = Auth::user()->id;
            //Save/update product.
            $product->save();
            //Show success message.
            $request->session()->flash('flash_msg', 'Product Sucessfully Updated');
            //Redirect to products page.
            return $this->index();
        }
        catch(ModelNotFoundException $err){
            //Show error message
            $request->session()->flash('flash_msg', "Product Doesn't Exist");
            //Redirect to products page.
            return $this->index();
        }       
    }      
}
