<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable=[
        'startDate','endDate','userID','typeID'
    ];

    public function type(){
        return $this->belongsTo('App\MembershipType','typeID','id');
    }
}
