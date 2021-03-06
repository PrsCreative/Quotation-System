<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class QuoteItemsRequest extends Request
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
            'quote_id' => 'required|',
            'product_id' => 'required|',
            'item_qty' => 'required|',
            'item_qty_total' => 'required|',
            'item_price' => 'required|',
            'item_price_orig' => 'required|',
        ];
    }
}
