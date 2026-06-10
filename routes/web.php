<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/signin', [LoginController::class, 'showLoginForm'])->name('signin.form');
Route::get('/signup', [SignupController::class, 'getSignupForm'])->name('signupForm');
Route::post('/signup', [SignupController::class, 'signup'])->name('signup');
Route::post('/signin', [LoginController::class, 'signin'])->name('signin');


Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'admin']);
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/users', [AdminController::class, 'userList']);
Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');


Route::get('/emergency', [EmergencyController::class, 'index'])->name('emergency');

Route::post('/emergency/store', [EmergencyController::class, 'store']);
Route::post('/emergency/store-request', [EmergencyController::class, 'storeRequest']);
Route::get('/admin/emergencies/data', [EmergencyController::class, 'getEmergencyData']);
Route::get('/admin/emergencies', [EmergencyController::class, 'emergencyMap'])->name('admin.emergencies');
