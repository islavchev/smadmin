<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use App\Models\ContactInfo;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
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
        $students = Student::orderBy('id')->paginate(15);
        return view('students.index', ['students'=>$students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        //

        // dd($request); 

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);


        $teacher = Student::create([
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'date_of_birth' => $request->input('date_of_birth'),
        ]);

        return redirect('students');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
        return view('students.show')->with('student', $student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
        return view('students.edit')->with('student', $student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $student -> update($request -> all());

        return redirect('students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
        if($student->image !== 'student.png' && file_exists(storage_path('app/public/images/'.$student->image))) {
            unlink(storage_path('app/public/images/'.$student->image));
        }
        $student -> delete();

        return redirect()->route('students.index');
    }

// Select photo of the student
    public function selectPhoto(Student $student)
    {
        // dd($request);
        return view('layouts.select_photo')->with('person', $student)->with('role', 'students');
    }

// Upload photo of the student
    public function uploadPhoto(UpdateStudentRequest $request, Student $student)
    {
        // dd($request);
        $this->validate($request, [
            // 'name' => 'required',
            'imgFile' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);
        $imagedate = date('Ymd-His');
        $image = $request->file('imgFile');
        $imagename = 'st_'.$student->id.'_'.$imagedate.'.'.$image->extension();
        if($student->image !== 'student.png' && file_exists(storage_path('app/public/images/'.$student->image))) {
            unlink(storage_path('app/public/images/'.$student->image));
        }


     
        $filePath = storage_path('app/public/images');
        $img = Image::make($image->path());
        $img->fit(96, 96)->save($filePath.'/'.$imagename);
   
        // $filePath = storage_path('app/public/images');
        // $image->move($filePath, $imagename);

        $student->update(['image'=>$imagename]);
   
        
        return redirect('students/'.$student->id);

        // return back()
        //     ->with('success','Image uploaded')
        //     ->with('fileName',$imagename);
    }

    // Remove photo of the student
    public function deletePhoto(Student $student)
    {
        if($student->image !== 'student.png' && file_exists(storage_path('app/public/images/'.$student->image))) {
            unlink(storage_path('app/public/images/'.$student->image));
        }
        $student->update(['image'=>'student.png']);
        // dd($request);
        return redirect('students/'.$student->id);
    }


    public function detachGroup(Student $student, Group $group){
       
        $student->groups()->detach($group->id);

        return back()->with('student', $student);
    }

    public function attachGroups(UpdateStudentRequest $request, Student $student){
       
        // dd($group);
        $student->groups()->attach($request->groupIds);

        return back()->with('student', $student);
    }

    public function addGroups(Student $student){
        $groups = Group::get();
        return view('students.add_groups')->with(['groups' => $groups, 'student'=>$student]);
    }
}
