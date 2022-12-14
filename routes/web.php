<?php

use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'canResetPassword' => true,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/users', function () {
        return Inertia::render('Users',  [
            'users' => User::all(),
        ]);
    })->name('users');

    Route::get('/users_test', function () {
        return Inertia::render('UserTest',  [
            'users' => User::all(),
        ]);
    })->name('users_test');

    Route::get('/', function () {
        return redirect('/dashboard');
    });
    Route::post('/chat-message', function (Request $request) {
        if(isset($request->message)) {
            event(new App\Events\ChatMessage($request->message));
        }
        return null;
    });
});


