<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MosmanController;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware(['apiSpecial'])->group(function () {

Route::get('/dataPokok', [ApiController::class,'datapokok'])->name('datapokok');
Route::get('/dataLengkap', [ApiController::class,'dataLengkap'])->name('dataLengkap');
Route::get('/dataTidakLengkap', [ApiController::class,'dataTidakLengkap'])->name('dataTidakLengkap');
Route::get('/pengajuan', [ApiController::class,'pengajuan'])->name('pengajuan');
Route::get('/pembayaran', [ApiController::class,'pembayaran'])->name('pembayaran');
Route::get('/pencairan', [ApiController::class,'pencairan'])->name('pencairan');

Route::post('/addPengajuan', [ApiController::class,'addPengajuan'])->name('addPengajuan');
Route::post('/addNoSprin', [ApiController::class,'addNoSprin'])->name('addNoSprin');
Route::get('/getTab/{nrp}', [ApiController::class,'getTab'])->name('getTab');

});
