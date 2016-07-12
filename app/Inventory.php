<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
	protected $table = "inventory";
    protected $fillable =[
    	'product_id',
        'vendor',
        'vendor_product_code',
        'vendor_product_name',
        'vendor_quantity',
        'vendor_price',
        'vendor_produce',
        'vendor_expiry',
        'added_by'
    ];
}
