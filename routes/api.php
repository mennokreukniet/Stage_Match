<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

	

Route::post('/auth/register', 'AuthController@register');

Route::post('auth/login', 'AuthController@login');

Route::get('location/{id?}', 'LocationController@index');

Route::group(['middleware' => 'auth'], function(){
    Route::post('user/skill/level', 'Student_SkillController@skillLevel');
    Route::delete('user/skill/{id}', 'Student_SkillController@deleteSkill');
    Route::post('user/skill', 'Student_SkillController@addSkill');
    Route::post('auth/logout', 'AuthController@logout');
    Route::post('user/edit', 'UserController@editUser');
    Route::get('user', 'UserController@getUser');
    Route::get('student', 'StudentController@getStudent');
    Route::get('company', 'CompanyController@getCompany');
    Route::get('skill/{keyword}', 'SkillsController@searchSkill');
});

Route::group(['middleware' => 'role:admin'], function(){
	Route::post('/admin/skill', 'SkillsController@createSkill');
	Route::delete('/admin/skill/{id}', 'SkillsController@deleteSkill');
	Route::get('/admin/skill/{id}', 'SkillsController@getSkill');
	Route::get('/admin/skill', 'SkillsController@getAll');
	Route::put('/admin/skill/{id}', 'SkillsController@editSkill');
    Route::get('/admin/location', 'LocationController@getAll');
});

Route::apiResource('internship', 'InternshipController')->only(['show']);

Route::group(['middleware' => 'role:company'], function () {
    Route::post('/internship/skill', 'InternshipCompanyController@addSkill');
    Route::delete('/internship/skill/{skill_id}', 'InternshipCompanyController@deleteSkill');
    Route::post('/internship/{internship}/image', 'InternshipCompanyController@uploadImage');
    Route::post('/internship/skill/level', 'InternshipCompanyController@skillLevel');
    Route::apiResource('/internship', 'InternshipCompanyController')->only(['index', 'store', 'update', 'destroy']);
});

Route::group(['middleware' => 'role:student'], function(){
    Route::get('match', 'MatchController@calculateInternshipScores');
});