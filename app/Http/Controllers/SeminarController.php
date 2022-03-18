<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Seminar;
use App\Models\Subject;
use App\Models\Academic;
use App\Models\StudentGroup;
use App\Http\Requests\StoreSeminarRequest;
use App\Http\Requests\UpdateSeminarRequest;

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
        $seminars = Seminar::orderBy('date')->orderBy('period')->paginate(15);
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
        $subjects = Subject::all();

        return view('seminars.create', ['groups'=>$groups, 'academics' => $academics, 'rooms' => $rooms, 'subjects'=>$subjects]);

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
            'subject_id'=>'required',
            'classes'=>'required',
            'date_start'=>'required',
            'date_end'=>'required',
            'academic_id'=>'required',
            'student_group_id'=>'required',
            'room_id'=>'required',
        ]);

        $date_start = strtotime($request->date_start);
        $date_end = strtotime($request->date_end);

        for ($day=0; $day < 7; $day++) {            
            if (isset($request->classes[$day])) {
                for ($day_of_week = strtotime(config('enums.weekdays_eng')[$day], $date_start); $day_of_week <= $date_end; $day_of_week = strtotime('+1 week', $day_of_week)){
                    foreach ($request->classes[$day] as $class) {             
                        $seminar = Seminar::create([
                            'subject_id' => $request->subject_id,
                            'room_id' => $request->room_id,
                            'academic_id' => $request->academic_id,
                            'student_group_id' => $request->student_group_id,
                            'period' => $class,
                            'date' => date('Y-m-d', $day_of_week),
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
    public function destroy(UpdateSeminarRequest $request)
    {
        //
        foreach ($request->seminar_ids as $seminar_id) {
            Seminar::get($seminar_id) -> delete(); 
        }
        // $seminar -> delete();

        return redirect()->route('seminars.index');
    }

    public function destroyMultiple(Seminar $seminar)
    {
        //

        $seminar -> delete();

        return redirect()->route('seminars.index');
    }
}
