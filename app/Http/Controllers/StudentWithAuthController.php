<?php

namespace App\Http\Controllers;

use App\Http\Requests\studentRequest;
use App\Models\student;
use Illuminate\Http\Request;

class StudentWithAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Student::all();
            return response()->json($data,200);
        } catch (\Throwable $th) {
            return response()->json(['erooor' => $th->getMessage()],404);
        }
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(studentRequest $request)
    {
           
        try {
            $data = new Student;
            $data->name = $request->name; 
            $data->address = $request->address; 
            $data->save();
            return response()->json(['success' => 'Data Added'],200);
        } catch (\Throwable $th) {
            return response()->json(['erooor' => $th->getMessage()],404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        try {            
            return response()->json(['data' => $student],200);
        } catch (\Throwable $th) {
            return response()->json(['erooor' => $th->getMessage()],404);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(studentRequest $request, Student $student)
    {
        try {            
            $student->name = $request->name; 
            $student->address = $request->address;
            $student->save(); 
            return response()->json(['success' => 'Data Updated'],200);
        } catch (\Throwable $th) {
            return response()->json(['erooor' => $th->getMessage()],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        try {            
            $student->delete();
            return response()->json(['success' => 'Deta Deleted'],200);
        } catch (\Throwable $th) {
            return response()->json(['erooor' => $th->getMessage()],404);
        }
    }
}
