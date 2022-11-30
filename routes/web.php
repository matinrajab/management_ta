<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthLoginController;
use App\Http\Controllers\MhsController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

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

    Route::get('/mhs/proposal/download/{id}', [MhsController::class, 'proposal_download'])->name('mhs.proposal_download');

    Route::get('/mhs/proposal/add', [MhsController::class, 'proposal_add'])->name('mhs.proposal_add');

    Route::post('/mhs/proposal/store', [MhsController::class, 'proposal_store'])->name('mhs.proposal_store');

    Route::get('/mhs/proposal/edit/{id}', [MhsController::class, 'proposal_edit'])->name('mhs.proposal_edit');

    Route::put('/mhs/proposal/update/{id}', [MhsController::class, 'proposal_update'])->name('mhs.proposal_update');

    Route::get('/mhs/proposal/hapus/{id}', [MhsController::class, 'proposal_hapus'])->name('mhs.proposal_hapus');

    Route::get('/mhs/ta', [MhsController::class, 'ta'])->name('mhs.ta');

    Route::get('/mhs/ta/add', [MhsController::class, 'ta_add'])->name('mhs.ta_add');

    Route::post('/mhs/ta/store', [MhsController::class, 'ta_store'])->name('mhs.ta_store');

    Route::get('/mhs/ta/edit/{id}', [MhsController::class, 'ta_edit'])->name('mhs.ta_edit');

    Route::put('/mhs/ta/update/{id}', [MhsController::class, 'ta_update'])->name('mhs.ta_update');

    Route::get('/mhs/ta/hapus/{id}', [MhsController::class, 'ta_hapus'])->name('mhs.ta_hapus');

    Route::get('/mhs/sidang', [MhsController::class, 'sidang'])->name('mhs.sidang');

    Route::get('/mhs/sidang/revisi_add', [MhsController::class, 'revisi_add'])->name('mhs.revisi_add');

    Route::post('/mhs/sidang/revisi_store', [MhsController::class, 'revisi_store'])->name('mhs.revisi_store');

    Route::get('/mhs/sidang/revisi_download/{id}', [MhsController::class, 'revisi_download'])->name('mhs.revisi_download');

    Route::get('/mhs/sidang/revisi_edit/{id}', [MhsController::class, 'revisi_edit'])->name('mhs.revisi_edit');

    Route::put('/mhs/sidang/revisi_update/{id}', [MhsController::class, 'revisi_update'])->name('mhs.revisi_update');

    Route::get('/mhs/sidang/revisi_hapus/{id}', [MhsController::class, 'revisi_hapus'])->name('mhs.revisi_hapus');

    Route::get('/mhs/surat', [MhsController::class, 'surat'])->name('mhs.surat');

    Route::get('/mhs/surat/download_pengesahan/{id}', [MhsController::class, 'download_pengesahan'])->name('mhs.download_pengesahan');

    Route::get('/mhs/surat/download_ijazah/{id}', [MhsController::class, 'download_ijazah'])->name('mhs.download_ijazah');

    Route::get('/mhs/surat/download_rekomendasi/{id}', [MhsController::class, 'download_rekomendasi'])->name('mhs.download_rekomendasi');

    Route::get('/mhs/dosbing', [MhsController::class, 'dosbing'])->name('mhs.daftar_dosbing');
});

