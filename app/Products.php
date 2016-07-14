<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
    		'product_type',
            'product_name',
            'internal_reference',
            'company_name',
            'barcode',
            'sale_price',
            'cost',
            'weight',
            'volume',
            'added_by',
    ];

    public function stock(){
        return $this->hasMany(Inventory::class,'product_id');
    }
}
