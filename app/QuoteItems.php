<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteItems extends Model
{
    protected $table = 'quote_items';
    protected $fillable = [
        'quote_id',
        'product_id',
        'quantity',
        'sale_price',
        'subtotal',
        'description',
        'added_by'
    ];

    public function quotes(){
        return $this->belongsTo(Quotations::class);
    }

    public function product(){
        return $this->belongsTo(Products::class,'product_id');
    }
}
