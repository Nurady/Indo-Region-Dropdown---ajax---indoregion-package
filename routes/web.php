<?php

use App\Http\Controllers\IndoregionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('indoregion', [IndoregionController::class, 'index'])->name('indoregion');
Route::post('kabupaten', [IndoregionController::class, 'getRegency'])->name('getRegency');
Route::post('kecamatan', [IndoregionController::class, 'getDistrict'])->name('getDistrict');
Route::post('desa', [IndoregionController::class, 'getVillage'])->name('getVillage');
