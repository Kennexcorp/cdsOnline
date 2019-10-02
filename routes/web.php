<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', function () {
    return redirect()->to('/login');
});

Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay'); 

Route::get('/payment/callback', 'PaymentController@handleGatewayCallback')->name('callback');

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function() {

    Route::get('/home', 'HomeController@dashboard')->name('home');

    Route::resource('supervisors', 'SupervisorController')->except('create');

    Route::post('supervisors/add_group', 'SupervisorController@addGroup')->name('supervisors.addGroup');

    Route::post('supervisors/remove_group', 'SupervisorController@removeGroup')->name('supervisors.removeGroup');

    Route::resource('members', 'MemberController');

    Route::resource('profile', 'ProfileController');

    Route::resource('groups', 'GroupController');

    Route::resource('attendance', 'AttendanceController');

    Route::post('groups/update_supervisor_group', 'GroupController@updateSupervisorGroup')->name('groups.updateSupervisorGroup');
    
    Route::prefix('setup')->group(function () {

        Route::get('index', 'SetupController@index')->name('setup.index');

        Route::get('fees', 'SetupController@regFeeSetup')->name('setup.regForm');

        Route::post('fees', 'SetupController@registrationFee')->name('setup.fees');

        Route::get('gateway', 'SetupController@gatewayToggle')->name('setup.gateway');

    });

    Route::prefix('payments')->group(function () {

        Route::get('registration', 'PaymentController@index')->name('payment.index');
    });

    
});

