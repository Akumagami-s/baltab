<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Sanbox extends Controller
{
    // public function index()
    // {
    //     if (!Auth::user()->role==0) {
    //         return redirect('https://asiabytes.tech/baltab/datapok');
    //     } else {
    //         $a=DB::table('sanbox_datapokok')->where('is_complate',0)->count();
    //         $b=DB::table('sanbox_datapokok')->where('is_complate', 1)->count();
    //         $data['kelengkapan']=[
    //             'lengkap'=>$b,
    //             'tidak'=>$a,
    //         ];
    //         $a=DB::table('pengajuans')->whereNull('is_sprin')->count();
    //         $b=DB::table('pengajuans')->whereNotNull('is_sprin')->count();
    //         $data['sprin']=[
    //             'lengkap'=>$b,
    //             'tidak'=>$a,
    //         ];
    //         // dd($a,$b);
    //         // dd($a);
    //         $data['alokasi']=array_reverse($this->alokasi());
    //         // dd($data);
    //         return view('welcome', ['data'=>$data]);
    //     }
    // }
    private function just()
    {
        $dam='1986-01-01';
        $diff = date_diff(date_create($dam), date_create(date('Y-m-d')));
        return ($diff->y*12+$diff->m);
    }
    public function peri($data)
    {
        $pi=0;
        foreach ($data as $key => $value) {
            $ma=str_replace('.','',$value->jumlah);
            $pi=$pi+(float)$ma;

        }
        // dd($pi);
        return $pi;
    }
    public function alokasi()
    {
        $ajuan=[];
        $awalan=date('Y-m'.'-29');
        // $diajukan=DB::table('datapokok_pembayaran')->where('created_at','>=','2021-01-01')->where('created_at','<=','2021-02-01')->where('status','=','3')->get();
        // $cair=DB::table('datapokok_pembayaran')->where('created_at','>=','2021-01-01')->where('created_at','<=','2021-02-01')->where('status','=','4')->get();
        $a=$this->just();
        for ($i=0; $i <$a ; $i++) {
            $awalanp1=date('Y-m-d', strtotime('-1 month', strtotime($awalan)));
            // dump($awalanp1.' Poin '.$awalan);
            $pengajuan=DB::table('datapokok_pembayaran')->where('created_at', '>=', $awalanp1)->where('created_at', '<=', $awalan)->where('status', '=', '1');
            $pesetujuan=DB::table('datapokok_pembayaran')->where('created_at', '>=', $awalanp1)->where('created_at', '<=', $awalan)->where('status', '=', '2');
            $pencairan=DB::table('datapokok_pembayaran')->where('created_at', '>=', $awalanp1)->where('created_at', '<=', $awalan)->where('status', '=', '3');
            $selesai=DB::table('datapokok_pembayaran')->where('created_at', '>=', $awalanp1)->where('created_at', '<=', $awalan)->where('status', '=', '4');
            // if ($pengajuan->count()!=0) {
                $ajuan[$i]=['mulai'=>$awalanp1,'akhir'=>$awalan,
                'pengajuan'=>$pengajuan->count(),'total_pengajuan'=>$this->peri($pengajuan->get('jumlah')),
                'persetujuan'=>$pesetujuan->count(),'total_pesetujuan'=>$this->peri($pesetujuan->get('jumlah')),
                'pencairan'=>$pencairan->count(),'total_pencairan'=>$this->peri($pencairan->get('jumlah')),
                'selesai'=>$selesai->count('jumlah'),'total_selesai'=>$this->peri($selesai->get('jumlah')),
                // 'datapin'=>$pengajuan->get(),
            ];
            // }
            $awalan=$awalanp1;
            if (count($ajuan)==12) {
                break;
            }
        }
        $ajuan=array_values($ajuan);
        // dd($ajuan);
        if (!empty($_GET['call'])) {
            return response()->json($ajuan, 200);
        }
        // dd($ajuan);
        return $ajuan;
    }

    public function Api()
    {
        $ajuan=[];
        $awalan=date('Y-m'.'-29');
        $a=$this->just();
        for ($i=0; $i <$a ; $i++) {
            $awalanp1=date('Y-m-d', strtotime('-1 month', strtotime($awalan)));
            $pencairan=DB::table('sanbox_datapokok_pembayaran')->where('created_at', '>=', $awalanp1)->where('created_at', '<=', $awalan)->where('status', '=', '3');
            $data=[];
            foreach ($pencairan->get() as $key => $value) {
                // dd($value);
                $pon=DB::table('sanbox_datapokok')->where('_id',$value->datapokok_id)->first();
                if (!empty($pon)) {
                    $data[$key]['atas_nama']=$value->atas_nama;
                    $data[$key]['jumlah']=$value->jumlah;
                    $data[$key]['total_bulan']=$value->bulan;
                    $data[$key]['nama_bank']=$value->nama_bank;
                    $data[$key]['no_rekening']=$value->no_rekening;
                    $pon=DB::table('sanbox_datapokok')->where('_id',$value->datapokok_id)->first();
                    $data[$key]['data_prajurit']['nama_prajurit']=$pon->nama;
                    $data[$key]['data_prajurit']['nrp']=$pon->nrp;
                    $data[$key]['data_prajurit']['tanggal pensiun']=$pon->tgl_pensiun;
                }

            }
                $ajuan[$i]=['mulai'=>$awalanp1,
                'data'=>$data,
            ];
             $awalan=$awalanp1;
            if (count($ajuan)==1) {
                break;
            }
        }
        $ajuan=array_values($ajuan);
            return response()->json($ajuan, 200);
    }


    public function cekbulan()
    {






            $pencairan=DB::table('sanbox_datapokok_pembayaran')->where('sprin_date', 'LIKE', "2021")->where('tanggal','LIKE','12')->where('status', '=', '3');
        
        dd($pencairan->get());
            foreach ($pencairan->get() as $key => $value) {

                $pon=DB::table('sanbox_datapokok')->where('_id',$value->datapokok_id)->first();
                dd($pon);

            }



            return response()->json($ajuan, 200);
    }
}
