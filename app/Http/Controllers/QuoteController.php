<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class QuoteController extends Controller
{
    // Navbar links for add new quote.
    // Text = anchor text, Link = really?, Icon = fa icon name.
    private static $Links = [
    ['text'=>'Save Quote','link'=>"http://www.google.com",'icon'=>'check'],
    ['text'=>'Email','link'=>"http://www.google.com",'icon'=>'envelope'],
    ['text'=>'Print','link'=>"http://www.google.com",'icon'=>'print'],
    ['text'=>'Cancel','link'=>"",'icon'=>'ban']
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show all quatations
    public function index()
    {
        return view('index_views/quotes',['title' => 'Quotations']);
    }

	// Show add quatation.
    public function create()
    {
        return view('create_views/new_quote',['title' => 'New Quotation', 'nav_links'=>QuoteController::$Links]);
    }    
}
