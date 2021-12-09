<?php

use Illuminate\Foundation\Application;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/course', 'App\Http\Controllers\CourseController@index')->name('course');
Route::get('/course/{id}', 'App\Http\Controllers\CourseController@show')->name('show');
Route::post('/toggleProgress', 'App\Http\Controllers\CourseController@toggleProgress')->name('toggleProgress');
Route::post('/courses', 'App\Http\Controllers\CourseController@store')->name('store');
Route::get('/courses/edit/{id}', 'App\Http\Controllers\CourseController@edit')->name('edit');
Route::patch('/courses/{id}', 'App\Http\Controllers\CourseController@update')->name('update');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