/*------------------------------------------
--------------------------------------------
All Dosen Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:dosen'])->group(function () {

    Route::get('/dosen', [DosenController::class, 'home'])->name('dosen.dashboard');

    Route::get('/dosen/proposal', [DosenController::class, 'proposal'])->name('dosen.proposal');

    Route::get('/dosen/proposal/download/{id}', [DosenController::class, 'proposal_download'])->name('dosen.proposal_download');

    Route::get('/dosen/proposal/edit/{id}', [DosenController::class, 'proposal_edit'])->name('dosen.proposal_edit');

    Route::put('/dosen/proposal/update/{id}', [DosenController::class, 'proposal_update'])->name('dosen.proposal_update');

    Route::get('/dosen/ta', [DosenController::class, 'ta'])->name('dosen.ta');

    Route::get('/dosen/sidang', [DosenController::class, 'sidang'])->name('dosen.sidang');

    Route::get('/dosen/sidang/add', [DosenController::class, 'sidang_add'])->name('dosen.sidang_add');

    Route::post('/dosen/sidang/store', [DosenController::class, 'sidang_store'])->name('dosen.sidang_store');

    Route::get('/dosen/sidang/edit/{id}', [DosenController::class, 'sidang_edit'])->name('dosen.sidang_edit');

    Route::put('/dosen/sidang/update/{id}', [DosenController::class, 'sidang_update'])->name('dosen.sidang_update');

    Route::get('/dosen/sidang/hapus/{id}', [DosenController::class, 'sidang_hapus'])->name('dosen.sidang_hapus');

    Route::get('/dosen/sidang/revisi_download/{id}', [DosenController::class, 'revisi_download'])->name('dosen.revisi_download');

    Route::get('/dosen/sidang/revisi_edit/{id}', [DosenController::class, 'revisi_edit'])->name('dosen.revisi_edit');

    Route::put('/dosen/sidang/revisi_update/{id}', [DosenController::class, 'revisi_update'])->name('dosen.revisi_update');

    Route::get('/dosen/mhs', [DosenController::class, 'mhs'])->name('dosen.daftar_mhs');
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'home'])->name('admin.dashboard');

    Route::get('/admin/proposal', [AdminController::class, 'proposal'])->name('admin.proposal');

    Route::get('/admin/proposal/download/{id}', [AdminController::class, 'proposal_download'])->name('admin.proposal_download');

    Route::get('/admin/proposal/edit/{id}', [AdminController::class, 'proposal_edit'])->name('admin.proposal_edit');

    Route::put('/admin/proposal/update/{id}', [AdminController::class, 'proposal_update'])->name('admin.proposal_update');

    Route::get('/admin/ta', [AdminController::class, 'ta'])->name('admin.ta');

    Route::get('/admin/sidang', [AdminController::class, 'sidang'])->name('admin.sidang');

    Route::get('/admin/sidang/add', [AdminController::class, 'sidang_add'])->name('admin.sidang_add');

    Route::post('/admin/sidang/store', [AdminController::class, 'sidang_store'])->name('admin.sidang_store');

    Route::get('/admin/sidang/edit/{id}', [AdminController::class, 'sidang_edit'])->name('admin.sidang_edit');

    Route::put('/admin/sidang/update/{id}', [AdminController::class, 'sidang_update'])->name('admin.sidang_update');

    Route::get('/admin/sidang/hapus/{id}', [AdminController::class, 'sidang_hapus'])->name('admin.sidang_hapus');

    Route::get('/admin/sidang/revisi_download/{id}', [AdminController::class, 'revisi_download'])->name('admin.revisi_download');

    Route::get('/admin/sidang/revisi_edit/{id}', [AdminController::class, 'revisi_edit'])->name('admin.revisi_edit');

    Route::put('/admin/sidang/revisi_update/{id}', [AdminController::class, 'revisi_update'])->name('admin.revisi_update');

    Route::get('/admin/surat', [AdminController::class, 'surat'])->name('admin.surat');

    Route::get('/admin/surat/add/{id}', [AdminController::class, 'surat_add'])->name('admin.surat_add');

    Route::post('/admin/surat/store/{id}', [AdminController::class, 'surat_store'])->name('admin.surat_store');

    Route::get('/admin/surat/hapus/{id}', [AdminController::class, 'surat_hapus'])->name('admin.surat_hapus');

    Route::get('/admin/surat/download_pengesahan/{id}', [AdminController::class, 'download_pengesahan'])->name('admin.download_pengesahan');

    Route::get('/admin/surat/download_ijazah/{id}', [AdminController::class, 'download_ijazah'])->name('admin.download_ijazah');

    Route::get('/admin/surat/download_rekomendasi/{id}', [AdminController::class, 'download_rekomendasi'])->name('admin.download_rekomendasi');

    Route::get('/admin/dosbing', [AdminController::class, 'dosbing'])->name('admin.dosbing');

    Route::get('/admin/dosbing/add', [AdminController::class, 'dosbing_add'])->name('admin.dosbing_add');

    Route::post('/admin/dosbing/store', [AdminController::class, 'dosbing_store'])->name('admin.dosbing_store');

    Route::get('/admin/dosbing/edit/{id}', [AdminController::class, 'dosbing_edit'])->name('admin.dosbing_edit');

    Route::put('/admin/dosbing/update/{id}', [AdminController::class, 'dosbing_update'])->name('admin.dosbing_update');

    Route::get('/admin/dosbing/hapus/{id}', [AdminController::class, 'dosbing_hapus'])->name('admin.dosbing_hapus');

    Route::get('/admin/mhs', [AdminController::class, 'mhs'])->name('admin.mhs');

    Route::get('/admin/mhs/add', [AdminController::class, 'mhs_add'])->name('admin.mhs_add');

    Route::post('/admin/mhs/store', [AdminController::class, 'mhs_store'])->name('admin.mhs_store');

    Route::get('/admin/mhs/edit/{id}', [AdminController::class, 'mhs_edit'])->name('admin.mhs_edit');

    Route::put('/admin/mhs/update/{id}', [AdminController::class, 'mhs_update'])->name('admin.mhs_update');

    Route::get('/admin/mhs/hapus/{id}', [AdminController::class, 'mhs_hapus'])->name('admin.mhs_hapus');
});
