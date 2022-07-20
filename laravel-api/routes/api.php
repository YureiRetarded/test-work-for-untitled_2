<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|-----------------http://127.0.0.1:8000/api/v1/notebook---------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->get('/v1', function (Request $request) {
    Route::controller(NotebookController::class)->group(function (){
        Route::get('/notebook/','index');
        Route::get('/notebook/{notebook}','show');
        Route::post('/notebook/','store');
        Route::post('/notebook/{notebook}','update');
        Route::delete('/notebook/{notebook}','destroy');
    });
});

