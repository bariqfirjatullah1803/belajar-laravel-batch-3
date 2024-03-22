<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentClass;

class StudentClassController extends Controller
{
    public function index()
    {
        $classes = StudentClass::with('students')->get();
        dd($classes);
    }
}
