<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'orderID','itemID','quantity'
    ];

    public function item(){
        return $this->belongsTo('App\Item','itemID','id');
    }
}
