<?php

namespace App\Http\Controllers;

use App\Models\Academic;
use App\Models\ContactInfo;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StoreAcademicRequest;
use App\Http\Requests\UpdateAcademicRequest;

class AcademicController extends Controller
{
    /**
     * 
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

        // dd($request); 

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'room_no' => 'required',
            'acad_position' => 'required', 
            'acad_title' => 'required', 
            'abbreviation' => 'required' 
        ]);


        $teacher = Academic::create([
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'room_no' => $request->input('room_no'),
            'acad_position' => $request->input('acad_position'),
            'acad_title' => $request->input('acad_title'), 
            'abbreviation' => $request->input('abbreviation') 

        ]);


        $phone = new ContactInfo;
        $phone->type = 1;
        $phone->contact_info = $request->input('phone');
        $teacher->contacts()->save($phone);

        $email = new ContactInfo;
        $email->type = 2;
        $email->contact_info = $request->input('email');
        $teacher->contacts()->save($email);

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
            'room_no' => 'required',
            'acad_position' => 'required', 
            'acad_title' => 'required', 
            'abbreviation' => 'required' 
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
        if($academic->image !== 'academic.png' && file_exists(storage_path('app/public/images/'.$academic->image))) {
            unlink(storage_path('app/public/images/'.$academic->image));
        }
        $academic -> delete();

        return redirect()->route('academics.index');
    }

// Select photo of the academic
    public function selectPhoto(Academic $academic)
    {
        // dd($request);
        return view('layouts.select_photo')->with('person', $academic)->with('role', 'academics');
    }

// Upload photo of the academic
    public function uploadPhoto(UpdateAcademicRequest $request, Academic $academic)
    {
        // dd($request);
        $this->validate($request, [
            // 'name' => 'required',
            'imgFile' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);
        $imagedate = date('Ymd-His');
        $image = $request->file('imgFile');
        $imagename = 'ac_'.$academic->id.'_'.$imagedate.'.'.$image->extension();
        if($academic->image !== 'academic.png' && file_exists(storage_path('app/public/images/'.$academic->image))) {
            unlink(storage_path('app/public/images/'.$academic->image));
        }


     
        $filePath = storage_path('app/public/images');
        $img = Image::make($image->path());
        $img->fit(96, 96)->save($filePath.'/'.$imagename);
   
        // $filePath = storage_path('app/public/images');
        // $image->move($filePath, $imagename);

        $academic->update(['image'=>$imagename]);
   
        
        return redirect('academics/'.$academic->id);

        // return back()
        //     ->with('success','Image uploaded')
        //     ->with('fileName',$imagename);
    }

    // Remove photo of the academic
    public function deletePhoto(Academic $academic)
    {
        if($academic->image !== 'academic.png' && file_exists(storage_path('app/public/images/'.$academic->image))) {
            unlink(storage_path('app/public/images/'.$academic->image));
        }
        $academic->update(['image'=>'academic.png']);
        // dd($request);
        return redirect('academics/'.$academic->id);
    }
    
}
