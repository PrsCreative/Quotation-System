<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show the application dashboard.
    public function index()
    {
        return view('dashboard',['title' => 'Dashboard']);
    }
}
