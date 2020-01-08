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

Route::group(['middleware' => ['auth']], function () {
    Route::get('category/{category}/show', 'CategoryController@show')->name('category.show');

    Route::group(['prefix' => 'courses'], function () {
        Route::get('/', 'CourseController@index')->name('course.index');
        Route::get('/{course}/show', 'CourseController@show')->name('course.show');
        Route::get('/{course}/history', 'CourseController@history')->name('course.history');
    });
    Route::group(['prefix' => 'subjects'], function () {
        Route::post('/{subject}/show', 'SubjectController@show')->name('subject.show');
        Route::post('/{subject}/history', 'SubjectController@history')->name('subject.history');
    });

    Route::get('/users/{profile}/show', 'UserController@show')->name('user.show');

    Route::group(['prefix' => '/users'], function () {
        Route::post('/{user}/update', 'UserController@update')->name('user.update');
    });

    Route::group(['prefix' => '/report'], function () {
        Route::post('/store', 'ReportController@store')->name('report.store');
        Route::post('/show', 'ReportController@show')->name('report.show');
    });

    Route::get('calendars', 'CalendarController@show')->name('calendar.show');

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/tree', 'CategoryController@tree')->name('category.tree');

    Route::group(['prefix' => '/mail'], function () {
        Route::get('/basic', 'MailController@basic')->name('report.basic');
        Route::get('/html', 'MailController@html')->name('mail.html');
        Route::get('/attach', 'MailController@attach')->name('mail.attach');
        Route::get('/more', 'MailController@more')->name('mail.more');
        Route::get('/queue', 'MailController@queue')->name('mail.queue');
    });

    Route::group(['prefix' => '/chart'], function () {
        Route::get('/courseByYear', 'ChartController@year')->name('chart.year');
        Route::post('/courseByMonth', 'ChartController@month')->name('chart.month');
    });

    Route::group(['prefix' => '/notify'], function () {
        Route::post('/markAsRead', 'UserController@markAsRead')->name('user.markAsRead');
        Route::post('/markAll', 'UserController@markAll')->name('user.markAll');
    });

    Route::get('notification', 'SendNotification@create')->name('notification.create');
    Route::post('notification', 'SendNotification@store')->name('notification.store');
    Route::get('/test', function () {
        return view('client.notification.test');
    });
    Route::get('test1', 'MailController@test')->name('notification.store');
});
