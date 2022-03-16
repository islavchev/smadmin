<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSeminarRequest;
use App\Http\Requests\UpdateSeminarRequest;
use App\Models\Seminar;
use App\Models\Room;
use App\Models\Academic;
use App\Models\StudentGroup;

class SeminarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $seminars = Seminar::orderBy('seminar_date')->orderBy('seminar_period')->paginate(15);
        return view('seminars.index', ['seminars' => $seminars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $academics = Academic::all();
        $groups = StudentGroup::all();
        $rooms = Room::all();

        return view('seminars.create', ['groups'=>$groups, 'academics' => $academics, 'rooms' => $rooms]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSeminarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeminarRequest $request)
    {
        $request->validate([
            'seminar_name'=>'required',
            'seminar_code'=>'required',
            'seminar_type'=>'required',
            'classes'=>'required',
            'date_start'=>'required',
            'date_end'=>'required',
            'academic'=>'required',
            'group'=>'required',
            'room'=>'required',
        ]);

        $date_start = strtotime($request->date_start);
        $date_end = strtotime($request->date_end);

        for ($day=0; $day < 7; $day++) {            
            if (isset($request->classes[$day])) {
                for ($day_of_week = strtotime(config('enums.weekdays_eng')[$day], $date_start); $day_of_week <= $date_end; $day_of_week = strtotime('+1 week', $day_of_week)){
                    foreach ($request->classes[$day] as $class) {             
                        $seminar = Seminar::create([
                            'seminar_name' => $request->seminar_name,
                            'seminar_code' => $request->seminar_code,
                            'seminar_type' => $request->seminar_type,
                            'room_id' => $request->room,
                            'academic_id' => $request->academic,
                            'student_group_id' => $request->group,
                            'seminar_period' => $class,
                            'seminar_date' => date('Y-m-d', $day_of_week) ,
                        ]);           
                        // $end[$day][date('l Y-m-d', $day_of_week)][] = $class;
                    }
                }
            }
        }

        // dd($end);
        // $student->groups()->attach($request->groupIds);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function show(Seminar $seminar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function edit(Seminar $seminar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSeminarRequest  $request
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeminarRequest $request, Seminar $seminar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seminar $seminar)
    {
        //
    }
}
