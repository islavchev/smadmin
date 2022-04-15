<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $groups = Group::orderBy('id')->paginate(15);
        //
        return view('groups.index', ['groups'=>$groups]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request)
    {
        //
        
        $request->validate([
            'names' => 'required',
        ]);

        $names = array_values(array_filter(explode("\n", str_replace("\r", "", $request->input('names')))));
        foreach ($names as $name) {
            $room = Group::create([
                'name' => $name                
            ]);
        };

        return redirect('groups');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $Group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
        return view('groups.show')->with('group', $group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $Group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupRequest  $request
     * @param  \App\Models\Group  $Group
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $Group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }

    public function detachStudent(Group $group,Student $student){
       
        $group->students()->detach($student->id);

        return back()->with('group', $group);
    }

    public function attachStudents(Group $group, UpdateGroupRequest $request){
       
        // dd($group);
        $group->students()->attach($request->studentIds);

        return view('groups.show')->with('group', $group);
    }

    public function addStudents(Group $group){
        $students = Student::get();
        return view('groups.addStudents')->with(['group' => $group, 'students'=>$students]);
    }
}
