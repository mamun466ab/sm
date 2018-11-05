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
    /*
     * Get method
     */
    Route::get('/profile/', 'ProfileController@index');
    Route::get('/edit-profile/', 'ProfileController@editProfile');
    Route::get('/change-password/', 'ProfileController@passworChange');
    
    Route::get('/add-teacher/', 'AdminController@addTeacher');
    Route::get('/add-student/', 'AdminController@addStudent');
    Route::get('/user-activation/', 'AdminController@activeUser');
    Route::get('/add-subject/', 'AdminController@addSubject');
    Route::get('/view-subject/', 'AdminController@viewSubject');
    Route::get('/change-subject/', 'AdminController@changeSubject');
    Route::get('/create-routine/', 'AdminController@createRoutine');
    Route::get('/block-unblock/', 'AdminController@blockUnblock');
    Route::get('/exam-time/', 'AdminController@exmTime');
    Route::get('/exam-routine/', 'AdminController@exmRoutine');
    Route::get('/add-number/', 'AdminController@addNumber');
    
    Route::get('/select-subject/', 'CommonController@selectSubject');
    Route::get('/student-list/', 'CommonController@studentList');
    Route::get('/teacher-list/', 'CommonController@teacherList');
    Route::get('/view-routine/', 'CommonController@viewRoutine');
    Route::get('/view-exam-routine/', 'CommonController@viewExmRoutine');
    
    /*
     * Route match
     */
    Route::match(['get', 'post'], '/class-time/', 'AdminController@classTime');
    
    /*
     * For all update
     */
    Route::post('/subject-change/', 'AdminUpdateController@subjectChange');
    Route::get('/user-activate/{usrid}', 'AdminUpdateController@userActivate');
    Route::get('/block/{usrid}', 'AdminUpdateController@userBlock');
    Route::get('/unblock/{usrid}', 'AdminUpdateController@userUnblock');
    
    /*
     * Post method
     */
    Route::post('/update-profile/', 'ProfileController@updateProfile');
    Route::post('/password-change/', 'ProfileController@changePassword');
    
    Route::post('/subject-add/', 'AdminInsertController@addSubject');
    Route::post('/insert-class-time/', 'AdminInsertController@classTime');
    Route::post('/routine-create/', 'AdminInsertController@routineCreate');
    Route::post('/exam-time/', 'AdminInsertController@examTime');
    Route::post('/create-exm-routine/', 'AdminInsertController@crtExmRtn');
    Route::post('/insert-number/', 'AdminInsertController@insrtNum');
    
    Route::post('/select-subject/', 'CommonInsertController@selectSubject');
    /*
     * For ajax
     */
    Route::get('/list-student/{id}', 'AjaxController@listStudent');
    Route::get('/unbolock-block/{usrid}', 'AjaxController@unblockBlock');
    Route::get('/student-list-option/{id}', 'AjaxController@listStudentOption');
    Route::get('/subject-view/{id}', 'AjaxController@subjectView');
    Route::get('/selected-subject/{id}', 'AjaxController@selectedSubject');
    Route::get('/class-numbr/{num}', 'AjaxController@classNumber');
    Route::get('/exam-times/{num}', 'AjaxController@examTimes');
    Route::get('/exm-rtn/{num}', 'AjaxController@exmRtn');
    Route::get('/cls-rtn/{num}', 'AjaxController@clsRtn');
    Route::get('/add-number-ajax/{stdid}', 'AjaxController@addNumber');
    
    /*
     * For delete
     */
    Route::get('/delete-class-time/{sclcd}', 'DeleteController@deleteClassTime');
    
});

//Super Admin Area ==============================
Route::get('/sm-super-admin/', 'SuperAdminController@index');
Route::post('/super-admin-login/', 'SuperAdminController@superAdminLogin');
Route::get('/super-dashboard/', 'SuperAdminController@super_dashboard');

Route::middleware('superAdmin')->group(function(){
	//GET Methods ============
	Route::get('/logout-super/', 'SuperAdminController@logoutSuper');

	Route::get('/admin-request-view', 'SuperAdminController@admin_req_view');
	Route::get('/admin-approve/{id}', 'SuperAdminController@admin_approve');
	Route::get('/admin-delete/{id}', 'SuperAdminController@admin_delete');
	Route::get('/make-admin/{id}/{sclcd}', 'SuperAdminController@make_admin');

	Route::get('/school-admin-view/{id}', 'SuperAdminController@scl_admin_view');
	Route::get('/school-teachers-view/{sclcd}', 'SuperAdminController@scl_tcr_view');
	Route::get('/teacher-details/{id}', 'SuperAdminController@teacher_details');


	Route::get('/admin-active-view', 'SuperAdminController@admin_active_view');	
	Route::get('/admin-deactivate/{id}', 'SuperAdminController@admin_deactivate');

	//Route::get('registered-school-view', 'SuperAdminController@regis_scl_view');
	Route::get('/school-details/{id}', 'SuperAdminController@school_details');

	Route::get('/country-view', 'SuperAdminController@country_view');
	Route::get('/country-edit/{id}', 'SuperAdminController@country_edit');
	Route::get('/country-delete/{id}', 'SuperAdminController@country_delete');
	Route::get('/division-view', 'SuperAdminController@division_view');
	Route::get('/division-edit/{id}', 'SuperAdminController@division_edit');
	Route::get('/division-delete/{id}', 'SuperAdminController@division_delete');

	Route::get('/district-view', 'SuperAdminController@district_view');
	Route::get('/district-edit/{id}', 'SuperAdminController@district_edit');
	Route::get('/district-delete/{id}', 'SuperAdminController@district_delete');

	Route::get('/thana-view', 'SuperAdminController@thana_view');
	Route::get('/thana-edit/{id}', 'SuperAdminController@thana_edit');
	Route::get('/thana-delete/{id}', 'SuperAdminController@thana_delete');

	//Post methods============
	Route::post('/country-create', 'SuperAdminController@country_create');
	Route::post('/country-update', 'SuperAdminController@country_update');

	Route::post('/division-create', 'SuperAdminController@division_create');
	Route::post('/division-update', 'SuperAdminController@division_update');

	Route::post('/district-create', 'SuperAdminController@district_create');
	Route::post('/district-update', 'SuperAdminController@district_update');

	Route::post('/thana-create', 'SuperAdminController@thana_create');
	Route::post('/thana-update', 'SuperAdminController@thana_update');

	Route::match(['get', 'post'],'/find-place', 'SuperAdminController@find_place');

	Route::match(['get', 'post'],'search-school-list', 'SuperAdminController@search_scl_list');
});