<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rooms = Room::orderBy('id')->paginate(15);
        //
        return view('rooms.index', ['rooms'=>$rooms]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('rooms.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {
        //
        
        $request->validate([
            'names' => 'required',
            'capacity' => 'required',
            'internet' => 'required',
            'multimedia' => 'required',
        ]);

        $names = array_values(array_filter(explode("\n", str_replace("\r", "", $request->input('names')))));
        foreach ($names as $name) {
            $room = Room::create([
                'room_name' => $name,
                'capacity' => $request->input('capacity'),
                'internet'=> $request->input('internet'),
                'multimedia'=> $request->input('multimedia'),
                'notes'=> $request->input('notes')
                
            ]);
        };

        return redirect('rooms');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
        return view('rooms.show')->with('room', $room);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
        return view('rooms.edit')->with('room', $room);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoomRequest  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        //
       
        $request->validate([
            'room_name' => 'required',
            'capacity' => 'required',
            'internet' => 'required',
            'multimedia' => 'required',
        ]);

        $room -> update($request -> all());

        return redirect('rooms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
        $room -> delete();
        return redirect()->route('rooms.index');
    }
}
