<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthLoginController;
use App\Http\Controllers\MhsController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Auth::routes();

/*------------------------------------------
--------------------------------------------
All Mhs Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:mhs'])->group(function () {

    Route::get('/mhs', [MhsController::class, 'home'])->name('mhs.dashboard');

    Route::get('/mhs/proposal', [MhsController::class, 'proposal'])->name('mhs.proposal');

    Route::get('/mhs/proposal/add', [MhsController::class, 'add_proposal'])->name('mhs.add_proposal');

    Route::get('/mhs/ta', [MhsController::class, 'ta'])->name('mhs.ta');

    Route::get('/mhs/sidang', [MhsController::class, 'sidang'])->name('mhs.sidang');

    Route::get('/mhs/dosbing', [MhsController::class, 'dosbing'])->name('mhs.daftar_dosbing');
});

/*------------------------------------------
--------------------------------------------
All Dosen Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:dosen'])->group(function () {

    Route::get('/dosen', [DosenController::class, 'home'])->name('dosen.dashboard');

    Route::get('/dosen/mhs', [DosenController::class, 'mhs'])->name('dosen.daftar_mhs');

    Route::get('/dosen/ta', [DosenController::class, 'ta'])->name('dosen.ta');

    Route::get('/dosen/proposal', [DosenController::class, 'proposal'])->name('dosen.proposal');
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    // Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});
