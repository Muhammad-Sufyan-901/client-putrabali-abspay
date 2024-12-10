<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\RecapitulationController;
use App\Http\Controllers\StudentCourseController;

Route::get('/dashboard', function () {
    return view('dashboard');
});

// students
Route::resource('/students', StudentController::class);
Route::post('/students/search', [StudentController::class, 'searchStudentByNisOrName'])->name('students.search');
Route::post('/teachers/search', [TeacherController::class, 'searchTeacherByNameOrAlias'])->name('teachers.search');
Route::get('/student/payment/{id}', [PaymentController::class, 'getStudentPayment'])->name('student.payment');
Route::get('/students-schedules-check', [ScheduleController::class, 'index'])->name('students-schedules-check');
Route::get('/students-schedules', [ScheduleController::class, 'getStudentsSchedules'])->name('students.schedules');
Route::get('/enrollments', [EnrollmentController::class, 'index']);
Route::post('/enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');
Route::get('/students/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
Route::get('/students/payment/form', [PaymentController::class, 'index']);
Route::post('/students/payment/select', [PaymentController::class, 'paymentForm']);
Route::post('/students/payment/search', [PaymentController::class, 'searchStudentByNisOrName']);

// Teacher
Route::resource('/teachers', TeacherController::class);


// courses
Route::resource('/courses', CourseController::class);
Route::post('/courses/search', [CourseController::class, 'search'])->name('courses.search');


// payments
Route::resource('/payments', PaymentController::class);
Route::post('/payments/search', [PaymentController::class, 'searchStudentByNisOrName'])->name('payments.search');
Route::get('/formPembayaran/print/{id}', [PaymentController::class, 'formPembayaranPrint'])->name('formPembayaran.print');
Route::get('/public/payments', [PaymentController::class, 'checkPaymentFromParents']);
Route::get('/public/payments/{id}', [PaymentController::class, 'getStudentPaymentFromParents']);

// absences
Route::get('/absences', [AbsenceController::class, 'allCourses'])->name('absences.index');
Route::post('/absence/courses/search', [AbsenceController::class, 'searchCourses'])->name('absence.courses.search');

Route::post('/absences/search', [AbsenceController::class, 'searchCourse'])->name('absences.search');

Route::get('/absences/{id}', [AbsenceController::class, 'absenceForm'])->name('absences.show');

Route::post('/absences/store', [AbsenceController::class, 'store'])->name('absences.store');


// Recapitulation

Route::get('/recapitulations', [RecapitulationController::class, 'index']);
Route::post('/recapitulations/payment', [PaymentController::class, 'paymentRecapitulation'])->name('recapitulations.payment');
Route::post('/students/monthly-paid-unpaid', [PaymentController::class, 'paidAndUnpaidStudentsMonthly']);


// UPDATED VIEWS
Route::get('/updated-students', function () {
    return view('pages.students.index')->with('error', 'Fill all required fields!');
});

Route::get('/sufyan', function () {
    return view('update-views.pages.students.index')->with('activeRoute', 'students');
});


// Ini Route Baru Dari Saya Buat Halaman Student Detail (Statis)
Route::get('/updated-students/detail/{id}', function () {
    return view('update-views.pages.students.detail')->with('activeRoute', 'students');
});


// Route::get('/absences' ,[AbsenceController::class, 'allCourses']);

// Ini Route Baru Dari Saya Buat Halaman Input Absen (Statis)
Route::get('/absences/input/{id}', [AbsenceController::class, 'absenceInput'])->name('absences.input');

Route::get('/test', [StudentController::class, 'studentPaginationTest']);
