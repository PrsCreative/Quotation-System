<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Products;//Products model.
use App\Customers;//Customers model to fetch customers.
use App\Inventory;//Inventory model.
use App\Quotations;//Quotations model.
use App\QuoteItems;//QuoteItems model.
use App\Settings;//QuoteItems model.
use Auth;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show the application dashboard.
    public function index()
    {
        //get counts
        $products = Products::count();
        $inventory = Inventory::sum('vendor_quantity');
        $customers = Customers::count();
        $quotations = Quotations::count();

        return view('dashboard',['title' => 'Dashboard',
        'products' => $products,
        'inventory' => $inventory,
        'customers' => $customers,
        'quotations' => $quotations
        ]);
    }

    //Show settings page
    public function showSettings()
    {
        $settings = Settings::find(1);
        return view('settings',['title' => 'Settings', 'settings' => $settings]);
    }

    //save settings
    public function saveSettings(Request $request)
    {
        $settings = Settings::find(1);
        $settings->company_name = $request['company_name'];
        $settings->address1 = $request['address1'];
        $settings->address2 = $request['address2'];
        $settings->country = $request['country'];
        $settings->email = $request['email'];
        $settings->phone = $request['phone'];
        $settings->mobile = $request['mobile'];
        $settings->terms = $request['terms'];
        $settings->updated_by = Auth::user()->id;
        $settings->save();
        $request->session()->flash('flash_msg', "Settings Saved");
        return redirect()->action('AdminController@showSettings');
    }


    //show printable version of quotation
    public function showPrint(Request $request, $quote_id){
        //Find the quotation object from model.
        $quote = Quotations::with('customer')->where('id',$quote_id)->get();
        if(count($quote) > 0 ){
            $settings = Settings::find(1);//get saveSettings
            $items = QuoteItems::where('quote_id',$quote_id)->with('product')->get();
            return view('print',['settings' => $settings, 'quote'=>$quote[0], 'items'=>$items]);
        }
        //Show error message
        $request->session()->flash('flash_msg', "Quote Doesn't Exist");
        //Redirect to products page.
        return redirect()->action('AdminController@index');
    }
}
