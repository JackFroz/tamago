<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//authentication endpoints
Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

Route::middleware('auth:sanctum')->group(function () {
    //authentication endpoints
    Route::get('/logout', 'Api\UserController@logout');
    Route::post('/change-password', 'Api\UserController@changePassword');
    Route::post('/change-first-name', 'Api\UserController@changeFirstName');
    Route::post('/change-last-name', 'Api\UserController@changeLastName');

    //user endpoints
    Route::get('/user/{user}/projects', 'Api\UserController@projects');
    Route::get('/user', 'Api\UserController@profile');
    
    // Route::get('/user/{user}/project-members', 'Api\UserController@projects');

    //project endpoints
    Route::resource('/project', 'Api\ProjectController');
    Route::get('/project/{project}/project-divisions', 'Api\ProjectController@projectDivisions');
    Route::get('/project/{project}/project-members', 'Api\ProjectController@projectMembers');

    //project-division endpoints
    Route::resource('/project-division', 'Api\ProjectDivisionController');
    Route::get('/project-division/{project-division}/project-members', 'Api\ProjectDivisionController@projectMembers');
    Route::get('/project-division/{project-division}/progress-lists', 'Api\ProjectDivisionController@progressLists');
    
    //project-member endpoints
    Route::resource('/project-member', 'Api\ProjectMemberController');
    Route::get('/project-member/{project-member}/card-members', 'Api\ProjectMemberController@cardMembers');

    //progress-list endpoints
    Route::resource('/progress-list', 'Api\ProgressListController');
    Route::get('/progress-list/{progress-list}/cards', 'Api\ProgressListController@cards');

    //card endpoints
    Route::resource('/card', 'Api\CardController');
    Route::get('/card/{card}/card-members', 'Api\CardController@cardMembers');

    //card-member endpoint
    Route::resource('/card-member', 'Api\CardMemberController');
});

