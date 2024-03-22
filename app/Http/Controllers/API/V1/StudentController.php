<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $students = Student::with('studentClass')->get();

    return response()->json([
      "success" => true,
      "code" => 200,
      "message" => "Get all data successfully",
      "data" => $students
    ], 200);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'address' => 'required',
      'class_id' => 'required|numeric'
    ]);

    if ($validator->fails()) {
      return response()->json([
        "success" => false,
        "code" => 422,
        "message" => "Validation error.",
        "data" => $validator->errors()
      ], 422);
    }

    $student = Student::create([
      'name' => $request->name,
      'address' => $request->address,
      'class_id' => $request->class_id
    ]);

    return response()->json([
      "success" => true,
      "code" => 201,
      "message" => "Create data successfully",
      "data" => $student
    ], 201);
  }

  /**
   * Display the specified resource.
   */
  public function show($student)
  {
    try {
      $student = Student::with('studentClass')->findOrFail($student);
    } catch (ModelNotFoundException) {
      return response()->json([
        "success" => false,
        "code" => 404,
        "message" => "Data not found.",
      ], 404);
    }

    return response()->json([
      "success" => true,
      "code" => 200,
      "message" => "Get data by id successfully",
      "data" => $student
    ], 200);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $student)
  {
    try {
      $student = Student::findOrFail($student);
    } catch (ModelNotFoundException) {
      return response()->json([
        "success" => false,
        "code" => 404,
        "message" => "Data not found.",
      ], 404);
    }

    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'address' => 'required',
      'class_id' => 'required|numeric'
    ]);

    if ($validator->fails()) {
      return response()->json([
        "success" => false,
        "code" => 422,
        "message" => "Validation error.",
        "data" => $validator->errors()
      ], 422);
    }

    $student->update([
      'name' => $request->name,
      'address' => $request->address,
      'class_id' => $request->class_id
    ]);

    return response()->json([
      "success" => true,
      "code" => 200,
      "message" => "Update data successfully",
      "data" => $student
    ], 200);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($student)
  {
    try {
      $student = Student::findOrFail($student);
    } catch (ModelNotFoundException) {
      return response()->json([
        "success" => false,
        "code" => 404,
        "message" => "Data not found.",
      ], 404);
    }

    $student->delete();

    return response()->json([
      "success" => true,
      "code" => 200,
      "message" => "Delete data successfully",
      "data" => null
    ], 200);
  }
}
