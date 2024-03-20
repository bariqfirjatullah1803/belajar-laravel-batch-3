<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Student::create([
        //     'name' => 'Student 1',
        //     'address' => 'Malang'
        // ]);

        Student::factory()->count(50)->create();
    }
}