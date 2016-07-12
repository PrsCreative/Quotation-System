<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $fillable = [ 'customer_type','customer_vendor','customer_name',
							'company_name','job_position','street','city',
							'country','website','phone','mobile',
							'email','added_by'];
}
