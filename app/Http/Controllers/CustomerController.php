<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CustomerRequest;//to handle validation and error messages.
use App\Customers;//Customers model.
use Auth;//for authentication!

class CustomerController extends Controller
{
    // Navbar links for add new customer.
    // Text = anchor text, Link = really?, Icon = fa icon name.
    private static $Links = [
    ['text'=>'Save Customer','link'=>"javascript:submitForm();",'icon'=>'check'],
    ['text'=>'Cancel','link'=> '','icon'=>'ban']
    ];

    //Constructor, you know?!
    public function __construct()
    {
        //Require authentication.
        $this->middleware('auth');
        CustomerController::$Links[1]['link'] = url('customers');
    }

    // Show all customers
    public function index()
    {
        //Get all customers form db through model.
        $customers = Customers::all();
        //Redirect to customers page with title and all customers data.
        return view('index_views/customers',['title' => 'Customers','customers'=>$customers]);
    }

	// Show add customer form.
    public function create()
    {
        //Redirect to new customer form with title and nav links
        return view('create_views/new_customer',[
            'title' => 'New Customer','nav_links'=>CustomerController::$Links,
            'customer'=> new Customers]);
    }  

    // Add customer.
    public function store(Request $session, CustomerRequest $request)
    {
        //Insert customer info to db through customers model.
        Customers::Create([
            'customer_type' => $request['customer_type'],
            'customer_vendor' => $request['customer_vendor'],
            'customer_name' => $request['customer_name'],
            'company_name' => $request['company_name'],
            'job_position' => $request['job_position'],
            'street' => $request['street'],
            'city' => $request['city'],
            'country' => $request['country'],
            'website' => $request['website'],
            'phone' => $request['phone'],
            'mobile' => $request['mobile'],
            'email' => $request['email'],
            'added_by' => Auth::user()->id
        ]);
        //Set success message.
        $session->session()->flash('flash_msg', 'Customer Sucessfully Created');
        //Redirect to customers page.
        return $this->index();
    }   

    // Show Edit customer form.
    public function edit(Request $session, $customer_id)
    {
        try
        {
            //Find the customer object from model.
            $customer = Customers::findOrFail($customer_id);
            //Redirect to edit customer form with the customer info found above.
            return view('create_views/new_customer',[
                'title' => 'Edit Customer',
                'nav_links'=>CustomerController::$Links,
                'customer'=>$customer
                ]);
        }
        catch(ModelNotFoundException $err){
            //Show error message
            $session->session()->flash('flash_msg', "Customer Doesn't Exist");
            //Redirect to customers page.
            return $this->index();
        }
    } 

    // Update customer
    public function update(Request $request, $customer_id)
    {
        try
        {
            //Get customer object from model.
            $customer = Customers::findOrFail($customer_id);
            //Set customer object attributes
            $customer->customer_type = $request['customer_type'];
            $customer->customer_vendor = $request['customer_vendor'];
            $customer->customer_name = $request['customer_name'];
            $customer->company_name = $request['company_name'];
            $customer->job_position = $request['job_position'];
            $customer->street = $request['street'];
            $customer->city = $request['city'];
            $customer->country = $request['country'];
            $customer->website = $request['website'];
            $customer->phone = $request['phone'];
            $customer->mobile = $request['mobile'];
            $customer->email = $request['email'];
            $customer->added_by = Auth::user()->id;
            //Save/update customer.
            $customer->save();
            //Show success message.
            $request->session()->flash('flash_msg', 'Customer Sucessfully Updated');
            //Redirect to customers page.
            return $this->index();
        }
        catch(ModelNotFoundException $err){
            //Show error message
            $request->session()->flash('flash_msg', "Customer Doesn't Exist");
            //Redirect to customers page.
            return $this->index();
        }       
    }   
}
