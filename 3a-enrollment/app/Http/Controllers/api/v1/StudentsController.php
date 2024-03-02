<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Students;
use App\Http\Requests\v1\UpdateStudentsRequest;
use App\Http\Requests\v1\StoreStudentsRequest;


use App\Http\Controllers\Controller;

class StudentsController extends Controller
{
    public function index()
    {
        return Students::paginate(10);
    }

    public function store(StoreStudentsRequest $request)
    {
        
        Students::create($request->all());
        
        return [
            'message'=>'Student Enrolled successfully'
        ];
    }

    public function show(Students $students,$id)
    {
        return Students::find($id);
    }

    public function update(UpdateStudentsRequest $request,$id)
    {
    $student = Students::find($id); 

    $student->update([
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name,
        'last_name' => $request->last_name,
        'age' => $request->age,
        'province' => $request->province,
        'city' => $request->city,
        'barangay' => $request->barangay,
        'department' => $request->department,
    ]);
    if ($student->wasChanged()) {
        return response()->json(['message' => 'Student updated successfully']);
    } else {
        return response()->json(['message' => 'Student details unchanged, no update performed']);
    }
    }

    public function destroy(Students $students,$id)
    {
        $student = Students::find($id);

        if($student){

            $student->delete();

            return response()->json(['message' => 'Student successfully deleted!'], 200);
        }else{
            return response()->json(['message' => 'Student not found.'], 404);
        }
    }
}
