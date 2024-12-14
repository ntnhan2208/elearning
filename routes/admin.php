<?php

use Illuminate\Support\Facades\Route;

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

Route::namespace('admin')->group(function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'LoginController@login')->name('admin.login.submit');
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::group(['middleware' => 'locale'], function() {
            Route::get('/', 'HomeController@index');
            Route::get('/home', 'HomeController@index')->name('dashboard');
            Route::get('change-language/{language}', 'HomeController@changeLanguage')->name('admin.change-language');
            Route::post('/logout', 'AuthController@logout')->name('admin.logout');
            Route::resource('/languages', 'LanguageController');
            Route::get('change_profile', 'AdminController@changeProfile')->name('change_profile');
            Route::get('change_password', 'AdminController@changePassword')->name('change_password');
            Route::post('update_password', 'AdminController@updatePassword')->name('update_password');
            Route::resource('/admins', 'AdminController');
            Route::resource('/teachers', 'TeacherController');
            Route::resource('/students', 'StudentController');
            Route::resource('/classes', 'ClassesController');
            Route::resource('/chapters', 'ChapterController');
            Route::resource('/reviews', 'ReviewController');
            Route::get('/reviews/chapter/{subject_id}', 'ReviewController@indexOfChapter')->name('index-chapter');
            Route::get('/reviews/chapter/lesson/{chapter_id}', 'ReviewController@indexOfLesson')->name('index-lesson');
            Route::resource('/tests', 'TestController');
            Route::resource('/subjects', 'SubjectController');
            Route::resource('/lessons', 'LessonController');
            Route::resource('/student-tests', 'StudentTestController');
            Route::resource('/student-reviews', 'StudentReviewController');
            Route::delete('/detach-tests/{testId}/{reviewId}', 'TestController@detachTests')->name('detach-tests');

        });
        Route::get('/clear-cache', function() {
            Artisan::call('cache:clear');
            return redirect()->route('dashboard');
        });
    });
});

