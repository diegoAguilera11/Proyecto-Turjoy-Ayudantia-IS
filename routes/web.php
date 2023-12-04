<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
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

Route::get('/', [TravelController::class, 'homeIndex'])->name('home');

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::post('login', [AuthController::class, 'login'])->name('auth.login');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/get/origins', [TravelController::class, 'obtainOrigins']);
Route::get('/get/destinations/{origin}', [TravelController::class, 'searchDestinations']);
Route::get('/seating/{origin}/{destination}/{date}', [TravelController::class, 'seatings']);
Route::post('/check', [TravelController::class, 'checkTravel'])->name('travels.check');

Route::post('/reservation', [TicketController::class, 'store'])->name('add-reservation');

Route::middleware(['auth'])->group(function () {
    // Travel routes
    Route::get('/dashboard', [UserController::class, 'dashboardIndex'])->name('dashboard');
    Route::get('/add/travel', [TravelController::class, 'indexAddTravels'])->name('travels.index');
    Route::post('/addtravel', [TravelController::class, 'travelCheck'])->name('travel.check');
    Route::get('/result/travels', [TravelController::class, 'indexTravels'])->name('travelsAdd.index');

    // Ticket Report Routes
    Route::get('/ticket/report', [TicketController::class, 'ticketReportIndex'])->name('report-ticket.index');
    Route::get('/search-ticket', [TicketController::class, 'searchToDate'])->name('searchToDate');
});
// Voucher
Route::get('/travel-reservation/{id}', [VoucherController::class, 'generatePDF'])->name('generate.pdf');
Route::get('download-pdf/{id}', [VoucherController::class, 'downloadPDF'])->name('pdf.download');
