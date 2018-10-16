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

Route::group(['middleware' => 'auth'], function(){
  Route::post('user/skill', 'Student_SkillController@addSkill');
  Route::post('auth/logout', 'AuthController@logout');
  Route::post('user/edit', 'UserController@editUser');
  Route::get('user', 'UserController@getUser');
  Route::get('student', 'StudentController@getStudent');
  Route::get('company', 'CompanyController@getCompany');
  Route::get('user/skill/{keyword}', 'SkillsController@searchSkill');
  Route::apiResource('internship', 'InternshipController');
});

Route::group(['middleware' => 'admin'], function(){
	Route::post('/admin/skill', 'SkillsController@createSkill');
	Route::delete('/admin/skill/{id}', 'SkillsController@deleteSkill');
	Route::get('/admin/skill/{id}', 'SkillsController@getSkill');
	Route::get('/admin/skill', 'SkillsController@getAll');
	Route::put('/admin/skill/{id}', 'SkillsController@editSkill');
});
