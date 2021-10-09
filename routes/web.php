<?php
use App\Http\Controllers\DatapokokController;
use App\Http\Controllers\MosmanController;
use App\Http\Controllers\Sanbox;
use App\Http\Controllers\PangkatController;
use Illuminate\Routing\RouteGroup;
use App\Http\Controllers\MasterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HaveController;
use App\Http\Controllers\CronController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

Route::get('/', [MosmanController::class,'index'])->middleware('ssocheck')->middleware('logoutus');



Route::get('/alokasi', [MosmanController::class,'alokasi']);
Route::get('/calldatakeluar', [MosmanController::class,'api']);
Route::get('/ping', [MosmanController::class,'ping']);
Route::get('/sanbox/calldatakeluar', [Sanbox::class,'api']);
Route::get('/sanbox/calldatakeluarbulanan', [Sanbox::class,'cekbulan']);

Route::middleware(['ssocheck'])->group(function () {



    Route::get('/editBaltab', [DatapokokController::class,'editBaltab'])->name('editBaltab');
    Route::get('/datapok', [DatapokokController::class,'index'])->name('dapok');


    Route::middleware(['isAdmin'])->group(function () {

Route::get('/ajukan', [DatapokokController::class,'editBaltab'])->name('ajukan');
// Route::get('/masle', [DatapokokController::class,'masle']);

// Route::get('/datapok/update', [DatapokokController::class,'update']);
Route::post('/datapok/update', [DatapokokController::class,'update']);
Route::get('/dataPokokTabel', [DatapokokController::class,'dataPokokTabel'])->name('dataPokokTabel');

Route::get('/pengajuan', [DatapokokController::class,'pengajuan'])->name('pengajuan');
Route::get('/dataPengajuan', [DatapokokController::class,'dataPengajuan'])->name('dataPengajuan');
Route::post('/addSprin', [DatapokokController::class,'addSprin'])->name('addSprin');
Route::post('/deletePengajuan', [DatapokokController::class,'deletePengajuan'])->name('deletePengajuan');
Route::get('/cekSprin', [DatapokokController::class,'cekSprin'])->name('cekSprin');
Route::get('/seeSprin', [DatapokokController::class,'seeSprin'])->name('seeSprin');
Route::get('/downloadSprin', [DatapokokController::class,'downloadSprin'])->name('downloadSprin');
Route::get('/seePembayaran', [DatapokokController::class,'seePembayaran'])->name('seePembayaran');
Route::get('/seeBeres', [DatapokokController::class,'seeBeres'])->name('seeBeres');


Route::post('/addNoSprin', [DatapokokController::class,'addNoSprin'])->name('addNoSprin');
Route::get('/seeDetailSprin/{param}', [DatapokokController::class,'seeDetailSprin'])->name('seeDetailSprin');

Route::get('/master', [MasterController::class,'master'])->name('master');

Route::post('/createPangkat', [MasterController::class,'createPangkat'])->name('createPangkat');
Route::get('/updatePangkat/{id}', [MasterController::class,'updatePangkat'])->name('updatePangkat');
Route::get('/deletePangkat/{id}', [MasterController::class,'deletePangkat'])->name('deletePangkat');
Route::post('/editPangkat/{id}', [MasterController::class,'editPangkat'])->name('editPangkat');

Route::post('/createKesatuan', [MasterController::class,'createKesatuan'])->name('createKesatuan');
Route::get('/updateKesatuan/{id}', [MasterController::class,'updateKesatuan'])->name('updateKesatuan');
Route::get('/deleteKesatuan/{id}', [MasterController::class,'deleteKesatuan'])->name('deleteKesatuan');
Route::post('/editKesatuan/{id}', [MasterController::class,'editKesatuan'])->name('editKesatuan');

Route::post('/createCorp', [MasterController::class,'createCorp'])->name('createCorp');
Route::get('/deleteCorp/{id}', [MasterController::class,'deleteCorp'])->name('deleteCorp');
Route::get('/updateCorp/{id}', [MasterController::class,'updateCorp'])->name('updateCorp');
Route::post('/editCorp/{id}', [MasterController::class,'editCorp'])->name('editCorp');


Route::post('/createKategori', [MasterController::class,'createKategori'])->name('createKategori');
Route::get('/deleteKategori/{id}', [MasterController::class,'deleteKategori'])->name('deleteKategori');
Route::get('/updateKategori/{id}', [MasterController::class,'updateKategori'])->name('updateKategori');
Route::post('/editKategori/{id}', [MasterController::class,'editKategori'])->name('editKategori');


Route::post('/createKotama', [MasterController::class,'createKotama'])->name('createKotama');
Route::get('/deleteKotama/{id}', [MasterController::class,'deleteKotama'])->name('deleteKotama');
Route::get('/updateKotama/{id}', [MasterController::class,'updateKotama'])->name('updateKotama');
Route::post('/editKotama/{id}', [MasterController::class,'editKotama'])->name('editKotama');


Route::post('/createSatminkal', [MasterController::class,'createSatminkal'])->name('createSatminkal');
Route::get('/deleteSatminkal/{id}', [MasterController::class,'deleteSatminkal'])->name('deleteSatminkal');
Route::get('/updateSatminkal/{id}', [MasterController::class,'updateSatminkal'])->name('updateSatminkal');
Route::post('/editSatminkal/{id}', [MasterController::class,'editSatminkal'])->name('editSatminkal');


Route::post('/createBunga', [MasterController::class,'createBunga'])->name('createBunga');
Route::get('/deleteBunga/{id}', [MasterController::class,'deleteBunga'])->name('deleteBunga');
Route::get('/updateBunga', [MasterController::class,'updateBunga'])->name('updateBunga');


Route::post('/createPotongan', [MasterController::class,'createPotongan'])->name('createPotongan');
Route::get('/deletePotongan/{id}', [MasterController::class,'deletePotongan'])->name('deletePotongan');
Route::get('/updatePotongan', [MasterController::class,'updatePotongan'])->name('updatePotongan');

Route::get('/profiling', function () {
        return view('profiling.index');
    })->name('profiling');

Route::post('/importPengajuan', [DatapokokController::class,'importPengajuan'])->name('importPengajuan');




Route::get('/have', [HaveController::class,'index']);

Route::get('/exportPensiun', [HaveController::class,'exportPensiun'])->name('exportPensiun');
Route::get('/refresh', [CronController::class,'profiling'])->name('refresh');
Route::get('/validate_profiling', [CronController::class,'validate_profiling'])->name('validate_profiling');
Route::get('/profilingLengkap', [HaveController::class,'profilingLengkap'])->name('profilingLengkap');
Route::get('/profilingBiasa', [HaveController::class,'profilingBiasa'])->name('profilingBiasa');
Route::post('/addPengajuan', [DatapokokController::class,'addPengajuan'])->name('addPengajuan');
Route::post('/profilingbulan', [HaveController::class,'profilingbulan'])->name('profilingbulan');
Route::get('/exportDataProfiling', [HaveController::class,'exportDataProfiling'])->name('exportDataProfiling');


Route::get('/deletedapok/{id}', function ($id)
{
    dtpkk::where('id',$id)->delete();
return redirect()->route('dashboard', ['message'=>'datapokok sudah didelete']);
})->name('deletedapok');
Route::get('/makeMessage', [HaveController::class,'makeMessage'])->name('makeMessage');
Route::post('/postMessage', [HaveController::class,'postMessage'])->name('postMessage');
Route::post('/getWho', [HaveController::class,'getWho'])->name('getWho');

    });






Route::get('/notification', function () {

    return view('notification.index');
})->name('notification');

Route::post('/read_notif', [HaveController::class,'read_notif'])->name('read_notif');
Route::get('/getnotify', function ()
{
    $dt = [];
    $data = DB::connection('login')->table('notify')->where('nrp', Auth::user()->nrp)->where('is_send', FALSE)->get();
    foreach ($data as $key => $value) {
        $dt[] = $value->judul;
    }



    return response()->json($dt,200);


})->name('getnotify');


Route::get('/setnotify', function ()
{
    $dt = [];
    $data = DB::connection('login')->table('notify')->where('nrp', Auth::user()->nrp)->where('is_send', FALSE)->get();
    // foreach ($data as $key => $value) {

    //     DB::table('notify')->where('id', $value->id)->update([
    //         'is_send'=>TRUE
    //     ]);
    //     }
    DB::connection('login')->table('notify')->where('nrp', Auth::user()->nrp)->where('is_send', FALSE)->update([
        'is_send'=>TRUE,
    ]);


    return response()->json(['message'=>'success'],200);


})->name('setnotify');




});

