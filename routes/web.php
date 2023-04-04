<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmitCardController;
use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/


Route::controller(AdmitCardController::class)->group(function () {

	Route::get('/', function () {
		return redirect()->route('admitCard.index');
	});

	Route::get('/admitCard/upload-image/{admitCard}', 'upload_image')->name('admitCard.upload_image');

	Route::post('/admitCard/save-image/{admitCard}', 'save_image')->name('admitCard.save_image');

	Route::get('/admitCard/all', 'admit_cards')->name('admitCard.admit_cards');
});

Route::resource('admitCard', AdmitCardController::class);
//result
Route::controller(ResultController::class)->group(function () {
	Route::get('/student/result', 'stu_result');
	Route::post('/student/get-student-rolls', 'get_student_rolls')->name('student.get_student_rolls');
	Route::post('/student/marksheet', 'show_result')->name('student.marksheet');
	Route::get('/student/{id}', 'print_marksheet')->name('print_ms');
	Route::get('student', 'set_stu_position');
	Route::get('/all-result', 'all_result');
});
Route::resource('result', ResultController::class)->middleware('auth');

Route::group(['middleware' => 'prevent-back-history'], function () {
	Auth::routes();
});
