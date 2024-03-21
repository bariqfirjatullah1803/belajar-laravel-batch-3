<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentClass;

class Student extends Model
{
    use HasFactory;
    // protected $table = "students";
    protected $fillable = ['name', 'address', 'class_id'];

    public function studentClass(){
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }
}
