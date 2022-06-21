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

Route::redirect('/', '/'.locale()->current(), 302);

Route::group(
    [
        'prefix' => '{locale}',
        'middleware' => ['defaultLocaleUrl'],
    ], function () {

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
// Web
//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//
// Auth
//
Route::get('/', 'Auth\LoginController@showLoginForm')
    ->name('login');

Route::post('/', 'Auth\LoginController@login')
    ->name('login.store');

Route::post('logout', 'Auth\LoginController@logout')
    ->name('logout');

Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail@')
    ->name('password.email');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
    ->name('password.request');

Route::post('password/reset', 'Auth\ResetPasswordController@reset')
    ->name('password.update');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
    ->name('password.reset');

Route::get('unauthorized', 'Auth\UnauthorizedController@index')
    ->name('unauthorized');

//
// Dashboard
//
Route::get('dashboard', 'DashboardController@index')
    ->name('dashboard');

//
// Admissions
//
Route::get('admissions', 'Admissions\AdmissionsController@index')
    ->name('admissions');

Route::get('admissions/create', 'Admissions\AdmissionsController@create')
    ->name('admissions.create');

Route::post('admissions', 'Admissions\AdmissionsController@store')
    ->name('admissions.store');

Route::get('admissions/check/{name}', 'Admissions\AdmissionsController@check')
    ->name('admissions.check');

Route::post('admissions/check', 'Admissions\AdmissionsController@checkStore')
    ->name('admissions.check.store');

Route::get('admissions/{id}/edit', 'Admissions\AdmissionsController@edit')
    ->name('admissions.edit');

Route::patch('admissions/{id}', 'Admissions\AdmissionsController@update')
    ->name('admissions.update');

Route::delete('admissions/{id}', 'Admissions\AdmissionsController@destroy')
    ->name('admissions.destroy');

    //
    // Admissions: Students
    //
    Route::get('admissions/{id}/students/create', 'Admissions\StudentsController@create')
        ->name('admissions.students.create');

    Route::post('admissions/{id}/students', 'Admissions\StudentsController@store')
        ->name('admissions.students.store');

    Route::get('admissions/{id}/students/{idStudent}/edit', 'Admissions\StudentsController@edit')
        ->name('admissions.students.edit');

    Route::patch('admissions/{id}/students/{idStudent}', 'Admissions\StudentsController@update')
        ->name('admissions.students.update');

    Route::delete('admissions/{id}/students/{idStudent}', 'Admissions\StudentsController@destroy')
        ->name('admissions.students.destroy');

    //
    // Admissions: Visits
    //
    Route::get('admissions/{id}/visits/create', 'Admissions\VisitsController@create')
        ->name('admissions.visits.create');

    Route::post('admissions/{id}/visits', 'Admissions\VisitsController@store')
        ->name('admissions.visits.store');

    Route::get('admissions/{id}/visits/{idVisit}/edit', 'Admissions\VisitsController@edit')
        ->name('admissions.visits.edit');

    Route::patch('admissions/{id}/visits/{idVisit}', 'Admissions\VisitsController@update')
        ->name('admissions.visits.update');

    Route::delete('admissions/{id}/visits/{idVisit}', 'Admissions\VisitsController@destroy')
        ->name('admissions.visits.destroy');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
// Administration
//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//
// Administration: Questions
//
Route::get('administration/admissions/questions', 'Admissions\QuestionsController@index')
    ->name('administration.admissions.questions');

Route::get('administration/admissions/questions/create', 'Admissions\QuestionsController@create')
    ->name('administration.admissions.questions.create');

Route::post('administration/admissions/questions', 'Admissions\QuestionsController@store')
    ->name('administration.admissions.questions.store');

Route::get('administration/admissions/questions/{id}/edit', 'Admissions\QuestionsController@edit')
    ->name('administration.admissions.questions.edit');

Route::patch('administration/admissions/questions/{id}', 'Admissions\QuestionsController@update')
    ->name('administration.admissions.questions.update');

Route::delete('administration/admissions/questions/{id}', 'Admissions\QuestionsController@destroy')
    ->name('administration.admissions.questions.destroy');
    //
    // Administration: Questions: Answers
    //
    Route::get('administration/admissions/questions/{id}/answers/create', 'Admissions\AnswersController@create')
        ->name('administration.admissions.questions.answers.create');

    Route::post('administration/admissions/questions/id}/answers', 'Admissions\AnswersController@store')
        ->name('administration.admissions.questions.answers.store');

    Route::get('administration/admissions/questions/{id}/answers/{idAnswer}/edit', 'Admissions\AnswersController@edit')
        ->name('administration.admissions.questions.answers.edit');

    Route::patch('administration/admissions/questions/{id}/answers/{idAnswer}', 'Admissions\AnswersController@update')
        ->name('administration.admissions.questions.answers.update');

    Route::delete('administration/admissions/questions/{id}/answers/{idAnswer}', 'Admissions\AnswersController@destroy')
        ->name('administration.admissions.questions.answers.destroy');

    //
    // Administration: Schools
    //
    Route::get('administration/schools', 'Schools\SchoolsController@index')
        ->name('administration.schools');

    Route::get('administration/schools/create', 'Schools\SchoolsController@create')
        ->name('administration.schools.create');

    Route::post('administration/schools', 'Schools\SchoolsController@store')
        ->name('administration.schools.store');

    Route::get('administration/schools/{id}/edit', 'Schools\SchoolsController@edit')
        ->name('administration.schools.edit');

    Route::patch('administration/schools/{id}', 'Schools\SchoolsController@update')
        ->name('administration.schools.update');

    Route::delete('administration/schools/{id}', 'Schools\SchoolsController@destroy')
        ->name('administration.schools.destroy');

    //
    // Administration: Language
    //
    Route::get('administration/languages', 'Languages\LanguagesController@index')
        ->name('administration.languages');

    Route::get('administration/languages/create', 'Languages\LanguagesController@create')
        ->name('administration.languages.create');

    Route::post('administration/languages', 'Languages\LanguagesController@store')
        ->name('administration.languages.store');

    Route::get('administration/languages/{id}/edit', 'Languages\LanguagesController@edit')
        ->name('administration.languages.edit');

    Route::patch('administration/languages/{id}', 'Languages\LanguagesController@update')
        ->name('administration.languages.update');

    Route::delete('administration/languages/{id}', 'Languages\LanguagesController@destroy')
        ->name('administration.languages.destroy');


//
// Administration: Courses
//
Route::get('administration/courses', 'Courses\CoursesController@index')
    ->name('administration.courses');

Route::get('administration/courses/create', 'Courses\CoursesController@create')
    ->name('administration.courses.create');

Route::post('administration/courses', 'Courses\CoursesController@store')
    ->name('administration.courses.store');

Route::get('administration/courses/{id}/edit', 'Courses\CoursesController@edit')
    ->name('administration.courses.edit');

Route::patch('administration/courses/{id}', 'Courses\CoursesController@update')
    ->name('administration.courses.update');

Route::delete('administration/courses/{id}', 'Courses\CoursesController@destroy')
    ->name('administration.courses.destroy');

    //
    // Administration: Courses: Summer Makers
    //
    Route::get('administration/courses/summer-makers', 'Courses\SummerMakersController@index')
        ->name('administration.courses.summermakers');

    Route::get('administration/courses/summer-makers/create', 'Courses\SummerMakersController@create')
        ->name('administration.courses.summermakers.create');

    Route::post('administration/courses/summer-makers', 'Courses\SummerMakersController@store')
        ->name('administration.courses.summermakers.store');

    Route::get('administration/courses/summer-makers/{id}/edit', 'Courses\SummerMakersController@edit')
        ->name('administration.courses.summermakers.edit');

    Route::patch('administration/courses/summer-makers/{id}', 'Courses\SummerMakersController@update')
        ->name('administration.courses.summermakers.update');

    Route::delete('administration/courses/summer-makers/{id}', 'Courses\SummerMakersController@destroy')
        ->name('administration.courses.summermakers.destroy');

//
// Administration: Information
//
Route::get('administration/information/courses', 'Information\CoursesController@index')
    ->name('administration.information.courses');

Route::get('administration/information/courses/create', 'Information\CoursesController@create')
    ->name('administration.information.courses.create');

Route::post('administration/information/courses', 'Information\CoursesController@store')
    ->name('administration.information.courses.store');

Route::get('administration/information/courses/{id}/edit', 'Information\CoursesController@edit')
    ->name('administration.information.courses.edit');

Route::patch('administration/information/courses/{id}', 'Information\CoursesController@update')
    ->name('administration.information.courses.update');

Route::delete('administration/information/courses/{id}', 'Information\CoursesController@destroy')
    ->name('administration.information.courses.destroy');

//
// Administration: Users
//
Route::get('administration/users', 'Users\UsersController@index')
    ->name('administration.users');

Route::get('administration/users/create', 'Users\UsersController@create')
    ->name('administration.users.create');

Route::post('administration/users', 'Users\UsersController@store')
    ->name('administration.users.store');

Route::get('administration/users/{id}/edit', 'Users\UsersController@edit')
    ->name('administration.users.edit');

Route::patch('administration/users/{id}', 'Users\UsersController@update')
    ->name('administration.users.update');

Route::delete('administration/users/{id}', 'Users\UsersController@destroy')
    ->name('administration.users.destroy');


});

