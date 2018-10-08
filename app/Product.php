<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'brand_name', 'generic_name', 'description', 'date_arrival','expiry_date','selling_price','original_price','quantity','quantity_left','profit'
    ];
}
