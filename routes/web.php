<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\TicketSearchController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\AuthController;

Route::get('/', [TicketSearchController::class, 'index'])->name('landing');
Route::get('/tickets/search', [TicketSearchController::class, 'search'])->name('tickets.search');
Route::get('/ticket/{ticket}/whatsapp', [TicketSearchController::class, 'whatsappRedirect'])->name('ticket.whatsapp');
Route::get('/cities/search-api', [CityController::class, 'searchApi'])->name('cities.searchApi');

Route::get('/inquiry', [InquiryController::class, 'create'])->name('inquiry.create');
Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('tickets', TicketController::class);
    Route::post('tickets/{ticket}/toggle', [TicketController::class, 'toggle'])->name('tickets.toggle');
    
    Route::resource('cities', CityController::class);
    
    Route::get('inquiries', [InquiryController::class, 'adminIndex'])->name('inquiries.index');
    Route::post('inquiries/{inquiry}/read', [InquiryController::class, 'markAsRead'])->name('inquiries.read');
    Route::post('inquiries/{inquiry}/status', [InquiryController::class, 'updateStatus'])->name('inquiries.updateStatus');
});