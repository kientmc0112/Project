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

Route::group(['prefix' => 'courses'], function () {
    Route::get('/', 'CourseController@index')->name('course.index');;
    Route::get('/{id}/show', 'CourseController@show')->name('course.show');;
});

Route::get('category/{id}/show', 'CategoryController@show')->name('category.show');;
