<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_type' => 'required|',
            'product_name' => 'required|',
            'internal_reference' => '',
            'barcode' => 'required|',
            'sale_price' => 'required|',
            'cost' => 'required|',
            'weight' => 'required_without:volume|',
            'volume' => 'required_without:weight|',
        ];
    }

    /*Custom Error Messages*/
    public function messages()
    {
        $msg = 'One of the Weight or Volume must be provided.';
        return [
            'weight.required_without' => $msg,
            'volume.required_without' => $msg,
        ];
    }
}
