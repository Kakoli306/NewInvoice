<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    protected $fillable = [
        'name','amount','product_id'
    ];
}
