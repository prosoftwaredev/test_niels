<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DepartmentController;
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
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('employments')->middleware(['auth'])->group(function () {
    Route::get('/', function() {
        return view('employment');
    })->name('employments');

    Route::get('create', function() {
        return view('employment');
    })->name('employments_create');

    Route::get('edit/{id?}', function($id) {
        return view('employment');
    })->name('employments_edit');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('users', UsersController::class)->middleware(['auth']);

Route::get('/users/{user}/pass', [UsersController::class, 'changePasswordIndex'])->middleware(['auth'])->name('change_password');
Route::post('/users/{user}/pass', [UsersController::class, 'changePassword'])->middleware(['auth'])->name('update_password');

Route::resource('countries', CountryController::class)->middleware(['auth']);
Route::resource('states', StateController::class)->middleware(['auth']);
Route::resource('cities', CityController::class)->middleware(['auth']);
Route::resource('departments', DepartmentController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
