<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAcademicRequest;
use App\Http\Requests\UpdateAcademicRequest;
use App\Models\Academic;

class AcademicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $academics = Academic::orderBy('id')->paginate(15);
        return view('academics.index', ['academics'=>$academics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('academics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAcademicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAcademicRequest $request)
    {
        //
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'room_no' => 'required',
            'acad_position' => 'required', 
'abbreviation' => 'required' 
        ]);

        $teacher = Academic::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'room_no' => $request->input('room_no'),
            'acad_position' => $request->input('acad_position'),
            'acad_title' => $request->input('acad_title'), 
'abbreviation' => $request->input('abbreviation') 

        ]);

        return redirect('academics');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function show(Academic $academic)
    {
        //
        return view('academics.show')->with('academic', $academic);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function edit(Academic $academic)
    {
        //
        return view('academics.edit')->with('academic', $academic);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAcademicRequest  $request
     * @param  \App\Models\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAcademicRequest $request, Academic $academic)
    {
        //
        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'room_no' => 'required',
            'acad_position' => 'required'
        ]);

        $academic -> update($request -> all());

        return redirect('academics');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Academic $academic)
    {
        //
        $academic -> delete();

        return redirect()->route('academics.index');
    }
}
