<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Products;//Products model.
use App\Customers;//Customers model to fetch customers.
use App\Inventory;//Inventory model.
use App\Quotations;//Quotations model.
use Auth;//for authentication!

class QuoteController extends Controller
{
    // Navbar links for add new quote.
    // Text = anchor text, Link = really?, Icon = fa icon name.
    private static $Links = [
    ['text'=>'Save Quote','link'=>"",'icon'=>'check'],
    ['text'=>'Email','link'=>"",'icon'=>'envelope'],
    ['text'=>'Print','link'=>"",'icon'=>'print'],
    ['text'=>'Cancel','link'=>"",'icon'=>'ban']
    ];

    public function __construct()
    {
        $this->middleware('auth');
        QuoteController::$Links[0]['link'] = QuoteController::$Links[3]['link'] = url('quotations');
    }

    // Show all quatations
    public function index()
    {
        return view('index_views/quotes',['title' => 'Quotations']);
    }

	// Show add quatation.
    public function create()
    {
        $customers = Customers::where('customer_vendor','customer')->get();
        $products = Products::all();//need to get only items that has stocks.
        return view('create_views/new_quote',['title' => 'New Quotation', 
                    'nav_links'=>QuoteController::$Links,
                    'customers'=>$customers, 'products'=>$products]);
    }    

    // Add quote.
    public function store(Request $req)
    {
        //Insert product info to db through products model.
        $quote = Quotations::Create([
            'customer_id' => $req['customer_id'],
            'expiry_date' => $req['expiry_date'],
            'status' => 'Quotation', 
            'payment_term' => $req['payment_term'],
            'added_by' => Auth::user()->id
        ]);
        echo $quote->id;
    }   
}
