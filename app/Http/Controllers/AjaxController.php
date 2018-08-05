<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Attendance;
use App\User;
use DateTime;
use Illuminate\Http\Request;


class AjaxController extends Controller
{
    public function attendance(Request $request)
    {
        //find user whose card is used
        $member = User::where('membershipCardNumber', $request->c)->get();
        //if card doesn't belongs to any user
        if (!$member->first()) {
            return response()->json(array('msg' => 'error'));
        }
        $test = 0;
        $time = new DateTime();
        $attendances = Attendance::whereNull('exitTime')->get();

        foreach ($attendances as $attendance) {
            //if user on attendance is owner of card
            if ($attendance->userID == $member[0]->id) {
                //set exitTime to current time
                $attendance->exitTime = $time->format('H:i:s');
                $attendance->save();
                $test = 1;
            }
        }
        if ($test == 0) {
            //add new attendance with user who is owner of card
            $attendance = new Attendance();
            $attendance->userID = $member[0]->id;
            $attendance->date = $time->format('Y-m-d');
            $attendance->arrivalTime = $time->format('H:i:s');
            $attendance->save();
        }
        $attendances = Attendance::whereNull('exitTime')->get();
        //prepare ajax response
        $msg = '<thead class="thead-dark"><tr><th>Member</th><th>Arrival time</th></tr></thead><tbody>';
        foreach ($attendances as $row) {
            $msg .= '<tr>';
            $msg .= '<td>' . $row->user->firstName . ' ' . $row->user->lastName . '</td>';
            $msg .= '<td>' . $row->arrivalTime . '</td>';
            $msg .= '</tr>';
        }
        $msg .= '</tbody>';
        return response()->json(array('msg' => $msg), 200);
    }
}