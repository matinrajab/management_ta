<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthLoginController;
use App\Http\Controllers\MhsController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProposalAdminController;
use App\Http\Controllers\ProposalDosenController;
use App\Http\Controllers\ProposalMhsController;
use App\Http\Controllers\SidangAdminController;
use App\Http\Controllers\SidangDosenController;
use App\Http\Controllers\SidangMhsController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\TaAdminController;
use App\Http\Controllers\TaDosenController;
use App\Http\Controllers\TaMhsController;
use App\Http\Controllers\DownloadController;
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

Route::get('/download/{filename}', [DownloadController::class, 'download']);

Auth::routes();

/*------------------------------------------
--------------------------------------------
All Mhs Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:mhs'])->group(function () {

    Route::get('/mhs', [HomeController::class, 'mhsHome'])->name('mhs.dashboard');

    Route::get('/mhs/proposal', [ProposalMhsController::class, 'proposal'])->name('mhs.proposal');

    Route::get('/mhs/proposal/add', [ProposalMhsController::class, 'proposal_add'])->name('mhs.proposal_add');

    Route::post('/mhs/proposal/store', [ProposalMhsController::class, 'proposal_store'])->name('mhs.proposal_store');

    Route::get('/mhs/proposal/edit/{id}', [ProposalMhsController::class, 'proposal_edit'])->name('mhs.proposal_edit');

    Route::put('/mhs/proposal/update/{id}', [ProposalMhsController::class, 'proposal_update'])->name('mhs.proposal_update');

    Route::get('/mhs/proposal/hapus/{id}', [ProposalMhsController::class, 'proposal_hapus'])->name('mhs.proposal_hapus');

    Route::get('/mhs/ta', [TaMhsController::class, 'ta'])->name('mhs.ta');

    Route::get('/mhs/ta/add', [TaMhsController::class, 'ta_add'])->name('mhs.ta_add');

    Route::post('/mhs/ta/store', [TaMhsController::class, 'ta_store'])->name('mhs.ta_store');

    Route::get('/mhs/ta/edit/{id}', [TaMhsController::class, 'ta_edit'])->name('mhs.ta_edit');

    Route::put('/mhs/ta/update/{id}', [TaMhsController::class, 'ta_update'])->name('mhs.ta_update');

    Route::get('/mhs/ta/hapus/{id}', [TaMhsController::class, 'ta_hapus'])->name('mhs.ta_hapus');

    Route::get('/mhs/sidang', [SidangMhsController::class, 'sidang'])->name('mhs.sidang');

    Route::get('/mhs/sidang/revisi_add', [SidangMhsController::class, 'revisi_add'])->name('mhs.revisi_add');

    Route::post('/mhs/sidang/revisi_store', [SidangMhsController::class, 'revisi_store'])->name('mhs.revisi_store');

    Route::get('/mhs/sidang/revisi_edit/{id}', [SidangMhsController::class, 'revisi_edit'])->name('mhs.revisi_edit');

    Route::put('/mhs/sidang/revisi_update/{id}', [SidangMhsController::class, 'revisi_update'])->name('mhs.revisi_update');

    Route::get('/mhs/sidang/revisi_hapus/{id}', [SidangMhsController::class, 'revisi_hapus'])->name('mhs.revisi_hapus');

    Route::get('/mhs/surat', [SuratController::class, 'mhsSurat'])->name('mhs.surat');

    Route::get('/mhs/dosbing', [DosenController::class, 'mhsDosbing'])->name('mhs.daftar_dosbing');
});

/*------------------------------------------
--------------------------------------------
All Dosen Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:dosen'])->group(function () {

    Route::get('/dosen', [HomeController::class, 'dosenHome'])->name('dosen.dashboard');

    Route::get('/dosen/proposal', [ProposalDosenController::class, 'proposal'])->name('dosen.proposal');

    Route::get('/dosen/proposal/edit/{id}', [ProposalDosenController::class, 'proposal_edit'])->name('dosen.proposal_edit');

    Route::put('/dosen/proposal/update/{id}', [ProposalDosenController::class, 'proposal_update'])->name('dosen.proposal_update');

    Route::get('/dosen/ta', [TaDosenController::class, 'ta'])->name('dosen.ta');

    Route::get('/dosen/sidang', [SidangDosenController::class, 'sidang'])->name('dosen.sidang');

    Route::get('/dosen/sidang/add', [SidangDosenController::class, 'sidang_add'])->name('dosen.sidang_add');

    Route::post('/dosen/sidang/store', [SidangDosenController::class, 'sidang_store'])->name('dosen.sidang_store');

    Route::get('/dosen/sidang/edit/{id}', [SidangDosenController::class, 'sidang_edit'])->name('dosen.sidang_edit');

    Route::put('/dosen/sidang/update/{id}', [SidangDosenController::class, 'sidang_update'])->name('dosen.sidang_update');

    Route::get('/dosen/sidang/hapus/{id}', [SidangDosenController::class, 'sidang_hapus'])->name('dosen.sidang_hapus');

    Route::get('/dosen/sidang/revisi_edit/{id}', [SidangDosenController::class, 'revisi_edit'])->name('dosen.revisi_edit');

    Route::put('/dosen/sidang/revisi_update/{id}', [SidangDosenController::class, 'revisi_update'])->name('dosen.revisi_update');

    Route::get('/dosen/mhs', [MhsController::class, 'dosenMhs'])->name('dosen.daftar_mhs');
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin', [HomeController::class, 'adminHome'])->name('admin.dashboard');

    Route::get('/admin/proposal', [ProposalAdminController::class, 'proposal'])->name('admin.proposal');

    Route::get('/admin/proposal/edit/{id}', [ProposalAdminController::class, 'proposal_edit'])->name('admin.proposal_edit');

    Route::put('/admin/proposal/update/{id}', [ProposalAdminController::class, 'proposal_update'])->name('admin.proposal_update');

    Route::get('/admin/ta', [TaAdminController::class, 'ta'])->name('admin.ta');

    Route::get('/admin/ta/hapus/{id}', [TaAdminController::class, 'ta_hapus'])->name('admin.ta_hapus');

    Route::get('/admin/sidang', [SidangAdminController::class, 'sidang'])->name('admin.sidang');

    Route::get('/admin/sidang/add', [SidangAdminController::class, 'sidang_add'])->name('admin.sidang_add');

    Route::post('/admin/sidang/store', [SidangAdminController::class, 'sidang_store'])->name('admin.sidang_store');

    Route::get('/admin/sidang/edit/{id}', [SidangAdminController::class, 'sidang_edit'])->name('admin.sidang_edit');

    Route::put('/admin/sidang/update/{id}', [SidangAdminController::class, 'sidang_update'])->name('admin.sidang_update');

    Route::get('/admin/sidang/hapus/{id}', [SidangAdminController::class, 'sidang_hapus'])->name('admin.sidang_hapus');

    Route::get('/admin/sidang/revisi_edit/{id}', [SidangAdminController::class, 'revisi_edit'])->name('admin.revisi_edit');

    Route::put('/admin/sidang/revisi_update/{id}', [SidangAdminController::class, 'revisi_update'])->name('admin.revisi_update');

    Route::get('/admin/surat', [SuratController::class, 'adminSurat'])->name('admin.surat');

    Route::get('/admin/surat/add/{id}', [SuratController::class, 'surat_add'])->name('admin.surat_add');

    Route::post('/admin/surat/store/{id}', [SuratController::class, 'surat_store'])->name('admin.surat_store');

    Route::get('/admin/surat/hapus/{id}', [SuratController::class, 'surat_hapus'])->name('admin.surat_hapus');

    Route::get('/admin/dosbing', [DosenController::class, 'adminDosbing'])->name('admin.dosbing');

    Route::get('/admin/dosbing/add', [DosenController::class, 'dosbing_add'])->name('admin.dosbing_add');

    Route::post('/admin/dosbing/store', [DosenController::class, 'dosbing_store'])->name('admin.dosbing_store');

    Route::get('/admin/dosbing/edit/{id}', [DosenController::class, 'dosbing_edit'])->name('admin.dosbing_edit');

    Route::put('/admin/dosbing/update/{id}', [DosenController::class, 'dosbing_update'])->name('admin.dosbing_update');

    Route::get('/admin/dosbing/hapus/{id}', [DosenController::class, 'dosbing_hapus'])->name('admin.dosbing_hapus');

    Route::get('/admin/mhs', [MhsController::class, 'adminMhs'])->name('admin.mhs');

    Route::get('/admin/mhs/add', [MhsController::class, 'mhs_add'])->name('admin.mhs_add');

    Route::post('/admin/mhs/store', [MhsController::class, 'mhs_store'])->name('admin.mhs_store');

    Route::get('/admin/mhs/edit/{id}', [MhsController::class, 'mhs_edit'])->name('admin.mhs_edit');

    Route::put('/admin/mhs/update/{id}', [MhsController::class, 'mhs_update'])->name('admin.mhs_update');

    Route::get('/admin/mhs/hapus/{id}', [MhsController::class, 'mhs_hapus'])->name('admin.mhs_hapus');
});
