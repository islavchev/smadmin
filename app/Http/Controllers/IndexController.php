<?php

namespace App\Http\Controllers;

use App\Models\Seminar;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index()
    {
        $today = date("Y-m-d");

        for($i=0 ;$i<7; $i++) {
            $week_array[] = date('Y-m-d', strtotime("this week + $i day", strtotime($today)));
            $weekday_array[] = date('w', strtotime("this week + $i day", strtotime($today)));
        }

        $seminars = Seminar::where('seminar_date', '>=', $week_array[0])->where('seminar_date', '<=', $week_array[5])->get();

        // dd($seminars[1]->student_group);

        return view('welcome', ['seminars'=>$seminars, 'today'=>$today, 'week_array'=>$week_array, 'weekday_array'=>$weekday_array]); 
    }
}
