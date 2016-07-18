<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Products;//Products model.
use App\Customers;//Customers model to fetch customers.
use App\Inventory;//Inventory model.
use App\Quotations;//Quotations model.
use App\QuoteItems;//QuoteItems model.

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show the application dashboard.
    public function index()
    {
        
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
}
