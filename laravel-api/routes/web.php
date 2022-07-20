<?php

use App\Http\Controllers\API\v1\NotebookController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//api/v1
Route::controller(NotebookController::class)->group(function (){
    Route::get('/api/v1/notebook/','index');
    Route::get('/api/v1/notebook/{notebook}','show');
    Route::post('/api/v1/notebook/','store');
    Route::post('/api/v1/notebook/{notebook}','update');
    Route::delete('/api/v1/notebook/{notebook}','destroy');
});

