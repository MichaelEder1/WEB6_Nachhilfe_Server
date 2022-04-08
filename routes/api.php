<?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
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

    Route::get('/users', function () {
        $users =  DB::table('users')->get();
        return $users;
    });

    Route::get('/courses', function () {
        $courses =  DB::table('courses')->get();
        return $courses;
    });

    Route::get('/programs', function () {
        $programs =  DB::table('programs')->get();
        return $programs;
    });

    Route::get('/all', function () {
        $all =  \App\Models\Course::with(['programs'])->get();
        return $all;
    });

    Route::get('/offers', function () {
        $offers =\App\Models\Offer::with(['users', 'courses', 'programs'])->get();
        return $offers;
    });

    Route::get('/dates', function () {
        $dates =\App\Models\Date::with(['tutors', 'seekers', 'courses', 'programs', 'offers'])->get();
        return $dates;
    });

