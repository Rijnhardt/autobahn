<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    public function group()
    {
        return $this->belongsTo(ProductGroup::class);
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
