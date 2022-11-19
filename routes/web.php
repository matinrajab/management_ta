<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

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
    return view('layouts.master');
})->name('master');

// mhs
Route::get('/proposal', function () {
    return view('mhs.proposal');
})->name('proposal');

Route::get('/ta', function () {
    return view('mhs.ta');
})->name('ta');

Route::get('/sidang', function () {
    return view('mhs.sidang');
})->name('sidang');

Route::get('/proposal/add', function () {
    return view('mhs.add_proposal');
});

Route::get('/dosbing', function () {
    return view('mhs.daftar_dosbing');
})->name('dosbing');

Route::get('/login', function () {
    return view('login');
});

// dosen
Route::get('/dosen/mhs', function () {
    return view('dosen.daftar_mhs');
})->name('/dosen/mhs');

Route::get('/dosen/ta', function () {
    return view('dosen.ta');
})->name('/dosen/ta');

Route::get('/dosen/proposal', function () {
    return view('dosen.proposal');
})->name('/dosen/proposal');

Auth::routes();

/*------------------------------------------
--------------------------------------------
All Mhs Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:mhs'])->group(function () {

    Route::get('/mhs/home', [HomeController::class, 'mhsHome'])->name('mhs.home');
});

/*------------------------------------------
--------------------------------------------
All Dosen Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:dosen'])->group(function () {

    Route::get('/dosen/home', [HomeController::class, 'dosenHome'])->name('dosen.home');
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});
