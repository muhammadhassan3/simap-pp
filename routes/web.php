<?php

use App\Http\Controllers\AktorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PengawasProyekController;
use App\Http\Controllers\ProyekDisetujuiController;
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
