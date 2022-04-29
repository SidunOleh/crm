<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\PasswordController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TaskController;
use App\Models\User;
use App\Models\Project;
use App\Models\Contact;
use App\Models\Task;

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

// authentication routes

Route::redirect('/', '/login');

Route::name('reg.')->group(function () {

    Route::get('/registration', [RegController::class, 'index'])
        ->name('index');
    Route::post('/registration', [RegController::class, 'store'])
        ->name('store');

});

Route::name('login.')->group(function () {

    Route::get('/login', [LoginController::class, 'index'])
        ->name('index');
    Route::post('/login', [LoginController::class, 'login'])
        ->name('login');
    
    Route::get('/logout', [LoginController::class, 'logout'])
        ->name('logout');

});


// reset and change password routes

Route::name('password.')->group(function () {

    Route::get('/forgot-password', [PasswordController::class, 'request'])
        ->name('request');
    Route::post('/forgot-password', [PasswordController::class, 'email'])
        ->name('email');

    Route::get('/reset-password/{token}', [PasswordController::class, 'reset'])
        ->name('reset');
    Route::post('/reset-password', [PasswordController::class, 'update'])
        ->name('update');

    Route::get('/change-password', [PasswordController::class, 'change'])
        ->name('change')->middleware('auth');
    Route::post('/change-password', [PasswordController::class, 'new'])
        ->name('new')->middleware('auth');

});


// users routes

Route::prefix('users')->name('users.')->middleware(['auth',])->group(function () {

    Route::get('/search', [UserController::class, 'search'])
        ->name('search');

    Route::post('/activity/{user}', [UserController::class, 'activity'])
        ->name('activity')->can('activity', 'user');

    Route::post('/permissions/{user}', [UserController::class, 'permissions'])
        ->name('permissions')->can('permissions', 'user');

});

Route::resource('users', UserController::class)->middleware(['auth',]);


// projects routes

Route::prefix('projects')->name('projects.')->middleware(['auth',])->group(function () {

    Route::get('/search', [ProjectController::class, 'search'])
        ->name('search')->can('search', Project::class);

});


Route::resource('projects', ProjectController::class)->except(['edit',])
    ->middleware(['auth',]);


// contacts routes

Route::prefix('contacts')->name('contacts.')->middleware(['auth',])->group(function () {

    Route::get('/search', [ContactController::class, 'search'])
        ->name('search')->can('search', Contact::class);

    Route::post('/activity/{contact}', [ContactController::class, 'activity'])
        ->name('activity')->can('activity', 'contact');

});

Route::resource('contacts', ContactController::class)->except(['edit',])
    ->middleware(['auth',]);


// tasks routes

Route::prefix('tasks')->name('tasks.')->middleware(['auth',])->group(function () {

    Route::get('/search', [TaskController::class, 'search'])
        ->name('search')->can('search', Task::class);

});

Route::resource('tasks', TaskController::class)->middleware(['auth',]);
