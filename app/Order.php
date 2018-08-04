<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'date','total','deliveryDate','userID','addressID'
    ];

    public function user(){
        return $this->belongsTo('App\User','userID','id');
    }

    public function address(){
        return $this->belongsTo('App\Address','addressID','id');
    }

    public function orderItems(){
        return $this->hasMany('App\OrderItem','orderID','id');
    }
}
