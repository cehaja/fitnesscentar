<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name','price','discount','manufacturer','size','image','description','categoryID','subcategoryID'
    ];

    public function category(){
        return $this->belongsTo('App\Category','categoryID','id');
    }

    public function subcategory(){
        return $this->belongsTo('App\Subcategory','subcategoryID','id');
    }
}
