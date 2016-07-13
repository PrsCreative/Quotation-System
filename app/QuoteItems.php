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
        'description',
        'added_by'
    ];
}
