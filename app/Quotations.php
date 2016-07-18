<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotations extends Model
{
    protected $fillable = [
        'customer_id',
        'expiry_date',
        'status', 
        'payment_term',
        'added_by'
    ]; 

    public function items(){
        return $this->hasMany(QuoteItems::class,'quote_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class,'customer_id');
    }
}