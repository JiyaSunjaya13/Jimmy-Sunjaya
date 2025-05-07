<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;


// TODO: daftarkan route anda di sini

Route::controller(ProdukController::class)->name('produk.')->group(function () {
    // list barang
    Route::get('/produk', 'index')->name('index');
    // form create
    //Route::get('/produk/create', 'create')->name('create');
    // menerima request untuk create barang (store barang ke database)
    Route::post('/produk', 'store')->name('store');
    // show detail barang
    //Route::get('/produk/{id}', 'show')->name('show');
    // destroy/delete barang
    Route::delete('/produk/{id}', 'delete')->name('destroy');
    // form edit barang
    //Route::get('/produk/{id}/edit', 'edit')->name('edit');
    // menerima request untuk update barang
    Route::post('/produk/{id}', 'update')->name('update');
});
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
