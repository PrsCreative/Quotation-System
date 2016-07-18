<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Products;//Products model.
use App\Customers;//Customers model to fetch customers.
use App\Inventory;//Inventory model.
use App\Quotations;//Quotations model.
use App\QuoteItems;//QuoteItems model.
use Auth;//for authentication!
use App\Http\Requests\QuoteRequest;//quote request 

class QuoteController extends Controller
{
    // Navbar links for add new quote.
    // Text = anchor text, Link = really?, Icon = fa icon name.
    private static $Links = [
    ['text'=>'Save Quote','link'=>"",'icon'=>'check', 'id'=>''],
    ['text'=>'Print','link'=>"#",'icon'=>'print', 'id'=>'print-btn'],
    ['text'=>'Delete','link'=>"",'icon'=>'ban', 'id'=>'']
    ];

    public function __construct()
    {
        $this->middleware('auth');
        QuoteController::$Links[0]['link'] = url('quotations');
    }

    // Show all quatations
    public function index()
    {
        //get all quotations with their info
        $quotes = Quotations::with('items','customer')->get();

        foreach ($quotes as $key => $quote){//calculate subtotal
            $quotes[$key]->subtotal = $quote->items->sum('subtotal');
        }
        return view('index_views/quotes',['title' => 'Quotations','quotes'=>$quotes]);
    }

	// Show add quatation.
    public function create()
    {
        $customers = Customers::where('customer_vendor','customer')->get();
        $products = Products::all();//need to get only items that has stocks. 
        return view('create_views/new_quote',['title' => 'New Quotation', 
                    'nav_links'=>QuoteController::$Links,
                    'customers'=>$customers, 'products'=>$products, 'quote'=> new Quotations]);
    }    

    // Add quote.
    public function store(QuoteRequest $req)
    {
        //Insert product info to db through products model.
        $quote = Quotations::Create([
            'customer_id' => $req['customer_id'],
            'expiry_date' => $req['expiry_date'],
            'status' => 'Quotation', 
            'payment_term' => $req['payment_term'],
            'added_by' => Auth::user()->id
        ]);
        return response()->json(['status'=>'success','quote_id'=>$quote->id]);
    } 

    // Show Edit quotation form.
    public function edit(Request $session, $quote_id)
    {
        try
        {
            //Find the customer object from model.
            $quote = Quotations::findOrFail($quote_id);
            //Redirect to edit quotation form with the customer info found above.
            $customers = Customers::where('customer_vendor','customer')->get();
            $products = Products::all();//need to get only items that has stocks.
            return view('create_views/new_quote',['title' => 'New Quotation', 
                        'nav_links'=>QuoteController::$Links,
                        'customers'=>$customers, 'products'=>$products,
                        'quote'=>$quote
                        ]);
        }
        catch(ModelNotFoundException $err){
            //Show error message
            $session->session()->flash('flash_msg', "Product Doesn't Exist");
            //Redirect to products page.
            return $this->index();
        }
    }   
}
