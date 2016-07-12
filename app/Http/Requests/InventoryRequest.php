<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InventoryRequest extends Request
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
            'product_id' => 'required|',
            'vendor' => 'required|',
            'vendor_product_code' => '',
            'vendor_product_name' => 'required|',
            'vendor_quantity' => 'required|',
            'vendor_price' => 'required|',
            'vendor_produce' => '',
            'vendor_expiry' => '',
        ];
    }
}
