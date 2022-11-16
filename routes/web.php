<?php

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

Route::get('/', function () {
    return view('layouts.master');
})->name('master');

Route::get('mhs', function () {
    return view('layouts.master');
});


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
})->name('dosbing');;

Route::get('/login', function () {
    return view('login');
});
