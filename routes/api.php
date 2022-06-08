<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get api for fetch user
Route::get('/users/{id?}',[UserApiController::class, 'ShowUser']);
//post api for add user
Route::post('/add-user',[UserApiController::class, 'AddUser']);
// Post api for add multiple user 
Route::post('/add-multiple-user',[UserApiController::class, 'AddMultipleUser']);
//put api for update user details
Route::put('/update-user-details/{id}',[UserApiController::class, 'UpdateUserDetails']);
//patch api for update single record
Route::patch('/update-single-record/{id}',[UserApiController::class, 'UpdateSingleRecord']);
//delete api for delete single user
Route::delete('/delete-single-user/{id}',[UserApiController::class, 'DeleteSingleUser']);
//delete api for delete single user with json
Route::delete('/delete-single-user-with-json',[UserApiController::class, 'DeleteSingleUserJson']);
//delete api for delete Multiple user
Route::delete('/delete-multiple-user/{id}',[UserApiController::class, 'DeleteMultipleUser']);
//delete api for delete Multiple user with Json
Route::delete('/delete-multiple-user-with-json',[UserApiController::class, 'DeleteMultipleUserWithJson']);
