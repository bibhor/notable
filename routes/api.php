<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Models\Doctor;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/index', 'App\Http\Controllers\UserController@index');

Route::get('/doctors', 'App\Http\Controllers\DoctorController@index');



// Route::get('doctors', function () {
//     return Doctor::all();
// });

Route::post('new_appointment/','App\Http\Controllers\AppointmentController@store');
Route::get('appointments/{doctor_id}/{day}','App\Http\Controllers\AppointmentController@index');
Route::delete('appointment/{appointment_id}','App\Http\Controllers\AppointmentController@destroy');