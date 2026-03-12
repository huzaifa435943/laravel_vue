<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
    // Display all students
    public function index()

    {
        $students = Student::all();

        return Inertia::render('Students/Index', compact('students'));
    }

    // Show create form
    public function create()
    {
        return Inertia::render('Students/Create');
    }



    // Store new student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'age'   => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Move image to public/students folder
            $image->move(public_path('students'), $imageName);

            // Save image path
            $validated['image'] = 'students/' . $imageName;
        }

        Student::create($validated);

        return redirect()->route('students')
            ->with('success', 'Student created successfully.');
    }

    // Show edit form
    public function edit(Student $student)
    {
        return Inertia::render('Students/Edit', [
            'student' => $student
        ]);
    }

    // Update student
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'age'   => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {

            // Delete old image
            if ($student->image && file_exists(public_path($student->image))) {
                unlink(public_path($student->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            $image->move(public_path('students'), $imageName);

            $validated['image'] = 'students/' . $imageName;
        }

        $student->update($validated);

        return redirect()->route('students')
            ->with('success', 'Student updated successfully.');
    }

    // Delete student
    public function destroy(Student $student)
    {
        if ($student->image && file_exists(public_path($student->image))) {
            unlink(public_path($student->image));
        }

        $student->delete();

        return redirect()->back()
            ->with('success', 'Student deleted successfully.');
    }
}