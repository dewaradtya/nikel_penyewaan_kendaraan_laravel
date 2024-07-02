<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PemesananController;
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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::get('/aktivitas', [PageController::class, 'aktivitas'])->name('admin.page.aktivitas');
    Route::patch('/pemesanan/{id}/approve', [PemesananController::class, 'approve'])->name('pemesanan.approve');
    Route::delete('/aktivitas/delete', [PageController::class, 'deleteAll'])->name('aktivitas.delete');
    Route::resource('kendaraan', KendaraanController::class)->middleware('userAkses:admin');
    Route::resource('pemesanan', PemesananController::class)->middleware('userAkses:admin')->except(['index']);
    Route::get('export', [PageController::class, 'export'])->name('export');
    Route::get('/export-all', [PageController::class, 'exportAll'])->name('export.all');
    Route::post('/import', [PageController::class, 'import'])->name('import');
});
