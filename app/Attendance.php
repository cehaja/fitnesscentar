<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'date','arrivalTime','exitTime','userID'
    ];

    public  function user(){
        return $this->belongsTo('App\User','userID','id');
    }
}
