<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'SigninController@index');
Route::get('/login/', 'SigninController@login');
Route::get('/school-registration/', 'RegController@index');
Route::get('/student-registration/', 'RegController@student');
Route::get('/teacher-registration/', 'RegController@teacher');

//for create location
Route::get('/division/{id}', 'LocationController@division');
Route::get('/district/{id}', 'LocationController@district');
Route::get('/thana/{id}', 'LocationController@thana');


Route::get('/logout/', 'SigninController@signOut');


Route::post('/school-data/', 'RegController@schoolData');
Route::post('/teacher-data/', 'RegController@teacherData');
Route::post('/student-data/', 'RegController@studentData');
Route::post('/user-login/', 'SigninController@usrLogin');

Route::middleware('userCheck')->group(function(){
    Route::get('/profile/', 'ProfileController@index');
    Route::get('/edit-profile/', 'ProfileController@editProfile');
});