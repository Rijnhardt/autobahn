<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KitchenItem extends Model
{
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}
