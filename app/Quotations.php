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
}