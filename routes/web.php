<?php

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
    Route::get('/change-password/', 'ProfileController@cngPsd');
    Route::post('/update-profile/', 'ProfileController@updateProfile');
});