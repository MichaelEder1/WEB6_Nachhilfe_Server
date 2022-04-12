<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'getUserById']);
Route::post('/users', [UserController::class, 'save']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'delete']);

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{code}', [CourseController::class, 'getCourseByCode']);
Route::post('/courses', [CourseController::class, 'save']);
Route::put('/courses/{code}', [CourseController::class, 'update']);
Route::delete('/courses/{code}', [CourseController::class, 'delete']);

Route::get('/programs', [ProgramController::class, 'index']);
Route::get('/programs/{name}', [ProgramController::class, 'getProgramByName']);
Route::post('/programs', [ProgramController::class, 'save']);
Route::put('/programs/{name}', [ProgramController::class, 'update']);
Route::delete('/programs/{name}', [ProgramController::class, 'delete']);

Route::get('/offers', [OfferController::class, 'index']);
Route::get('/offers/{id}', [OfferController::class, 'getOfferById']);
Route::post('/offers/', [OfferController::class, 'save']);
Route::put('/offers/{id}', [OfferController::class, 'update']);
Route::delete('/offers/{id}', [OfferController::class, 'delete']);

Route::get('/dates', [DateController::class, 'index']);
Route::get('/dates/{id}', [DateController::class, 'getDateById']);
Route::post('/dates', [DateController::class, 'save']);
Route::put('/dates/{id}', [DateController::class, 'update']);
Route::delete('/dates/{id}', [DateController::class, 'delete']);

Route::get('/messages', [MessageController::class, 'index']);
Route::get('/messages/{id}', [MessageController::class, 'getMessageById']);
Route::post('/messages', [MessageController::class, 'save']);
Route::put('/messages/{id}', [MessageController::class, 'update']);
Route::delete('/messages/{id}', [MessageController::class, 'delete']);
