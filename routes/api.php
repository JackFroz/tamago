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
    Route::post('/change-name', 'Api\UserController@changeName');

    //user endpoints
    Route::get('/user', 'Api\UserController@profile');
    Route::get('/user/{user}/projects', 'Api\UserController@projects');
    Route::get('/user/{user}/project-members', 'Api\UserController@projects');

    //project endpoints
    Route::resource('/project', 'Api\ProjectController');
    Route::get('/project/{project}/project-divisions', 'Api\ProjectController@projectDivisions');
    Route::get('/project/{project}/project-members', 'Api\ProjectController@projectMembers');
    Route::get('/project/{project}/project-owner', 'Api\ProjectController@projectOwner');

    //project-division endpoints
    Route::resource('/project-division', 'Api\ProjectDivisionController');
    Route::get('/project-division/{projectDivision}/project', 'Api\ProjectDivisionController@project');
    Route::get('/project-division/{projectDivision}/project-members', 'Api\ProjectDivisionController@projectMembers');
    Route::get('/project-division/{projectDivision}/progress-lists', 'Api\ProjectDivisionController@progressLists');


    //project-member endpoints
    Route::resource('/project-member', 'Api\ProjectMemberController');
    Route::get('/project-member/{projectMember}/card-members', 'Api\ProjectMemberController@cardMembers');

    //progress-list endpoints
    Route::resource('/progress-list', 'Api\ProgressListController');
    Route::get('/progress-list/{progressList}/cards', 'Api\ProgressListController@cards');


    //card endpoints
    Route::resource('/card', 'Api\CardController');
    Route::get('/card/{card}/card-members', 'Api\CardController@cardMembers');
    Route::get('/card/{card}/attachments', 'Api\CardController@attachments');

    //card-member endpoints
    Route::resource('/card-member', 'Api\CardMemberController');
    Route::get('/card-member/{cardMember}/user', 'Api\CardMemberController@user');

    //attachment endpoints
    Route::resource('/attachment', 'Api\AttachmentController');
});
