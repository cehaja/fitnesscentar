<?php

namespace App\Rules;

use App\Membership;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class MembershipStartDateRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $memberships = Membership::where('userID',$id)->orderBy('endDate','desc')->get();
        if ($memberships->first()){
            $this->lastEndDate = $memberships[0]->endDate;
        }
        else {
            $this->lastEndDate = null;
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->lastEndDate == null){
            return true;
        }
        else if($this->lastEndDate > $value){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The start date must be higher than end date of last membership: '.$this->lastEndDate.' !!!';
    }
}
