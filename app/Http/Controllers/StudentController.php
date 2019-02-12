<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    //
    public function index(){
    	$students = Student::all();
       	return view('index')->with('students',$students);
    }

    public function create(){
    	//$students = Student::all();
       	return view('create');
    }


     public function edit($id){
     	$student = Student::find($id);
       	return view('edit')->with('student',$student);
    }


    public function store(Request $request){
      //Check validity
      $this->validate($request,[
        'name'            => 'required|string|max:10',
        'registration_id' => 'required|integer',
        'department_name' => 'required|string',
        'info'            => 'nullable',

      ]);
    	//Insert data into student table
    	//dd('Submitted');
    	$student = new Student;
    	$student->name = $request->name;
    	$student->department_name = $request->department_name;
    	$student->registration_id= $request->registration_id;
    	$student->info = $request->info;

    	$student->save();

    	return redirect()->route('index');
    }


    public function update(Request $request,$id){
    	$student = Student::find($id);

    	$student->name = $request->name;
    	$student->department_name = $request->department_name;
    	$student->registration_id= $request->registration_id;
    	$student->info = $request->info;

    	$student->save();

    	return redirect()->route('index');

    }

     public function delete($id){

    	$student = Student::find($id);
    	$student->delete();
    	return redirect()->route('index');

    }
}
