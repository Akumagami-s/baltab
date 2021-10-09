<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MosmanController extends Controller
{
    public function index()
    {
        if (Auth::user()->role==0 || Auth::user()->role == 1) {
            $a=DB::table('datapokok')->where('is_complate', 0)->count();
            $b=DB::table('datapokok')->where('is_complate', 1)->count();
            $data['kelengkapan']=[
                'lengkap'=>$b,
                'tidak'=>$a,
            ];
            $a=DB::table('pengajuans')->whereNull('is_sprin')->count();
            $b=DB::table('pengajuans')->whereNotNull('is_sprin')->count();
            $data['sprin']=[
                'lengkap'=>$b,
                'tidak'=>$a,
            ];
            $data['alokasi']=array_reverse($this->alokasi());
            return view('welcome', ['data'=>$data]);
        } else {
            return redirect('https://asiabytes.tech/baltab/datapok');

        }
    }
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
            $ma=str_replace('.', '', $value->jumlah);
            $pi=$pi+(float)$ma;
        }
        // dd($pi);
        return $pi;
    }

    public function alokasi($bin=0,$tgl=null)
    {
        $ajuan=[];
        $awalan=date('Y-m-d');
        if (!empty($tgl)) {
            $awalan=$tgl;
        }
        // dd($awalan);
        $a=$this->just();
        for ($i=0; $i <$a ; $i++) {
            $awalanp1=date('Y-m-d', strtotime('-1 month', strtotime($awalan)));
            $pengajuan=DB::table('datapokok_pembayaran')->where('created_at', '>=', $awalanp1)->where('created_at', '<=', $awalan)->where('status', '=', '1');
            $pesetujuan=DB::table('datapokok_pembayaran')->where('created_at', '>=', $awalanp1)->where('created_at', '<=', $awalan)->where('status', '=', '2');
            $pencairan=DB::table('datapokok_pembayaran')->where('created_at', '>=', $awalanp1)->where('created_at', '<=', $awalan)->where('status', '=', '3');
            $selesai=DB::table('datapokok_pembayaran')->where('created_at', '>=', $awalanp1)->where('created_at', '<=', $awalan)->where('status', '=', '4');
            $ajuan[$i]=['mulai'=>$awalanp1,'akhir'=>$awalan,
                'pengajuan'=>$pengajuan->count(),'total_pengajuan'=>$this->peri($pengajuan->get('jumlah')),
                'persetujuan'=>$pesetujuan->count(),'total_pesetujuan'=>$this->peri($pesetujuan->get('jumlah')),
                'pencairan'=>$pencairan->count(),'total_pencairan'=>$this->peri($pencairan->get('jumlah')),
                'selesai'=>$selesai->count('jumlah'),'total_selesai'=>$this->peri($selesai->get('jumlah')),
            ];

            $awalan=$awalanp1;
            if ($bin==1) {

            } elseif (count($ajuan)==12) {
                break;
            }
        }
        $ajuan=array_values($ajuan);
        if (!empty($_GET['call'])) {
            return response()->json($ajuan, 200);
        }
        return $ajuan;
    }

    public function Api($bil=1)
    {
        if (!empty($_GET['c'])) {
            $bil=$_GET['c'];
        }
        // dd($bil);
        $ajuan=[];
        $awalan=date('Y-m'.'-29');
        $a=$this->just();
        for ($i=0; $i <$a ; $i++) {
            $awalanp1=date('Y-m-d', strtotime('-1 month', strtotime($awalan)));
            $pencairan=DB::table('datapokok_pembayaran')->where('created_at', '>=', $awalanp1)->where('created_at', '<=', $awalan)->where('status', '=', '3');
            $data=[];
            foreach ($pencairan->get() as $key => $value) {
                $pon=DB::table('datapokok')->where('_id', $value->datapokok_id)->first();
                if (!empty($pon)) {
                    $data[$key]['atas_nama']=$value->atas_nama;
                    $data[$key]['jumlah']=$value->jumlah;
                    $data[$key]['total_bulan']=$value->bulan;
                    $data[$key]['nama_bank']=$value->nama_bank;
                    $data[$key]['no_rekening']=$value->no_rekening;
                    $pon=DB::table('datapokok')->where('_id', $value->datapokok_id)->first();
                    $data[$key]['data_prajurit']['nama_prajurit']=$pon->nama;
                    $data[$key]['data_prajurit']['nrp']=$pon->nrp;
                    $data[$key]['data_prajurit']['tanggal pensiun']=$pon->tgl_pensiun;
                }
            }
            $ajuan[$i]=['mulai'=>$awalanp1,
                'data'=>$data,
            ];
            $awalan=$awalanp1;
            if (count($ajuan)==$bil) {
                break;
            }
        }
        $ajuan=array_values($ajuan);
        return response()->json($ajuan, 200);
    }
    public function Statif()
    {
        $aktif=DB::table('datapokok')->where('kd_ktg',1)->count();
        $tidak=DB::table('datapokok')->whereNotIn('kd_ktg',1)->count();
        return [
            'Aktif'=>$aktif,
            'tidak'=>$tidak,
        ];

    }
    public function ping()
    {
        $po=date('Y-m-d');
        // dd($po);
        $a=$this->alokasi(0,$po);

        //rekap aktif
        $b=$this->Statif();
        dd($b);
    }

    public function Rekapulanan()
    {

    }
}
