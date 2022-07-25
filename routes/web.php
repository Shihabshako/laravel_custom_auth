<?php

use App\Http\Controllers\AuthenticationController;
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

Route::post("/login", [AuthenticationController::class, "login"])->name("verifyUser");
Route::post('/signup', [AuthenticationController::class, "signup"])->name("registerUser");
Route::get("/logout", [AuthenticationController::class, "logout"])->name("logout");

Route::middleware("authCheck")->group(function(){
    Route::view('/home', "home")->name("home"); 
    Route::get('/', [AuthenticationController::class, "goToLogin"]);
    Route::view('/signup', "signup")->name("signup");
    Route::view('/login', "login")->name("login"); 
});

