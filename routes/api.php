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

	Route::post('/admin/skill', 'SkillsController@createSkill');
	Route::delete('/admin/skill/{id}', 'SkillsController@deleteSkill');
	Route::get('/admin/skill/{id}', 'SkillsController@getSkill');
	Route::get('/admin/skill', 'SkillsController@getAll');

Route::post('/auth/register', 'AuthController@register');

Route::post('auth/login', 'AuthController@login');
