<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\auth\AuthController;

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
    return view('home');
})->name('home');

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::post('login', [AuthController::class, 'login'])->name('auth.login');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboardIndex'])->name('dashboard');
    Route::get('/add/travel', [TravelController::class, 'indexAddTravels'])->name('travels.index');
    Route::post('/addtravel', [TravelController::class, 'travelCheck'])->name('travel.check');
    Route::get('/result/travels', [TravelController::class, 'indexTravels'])->name('travelsAdd.index');
});
