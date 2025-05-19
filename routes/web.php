<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TempatProyekController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/tempat-proyek", [TempatProyekController::class, "show"])->name("show-tempat-proyek");
Route::get("/tempat-proyek/add", [TempatProyekController::class, "add"])->name("add-tempat-proyek");
Route::get("/tempat-proyek/{id}/edit", [TempatProyekController::class, "edit"])->name("edit-tempat-proyek");
Route::post("/tempat-proyek/delete", [TempatProyekController::class, "delete"])->name("delete-tempat-proyek");
Route::post("/tempat-proyek/save", [TempatProyekController::class, "save"])->name("save-tempat-proyek");
