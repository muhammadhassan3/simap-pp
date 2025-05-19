<?php

use App\Http\Controllers\AktorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\PengawasProyekController;
use App\Http\Controllers\ProyekDisetujuiController;
use App\Http\Controllers\SewaAlatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TempatProyekController;

Route::get('/', function () {
    return view('welcome');
});

//Hassan
Route::get("/tempat-proyek", [TempatProyekController::class, "show"])->name("show-tempat-proyek");
Route::get("/tempat-proyek/add", [TempatProyekController::class, "add"])->name("add-tempat-proyek");
Route::get("/tempat-proyek/{id}/edit", [TempatProyekController::class, "edit"])->name("edit-tempat-proyek");
Route::post("/tempat-proyek/delete", [TempatProyekController::class, "delete"])->name("delete-tempat-proyek");
Route::post("/tempat-proyek/save", [TempatProyekController::class, "save"])->name("save-tempat-proyek");


//Husna
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::put('/customer/{id}/update', [CustomerController::class, 'update'])->name('customer.update');
Route::delete('/customer/{id}/delete', [CustomerController::class, 'destroy'])->name('customer.delete');


//Alin
Route::get('/pengawas-proyek', [PengawasProyekController::class, 'index'])->name('pengawas-proyek.index');
Route::get('/pengawas-proyek/{id}/edit', [PengawasProyekController::class, 'edit'])->name('pengawas-proyek.edit');
Route::put('/pengawas-proyek/{id}', [PengawasProyekController::class, 'update'])->name('pengawas-proyek.update');

//Arisa
Route::resource('aktor', AktorController::class);

//Farah
Route::get('/proyekdisetujui', [ProyekDisetujuiController::class, 'index'])->name('proyekdisetujui.index');
Route::get('/proyekdisetujui/{id}/edit', [ProyekDisetujuiController::class, 'edit'])->name('proyekdisetujui.edit');
Route::put('/proyekdisetujui/{id}', [ProyekDisetujuiController::class, 'update'])->name('proyekdisetujui.update');

Route::get('/proyekdisetujui/{id}/show', [ProyekDisetujuiController::class, 'show'])->name('proyekdisetujui.show');

//Fiqhi
Route::get('/', [MarketingController::class, 'index'])->name('market.index');
Route::get('create', [MarketingController::class, 'create'])->name('market.create');
Route::post('store', [MarketingController::class, 'store'])->name('market.store');
Route::post('store', [MarketingController::class, 'store'])->name('market.store');
Route::get('{market}/edit', [MarketingController::class, 'edit'])->name('market.edit');
Route::put('/{market}', [MarketingController::class, 'update'])->name('market.update');
Route::delete('/{market}', [MarketingController::class, 'destroy'])->name('market.delete');

//Hanny
Route::get('/sewa-alat', [SewaAlatController::class, 'index']);
Route::resource('sewa_alat', SewaAlatController::class);
Route::post('/sewa_alat/store', [SewaAlatController::class, 'store'])->name('sewa_alat.store');
Route::delete('/sewa_alat/{id}', [SewaAlatController::class, 'destroy'])->name('sewa_alat.destroy');
Route::get('/sewa_alat/{id}/edit', [SewaAlatController::class, 'edit'])->name('sewa_alat.edit');
Route::put('/sewa_alat/{id}', [SewaAlatController::class, 'update'])->name('sewa_alat.update');
