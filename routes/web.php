<?php

use App\Http\Controllers\ContactLogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ContactLogController::class, 'index'])->name('index');
Route::get('/all', [ContactLogController::class, 'all'])->name('all');
Route::get('/create', [ContactLogController::class, 'getCreatePage'])->name('create');
Route::post('/', [ContactLogController::class, 'store'])->name('store');
Route::get('/{id}', [ContactLogController::class, 'show'])->name('show');
Route::delete('/{id}', [ContactLogController::class, 'destroy'])->name('destroy');
