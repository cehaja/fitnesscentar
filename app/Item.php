<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name','price','discount','manufacturer','size','image','description','categoryID'
    ];
}
