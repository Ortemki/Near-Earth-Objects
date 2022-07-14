<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\NearEarthObjectController;
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

Route::get('/', [HelloController::class, 'greetings']);

Route::get('/add_new_objects', [NearEarthObjectController::class, 'add_new_asteroids']);

Route::get('/neo/hazardous', [NearEarthObjectController::class, 'potentially_hazardous']);

Route::get('/neo/fastest/{hazardous?}', [NearEarthObjectController::class, 'fastest_asteroids']);



