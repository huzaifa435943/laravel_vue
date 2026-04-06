<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});




Route::get('student', [StudentController::class, 'index'])->name('students');
Route::get('student/create', [StudentController::class, 'create'])->name('student.create');
Route::post('student/store', [StudentController::class, 'store'])->name('student.store');
Route::get('student/edit/{student}', [StudentController::class, 'edit'])->name('student.edit');
Route::put('student/{student}', [StudentController::class, 'update'])->name('student.update');
Route::delete('student/{student}', [StudentController::class, 'destroy'])->name('student.destroy');



require __DIR__.'/settings.php';
