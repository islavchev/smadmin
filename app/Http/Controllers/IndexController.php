<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Seminar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    public function index()
    {
        // DateTime::createFromFormat('Y-m-d', $seminar->date)->format('d.m.y')
        $today = date("Y-m-d");

        for($i=0 ;$i<7; $i++) {
            $week_array[] = date('Y-m-d', strtotime("this week + $i day",  DateTime::createFromFormat('Y-m-d',$today)->getTimestamp()));
            $weekday_array[] = date('w', strtotime("this week + $i day", DateTime::createFromFormat('Y-m-d',$today)->getTimestamp()));
        }
        if (Seminar::first()!=null) {
            $seminars = Seminar::where('date', '>=', $week_array[0])->where('date', '<=', $week_array[5])->get();
        } else {
            $seminars = 0;
        }

        // dd($seminars[1]->student_group);

        return view('welcome', ['seminars'=>$seminars, 'today'=>$today, 'week_array'=>$week_array, 'weekday_array'=>$weekday_array]); 
    }

    public function semester_choose(){

        return view ('semester.choose');

    }

    public function semester_show(Request $request){

        $request->validate([
            'year'=>'required',
            'semester'=>'required',
        ]);
        
        // select only seminars in the given year and semester
        $semester = $request->semester > 1 ? '> 7' : '<= 7';
        $seminars = Seminar::whereRaw('YEAR(date) = '.$request->year.' AND MONTH(date) '.$semester)->orderBy('date')->get();

        $grouped = $seminars->groupBy(function ($item){
            return DateTime::createFromFormat('Y-m-d', $item->date)->format('w').$item->period.$item->subject_id.$item->student_group_id.$item->academic_id.$item->room_id;
        });

        $grouped_iteration=0;
        foreach ($grouped as $group => $one_seminar) {
            $schedule[substr($group, 0, 1)][substr($group,1,1)][] = ['start_time' => DateTime::createFromFormat('Y-m-d', $one_seminar->first()->date)->format('d.m.'), 'end_time' => DateTime::createFromFormat('Y-m-d', $one_seminar->last()->date)->format('d.m.'), 'seminar_id' => $one_seminar->first()->id];
        }

      
        // dd($schedule);

        return view('semester.show')->with('schedule', $schedule)->with('seminars', $seminars); 
    }

    public function checkConflicts(Request $request){

        $seminars = Seminar::orderBy('date')->get();
        
        $grouped= $seminars->groupBy(function ($item){
            return $item->date.$item->period;
        });

        foreach ($grouped as $cases) {
            if ($cases->count() > 1) {
                // $conflicts[]=$cases;
                $conflict_check = $cases->groupBy('academic_id');
                foreach ($conflict_check as $single_check) {
                    if ($single_check->count() > 1 ) {
                        $conflicts[] = ['date' => $single_check->first()->date, 'period' => $single_check->first()->period];
                    }
                }
                $conflict_check = $cases->groupBy('student_group_id');
                foreach ($conflict_check as $single_check) {
                    if ($single_check->count() > 1 ) {
                        $conflicts[] = ['date' => $single_check->first()->date, 'period' => $single_check->first()->period];
                    }
                }
                $conflict_check = $cases->groupBy('room_id');
                foreach ($conflict_check as $single_check) {
                    if ($single_check->count() > 1 ) {
                        $conflicts[] = ['date' => $single_check->first()->date, 'period' => $single_check->first()->period];
                    }
                }
            }
        }

        $serialized = array_map('serialize', $conflicts);
        $unique = array_unique($serialized);
        $conflicts = array_intersect_key($conflicts, $unique);

        foreach ($conflicts as $conflict_schedule) {
            // $conflict_seminars[] = $conflict_schedule['date'].'-'.$conflict_schedule['period'];
            $conflict_seminars[] = $seminars -> where('date', '=', $conflict_schedule['date'])->where('period', '=', $conflict_schedule['period']);
        }

        // dd($conflict_seminars);

        return view('conflicts.show')->with('conflict_seminars', $conflict_seminars);
    }
}
