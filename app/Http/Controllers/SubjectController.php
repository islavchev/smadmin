<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $subjects = Subject::orderBy('id')->paginate(15);
        return view('subjects.index', ['subjects'=>$subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubjectRequest $request)
    {
        //
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'lecture_hours' => 'required',
            'seminar_hours' => 'required',
            'ects' => 'required',
            'type' => 'required',
            'edu_form' => 'required',
        ]);

        $subject = Subject::create([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'lecture_hours' => $request->input('lecture_hours'),
            'seminar_hours' => $request->input('seminar_hours'),
            'ects' => $request->input('ects'),
            'type' => $request->input('type'),
            'edu_form' => $request->input('edu_form'),
            'note' => $request->input('note'), 
        ]);

        return redirect('subjects');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
        return view('subjects.show', ['subject'=>$subject]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
        return view('subjects.edit')->with('subject', $subject);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubjectRequest  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        //
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'lecture_hours' => 'required',
            'seminar_hours' => 'required',
            'ects' => 'required',
            'type' => 'required',
            'edu_form' => 'required',
        ]);
        $subject -> update($request -> all());

        return redirect('subjects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
        $subject -> delete();

        return redirect()->route('subjects.index');
    }
}
