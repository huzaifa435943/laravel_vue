<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'name' => 'John Doe',
            'age' => 20,
        ]);

        Student::create([
            'name' => 'Jane Smith',
            'age' => 22,
        ]);

        Student::create([
            'name' => 'Bob Johnson',
            'age' => 19,
        ]);
    }
}
