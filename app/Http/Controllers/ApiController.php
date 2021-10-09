<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\dtpkk;
use App\Models\Datapokokpembayaran;
use App\Models\Pengajuan;
use Carbon\Carbon;
class ApiController extends Controller
{
    public function datapokok()
    {
        $prajurit = DB::table('datapokok')->whereNotNull('tg_lahir')->whereNotNull('nrp')->paginate(100);
        return response()->json($prajurit, 200);
    }

    public function dataLengkap()
    {
        $data = dtpkk::where(['is_pengajuan'=>FALSE,'is_pensiun'=>TRUE,'is_complate'=>TRUE])->paginate(100);
        return response()->json($data, 200);
    }
    public function dataTidakLengkap()
    {
        $data = dtpkk::where(['is_pensiun'=>TRUE,'is_complate'=>FALSE])->paginate(100);
        return response()->json($data, 200);
    }
    public function pengajuan()
    {
        $data = Datapokokpembayaran::where('status',2)->paginate(100);
        return response()->json($data, 200);
    }
    public function pembayaran()
    {
        $data = Datapokokpembayaran::where('status',3)->paginate(100);
        return response()->json($data, 200);
    }

    public function pencairan()
    {
        $data = Datapokokpembayaran::where('status',4)->paginate(100);
        return response()->json($data, 200);
    }


    public function addPengajuan(Request $request)
    {
        if (is_null($request->pengajuan_ids)) {
            return response()->json(['message'=>'Anda tidak memilih 1 pengajuan pun'], 200);
        }
        $err = [];
        $succ = [];

        foreach (array_filter(explode(',',$request->pengajuan_ids)) as $key => $value) {


            $data =   dtpkk::where(['is_pengajuan'=>FALSE,'is_pensiun'=>TRUE,'is_complate'=>TRUE,'id'=>$value])->first();

            if (is_null($data)) {
               $err[] = "data anda dengan datapokok id ".$value." tidak memenuhi syarat";
            } else {
                dtpkk::where('id', $value)->update([
                    'is_pengajuan'=>1,
                ]);

                    if (is_null(Pengajuan::where('nrp',$data->nrp)->first())) {
                    Pengajuan::create([
                    'nrp' => $data->nrp,
                    'notam' => $data->notam,
                    'nama' => $data->nama,
                    'gelar_dpn' => $data->gelar_dpn,
                    'gelar_blk' => $data->gelar_blk,
                    'pangkat' => $data->pangkat,
                    'tmt_pkt' => $data->tmt_pkt,
                    'ur_jab_skep' => $data->ur_jab_skep,
                    'corps' => $data->corps,
                    'kd_ktm' => $data->kd_ktm,
                    'kd_smkl' => $data->kd_smkl,
                    'kesatuan' => $data->kesatuan,
                    'tmt_1' => $data->tmt_abri,
                    'tmt_2' => $data->tmt_2,
                    'tmt_3' => $data->tmt_3,
                    'tmt_4' => $data->tmt_4,
                    'tmt_5' => $data->tmt_5,
                    'tmt_abri' => $data->tmt_abri,
                    'npwp' => $data->npwp,
                    'tmt_henti' => $data->tmt_henti,
                    'kode_p_sub' => $data->kode_p_sub,
                    'kd_bansus' => $data->kd_bansus,
                    'tg_update' => $data->tg_update,
                    'tmt_pa' => $data->tmt_pa,
                    'tg_lahir' => $data->tg_lahir,
                    'no_bitur' => $data->no_bitur,
                    'kd_ktg' => $data->kd_ktg,
                    'tmt_ktg' => $data->tmt_ktg,
                    'g_pokok' => $data->g_pokok,
                    't_istri' => $data->t_istri,
                    't_anak' => $data->t_anak,
                    'kpr1' => $data->kpr1,
                    'kpr2' => $data->kpr2,
                    'kd_stakel' => $data->kd_stakel,
                    'nm_kel1' => $data->nm_kel1,
                    'nm_kel2' => $data->nm_kel2,
                    'nm_kel3' => $data->nm_kel3,
                    'alamat' => $data->alamat,

                ]);
                    }


                    $dt = app('App\Http\Controllers\HaveController')->cariTab($data->nrp);

                    Datapokokpembayaran::create([
                    'datapokok_id'=>$data->_id,
                    'jumlah'=>$dt['jumlah'],
                    'bulan'=>$dt['bulan'],
                    'bunga'=>$dt['bunga'],
                    'nama_bank'=>$data->nabank,
                    'no_rekening'=>$data->norek,
                    'atas_nama'=>$data->narek,
                    'status'=>2

                ]);

                $succ[] = "data anda dengan datapokok ".$value." Berhasil ditambahkan";

            }



        }

        return response()->json(['err'=>$err,'succ'=>$succ], 200);

    }



    public function addNoSprin(Request $request)
    {

        if (is_null($request->pengajuan_ids)) {
            return response()->json(['message'=>'Anda tidak memilih 1 pengajuan pun'], 200);
        }
        if (is_null($request->nosprin)) {
            return response()->json(['message'=>'Anda tidak memasukan no sprin'], 200);
        }

        $err = [];
        $succ  = [];

        foreach (array_filter(explode(',',$request->pengajuan_ids)) as $value) {
            try {


                $dapok = dtpkk::where('nrp', $value)->first();
                $dtp = Datapokokpembayaran::where('datapokok_id',$dapok->_id);

                if ($dtp->first()->status == 2) {
                    $dtp->update([
                        'sprin_date'=>Carbon::now()->toDateString(),
                        'status'=>3
                    ]);


                    dtpkk::where('nrp',$dapok->nrp)->update([
                        'total'=>$dtp->first()->jumlah,
                        'bunga'=>$dtp->first()->bunga,
                    ]);

                    Pengajuan::where('nrp', $value)->update([
                    'no_sprin'=>$request->nosprin,
                    'is_sprin'=>true,

                ]);
                $succ[] = 'success di pengajuan NRP '.$value;

                }
                else {
                    $err[] = "data anda dengan NRP ".$value." tidak memenuhi syarat";
                }




            } catch (\Throwable $th) {
                $err[] = 'error di pengajuan NRP '.$value.$th;
            }
        }




        return response()->json(['err'=>$err,'succ'=>$succ], 200);
    }



    public function getTab($nrp)
    {
        $hasil = app('App\Http\Controllers\HaveController')->index($nrp);

        return response()->json(['message'=>'Data tabugan','data'=>$hasil], 200);
    }

    public function specData($nrp)
    {
        $hasil =dtpkk::where('nrp',$nrp)->first();

        return response()->json(['message'=>'Data Pokok Prajurit','data'=>$hasil], 200);
    }
}
