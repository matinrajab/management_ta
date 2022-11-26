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

    Route::get('/mhs/proposal/add', [MhsController::class, 'proposal_add'])->name('mhs.proposal_add');

    Route::get('/mhs/proposal/edit', [MhsController::class, 'proposal_edit'])->name('mhs.proposal_edit');

    Route::get('/mhs/ta', [MhsController::class, 'ta'])->name('mhs.ta');

    Route::get('/mhs/ta/add', [MhsController::class, 'ta_add'])->name('mhs.ta_add');

    Route::get('/mhs/ta/edit', [MhsController::class, 'ta_edit'])->name('mhs.ta_edit');

    Route::get('/mhs/sidang', [MhsController::class, 'sidang'])->name('mhs.sidang');

    Route::get('/mhs/sidang/revisi_add', [MhsController::class, 'revisi_add'])->name('mhs.revisi_add');

    Route::get('/mhs/sidang/revisi_edit', [MhsController::class, 'revisi_edit'])->name('mhs.revisi_edit');

    Route::get('/mhs/surat', [MhsController::class, 'surat'])->name('mhs.surat');

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

    Route::get('/dosen/sidang', [DosenController::class, 'sidang'])->name('dosen.sidang');

    Route::get('/dosen/sidang/add', [DosenController::class, 'sidang_add'])->name('dosen.sidang_add');

    Route::get('/dosen/sidang/edit', [DosenController::class, 'sidang_edit'])->name('dosen.sidang_edit');

    Route::get('/dosen/proposal', [DosenController::class, 'proposal'])->name('dosen.proposal');

    Route::get('/dosen/proposal/edit', [DosenController::class, 'proposal_edit'])->name('dosen.proposal_edit');

    Route::get('/dosen/revisi/edit', [DosenController::class, 'revisi_edit'])->name('dosen.revisi_edit');
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'home'])->name('admin.dashboard');

    Route::get('/admin/dosbing', [AdminController::class, 'dosbing'])->name('admin.dosbing');

    Route::get('/admin/dosbing/add', [AdminController::class, 'dosbing_add'])->name('admin.dosbing_add');

    Route::get('/admin/dosbing/edit', [AdminController::class, 'dosbing_edit'])->name('admin.dosbing_edit');

    Route::get('/admin/mhs', [AdminController::class, 'mhs'])->name('admin.mhs');

    Route::get('/admin/mhs/add', [AdminController::class, 'mhs_add'])->name('admin.mhs_add');

    Route::get('/admin/mhs/edit', [AdminController::class, 'mhs_edit'])->name('admin.mhs_edit');

    Route::get('/admin/proposal', [AdminController::class, 'proposal'])->name('admin.proposal');

    Route::get('/admin/proposal/edit', [AdminController::class, 'proposal_edit'])->name('admin.proposal_edit');

    Route::get('/admin/ta', [AdminController::class, 'ta'])->name('admin.ta');

    Route::get('/admin/ta/add', [AdminController::class, 'ta_add'])->name('admin.ta_add');

    Route::get('/admin/ta/edit', [AdminController::class, 'ta_edit'])->name('admin.ta_edit');

    Route::get('/admin/sidang', [AdminController::class, 'sidang'])->name('admin.sidang');

    Route::get('/admin/sidang/add', [AdminController::class, 'sidang_add'])->name('admin.sidang_add');

    Route::get('/admin/sidang/revisi_add', [AdminController::class, 'revisi_add'])->name('admin.revisi_add');

    Route::get('/admin/sidang/revisi_edit', [AdminController::class, 'revisi_edit'])->name('admin.revisi_edit');
});
