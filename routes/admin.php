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
            Route::get('/classes/export/{id}', 'ClassesController@export')->name('classes.export');
            Route::get('/classes/process/{id}', 'ClassesController@process')->name('classes.process');
            Route::get('/classes/process-show/{studentId}/{subjectId}', 'ClassesController@showProcess')->name('classes.process-show');
            Route::get('/classes/process-detail/{studentId}/{chapterId}', 'ClassesController@detailProcess')->name('classes.process-detail');
            Route::post('/classes/add-students/{class_id}', 'ClassesController@addStudents')->name('classes.add-students');
            Route::delete('/classes/update-students/{class_id}/{student_id}', 'ClassesController@deleteStudent')->name('classes.delete-student');
            Route::resource('/chapters', 'ChapterController');
            Route::resource('/reviews', 'ReviewController');
            Route::get('/reviews/chapter/{subject_id}', 'ReviewController@indexOfChapter')->name('index-chapter');
            Route::get('/reviews/chapter/lesson/{chapter_id}', 'ReviewController@indexOfLesson')->name('index-lesson');
            Route::get('/tests/chapter/{subject_id}', 'TestController@indexOfSubject')->name('test-index-subject');
            Route::get('/tests/chapter/lesson/{chapter_id}', 'TestController@indexOfChapter')->name('test-index-chapter');
            Route::resource('/tests', 'TestController');
            Route::get('/tests/create-test/{chapterId}', 'TestController@createWithChapterId')->name('create-test');
            Route::resource('/subjects', 'SubjectController');
            Route::resource('/lessons', 'LessonController');
            Route::resource('/student-tests', 'StudentTestController');
            Route::resource('/student-reviews', 'StudentReviewController');
            Route::resource('/student-dashboard', 'DashboardController');
            Route::delete('/detach-tests/{testId}/{reviewId}', 'TestController@detachTests')->name('detach-tests');

            Route::get('student/reviews/chapter/{subject_id}', 'StudentReviewController@indexOfChapter')->name('index-chapter-student');
            Route::get('student/reviews/chapter/lesson/{chapter_id}', 'StudentReviewController@indexOfLesson')->name('index-lesson-student');
            Route::get('student/tests/chapter/{subject_id}', 'StudentTestController@indexOfChapter')->name('index-chapter-student-test');
            Route::get('student/tests/subject/chapter/{chapter_id}', 'StudentTestController@indexOfTest')->name('index-student-test');

        });
        Route::get('/clear-cache', function() {
            Artisan::call('cache:clear');
            return redirect()->route('dashboard');
        });
    });
});

