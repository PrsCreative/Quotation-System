<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerRequest extends Request
{
    //Determine if the user is authorized to make this request.
    public function authorize()
    {
        return true;
    }

    //Get the validation rules that apply to the request.
    public function rules()
    {
        return [
            'customer_type'=>'required|',
            'customer_vendor'=>'required|',
            'customer_name'=>'required|',
            'company_name'=>'required_if:customer_type,Company',
            'job_position'=>'required|',
            'street'=>'',
            'city'=>'required|',
            'country'=>'required|',
            'website'=>'url',
            'phone'=>'required_without:mobile|numeric',
            'mobile'=>'required_without:phone|numeric',
            'email'=>'email',
        ];
    }

    /*Custom Error Messages*/
    public function messages()
    {
        $phone_msg = 'One of the contact numbers must be provided.';
        return [
            'phone.required_without' => $phone_msg,
            'mobile.required_without' => $phone_msg,
        ];
    }

}
