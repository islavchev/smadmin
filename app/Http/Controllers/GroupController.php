<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;

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
    public function show(Group $Group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $Group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $Group)
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
    public function update(UpdateGroupRequest $request, Group $Group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $Group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $Group)
    {
        //
    }
}
