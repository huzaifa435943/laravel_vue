<?php

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('students index page loads', function () {
    $response = $this->get('/student');

    $response->assertStatus(200);
});

test('student can be created', function () {
    $studentData = [
        'name' => 'Test Student',
        'age' => 25,
    ];

    $response = $this->post('/student/store', $studentData);

    $response->assertRedirect('/student');
    $this->assertDatabaseHas('students', $studentData);
});

test('student can be updated', function () {
    $student = Student::factory()->create();

    $updatedData = [
        'name' => 'Updated Name',
        'age' => 30,
    ];

    $response = $this->put("/student/{$student->id}", $updatedData);

    $response->assertRedirect('/student');
    $this->assertDatabaseHas('students', $updatedData);
});

test('student can be deleted', function () {
    $student = Student::factory()->create();

    $response = $this->delete("/student/{$student->id}");

    $response->assertRedirect();
    $this->assertDatabaseMissing('students', ['id' => $student->id]);
});
