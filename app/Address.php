<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
            'countryID','city','address','ZIPCode','userID'
        ];

    public function country(){
        return $this->belongsTo('App\Country','countryID','id');
    }
}
