<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Admin" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['checkAdminLogin','auth']], function () {
    Route::get('', [
        'as' => 'admin.dashboard.index',
        'uses' => 'DashboardController@index'
    ]);
    Route::resource('categories', 'CategoryController', [
        'as' => 'admin',
        'parameters' => ['categories' => 'id']
    ]);
    Route::resource('courses', 'CourseController', [
        'as' => 'admin',
        'parameters' => ['courses' => 'id']
    ]);
    Route::resource('subjects', 'SubjectController', [
        'as' => 'admin',
        'parameters' => ['subjects' => 'id']
    ]);
    Route::resource('tasks', 'TaskController', [
        'as' => 'admin',
        'parameters' => ['tasks' => 'id']
    ]);
    Route::resource('users', 'UserController', [
        'as' => 'admin',
        'parameters' => ['users' => 'id']
    ]);
    Route::put('users/{id}/finish_course', 'UserController@finishCourse')->name('finishCourse');
    Route::put('users/{id}/finish_subject', 'UserController@finishSubject')->name('finishSubject');
    Route::put('users/{id}/finish_task', 'UserController@finishTask')->name('finishTask');
    Route::post('users/{id}/add_user_course', 'UserController@addUserCourse')->name('addUserCourse');
    Route::post('users/{id}/add_user_subject', 'UserController@addUserSubject')->name('addUserSubject');
    Route::post('users/{id}/add_user_task', 'UserController@addUserTask')->name('addUserTask');
    Route::delete('users/{id}/delete_user_course', 'UserController@deleteUserCourse')->name('deleteUserCourse');
    Route::delete('users/{id}/delete_user_subject', 'UserController@deleteUserSubject')->name('deleteUserSubject');
    Route::delete('users/{id}/delete_user_task', 'UserController@deleteUserTask')->name('deleteUserTask');

    Route::post('subjects/{id}/show', 'SubjectController@postShow')->name('postShowSubject');
    Route::put('subjects/{id}/show', 'SubjectController@finishSubject')->name('putFinishSubject');

    Route::post('courses/{id}/show', 'CourseController@postShow')->name('postShowCourse');
    Route::put('courses/{id}/show', 'CourseController@finishCourse')->name('postFinishCourse');

    Route::post('tasks/{id}/show', 'TaskController@postShow')->name('postShowTask');
    Route::put('tasks/{id}/show', 'TaskController@finishCourse')->name('putFinishTask');
});
