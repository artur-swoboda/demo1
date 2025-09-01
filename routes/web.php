<?php

use App\Http\Middleware\IsAdmin;
use App\Livewire\Admin\Reservations\Index as ReservationsList;
use App\Livewire\Admin\Services\Index as AdminServicesIndex;
use App\Livewire\Admin\Slots\Index as AdminSlotsIndex;
use App\Livewire\Client\Reservations\MyReservations;
use App\Livewire\Client\Reservations\ReservationForm;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/reservations/new', ReservationForm::class)->name('reservations.new');
    Route::get('/reservations/my', MyReservations::class)->name('reservations.my');
});

Route::middleware(['auth:sanctum', IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('services', AdminServicesIndex::class)->name('services.index');
    Route::get('slots', AdminSlotsIndex::class)->name('slots.index');
    Route::get('reservations', ReservationsList::class)->name('reservations.index');
});
