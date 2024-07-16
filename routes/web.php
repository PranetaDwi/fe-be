<?php

use App\Http\Controllers\KalkulatorKomisiController;
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

Route::get('/', [KalkulatorKomisiController::class, 'index'])->name('dashboard');
Route::get('/create-form', [KalkulatorKomisiController::class, 'create'])->name('create-form');
Route::post('/store', [KalkulatorKomisiController::class, 'store'])->name('store-komisi');


Route::get('/get-data-chart', [KalkulatorKomisiController::class, 'getDataChart'])->name('get-data-chart');