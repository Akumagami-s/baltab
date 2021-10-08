<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\datapokok;
use App\Models\dtpkk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use PhpParser\Node\Stmt\Echo_;
use App\Models\Pengajuan;
use App\Exports\ExportPensiun;
use Carbon\Carbon;
use App\Exports\DataProfiling;
use Excel;
use App\Models\Potongan;

class HaveController extends Controller
{
    public static function loadPeriod($period, $pangkat = '')
    {
        $period = join('-', explode('-', $period));
        if ($period >= '2009-04') {
            $find = DB::table('potongans')->where('period', '<=', $period)->where('pangkat', '*')->orderBy('period', 'desc')->first();
            return $find->value;
        } else {
            $find_query = ['pangkat'=>$pangkat];
            $find = Potongan::where($find_query)->first();
        }

        if ($find) {
            return $find['value'];
        }

        return 0;
    }

    public function index($nrp)
    {
        $user=DB::table('datapokok')->where('nrp', $nrp)->first();
        // 3900152380269 , 620134 ,29593


        if (is_null($user)) {
            return response()->json(['message'=>'user tidak ditemukan'], 200);
        }else if(is_null($user->tmt_henti)){
            $user->tmt_henti = date("Y-m-d");
            // return response()->json(['message'=>'TMT henti tidak didefinisikan'], 200);
        }
        // dd($user->tmt_henti);

        $tmt_1 = $user->tmt_1 == '000000' ? '' : $user->tmt_1;
        $tmt_2 = $user->tmt_2 == '000000' ? '' : $user->tmt_2;
        $tmt_3 = $user->tmt_3 == '000000' ? '' : $user->tmt_3;
        $tmt_4 = $user->tmt_4 == '000000' ? '' : $user->tmt_4;
        $tmt_5 = $user->tmt_5 == '000000' ? '' : $user->tmt_5;
        $tmtrange=[$user->tmt_1,$user->tmt_2,$user->tmt_3,$user->tmt_4,$user->tmt_5,$user->tmt_henti];
        $pangkat=['tamtama','bintara','pama', 'pamen','pati','henti'];
        $panggkatbin=[];
        foreach ($tmtrange as $key=>$dam) {
            if (empty($dam)) {
                unset($tmtrange[$key]);
            } else {
                $panggkatbin[$key]=$pangkat[$key];
            }
        }

        $panggkatbin=array_values($panggkatbin);
        $tmtrange=array_values($tmtrange);

        $bunga_list = [];
        foreach (DB::table('bungas')->get() as $key => $value) {
            $bunga_list[$value->period] = $value->value;
        }
        // dd($bunga_list);


try {
    $dt1 = explode("-", $tmtrange[0]);
    $dat1 = $dt1[0]."-".$dt1[1]."-01";

    $dt2 = explode("-", $user->tmt_henti);

    $akh = $dt2[1]+1;

    // dd($akh);
    if (strlen($akh) != 2) {
        $dat2 = $dt2[0]."-0".$akh."-01";
    }else {
        if ($akh > 12) {
            $dv = $dt2[0]+1;
            $dat2 = $dv."-01-01";
        }else {
            $dat2 = $dt2[0]."-".$akh."-01";
        }
    }

    $date1 = date_create($dat1);
    $date2 = date_create($dat2);
    $interval = $date1->diff($date2);
    $all = $interval->m + $interval->y * 12;
    $bunga =  DB::table('bungas')->where('period','<=',$dt1[0]."-".$dt1[1])->orderBy('period','DESC')->first()->value;

    // dd($all);

} catch (\Throwable $th) {
    return response()->json(['message'=>'Error di data itu !'], 200);
}

        if ($dt1[0].'-'.$dt1[1]<'1986-02') {
            $potongan=0;
        }
        else{
            $potongan =$this->loadPeriod(substr($tmtrange[0], 0, 7), $panggkatbin[0]);
        }
        // dd($potongan);

        $jml_tabungan = 0;
        $bunga_bulanan = 0;
        $bunga_arr = [];
        $tab_arr = [];
        $pangkat = '';
        $arr_pangkat = [];

        $pangkat_list = [];

        $dt = strtotime($dt1[0].'-'.$dt1[1]);
        // echo "<pre>";
        $daass=[];
        for ($i=0; $i < $all; $i++) {
            if ($i == 0) {
                $jml_tabungan += $potongan;
            } else {
                $dn = date("Y-m", strtotime("+1 month", $dt));


                switch ($dn) {
            case substr($tmt_1, 0, 7):
                $pangkat = 'tamtama';
                break;
            case substr($tmt_2, 0, 7):
                $pangkat = 'bintara';
                break;
            case substr($tmt_3, 0, 7):
                $pangkat = 'pama';
                break;
            case substr($tmt_4, 0, 7):
                $pangkat = 'pamen';
                break;
            case substr($tmt_5, 0, 7):
                $pangkat = 'pati';
                break;
        }

        if ($dn == "1986-02") {
            $potongan = Potongan::where(['pangkat'=>$panggkatbin[0],'period'=>"1986-02"])->first()->value;

        }
        try {
            if (!is_null($bunga_list[$dn])) {
                $bunga = $bunga_list[$dn];
            }
        } catch (\Throwable $th) {

        }

        if ($dn == "2009-04" || $dn == "2017-01" ) {
            $potongan = $this->loadPeriod($dn, $pangkat);
                    $tab_arr[] = $jml_tabungan - array_sum($bunga_arr) - array_sum($tab_arr);
                } elseif (!in_array($pangkat, $pangkat_list)) {
                    if ($this->loadPeriod($dn, $pangkat) != 0) {
                        $potongan = $this->loadPeriod($dn, $pangkat);
                        $pangkat_list[] = $pangkat;
                        $tab_arr[] = $jml_tabungan - array_sum($bunga_arr) - array_sum($tab_arr);
                    }
                }
                // dump("jumlah tabungan ".$jml_tabungan ."pada tanggal ".$dn." pangkatnya ".$pangkat. " potongannya ".$potongan.'bunganya '.$bunga.' jml_bunga'.array_sum($bunga_arr));


                $bunga_bulanan = number_format(($jml_tabungan * ($bunga) / 12/100), 2, '.', '');
                $jml_tabungan = number_format(($jml_tabungan + ($jml_tabungan * ($bunga) / 12/100) + $potongan), 2, '.', '');
                $bunga_arr[] = (float) $bunga_bulanan;
                $daass[]=[$bunga,$dn,$potongan,(float) $bunga_bulanan,$jml_tabungan];
                $dt = strtotime($dn);
            }
        }

        // $cb = $jml_tabungan-array_sum($bunga_arr);
        // dump($jml_tabungan. ' '.$cb.' '.array_sum($bunga_arr) );


        $tab_arr[] = $jml_tabungan - array_sum($bunga_arr) - array_sum($tab_arr);
        $masi=DB::table('potongans')->orderBy('period', 'desc')->get();
        $musa=[];

        foreach ($masi as $key => $value) {
            $binbul=0;
            // dump($value->value);
            foreach ($daass as $key2 => $value2) {
                if ($value->value==$value2[2]) {
                    // dd($value2)
                    $musa[$key]['potongan']=$value2;
                    $musa[$key]['pangkat']=$value->pangkat;
                    $binbul++;
                }

            }
            if ($binbul!=0) {
                $musa[$key]['bulan']=$binbul;
            }
            // dump($musa);
        }
        // die;

        // dd($musa);
        $musa=array_reverse($musa);
        foreach ($musa as $key => $value) {
            $musa[$key]['total_period']=$tab_arr[$key];
        }
        $total['perhitungan']=$musa;
        $total['bunga']=array_sum($bunga_arr);
        $total['total']=$jml_tabungan;
        return $total;
    }







    public function read_notif(Request $request)
    {


        DB::table('notify')->where('id',$request->notif_id)->update([
            'is_read'=>1
        ]);
        return response()->json(['count'=>DB::table('notify')->where('nrp', Auth::user()->nrp)->where('is_read',0)->count()], 200);
    }





    public function cariTab($nrp)
    {
        $user=DB::table('datapokok')->where('nrp', $nrp)->first();
        // 3900152380269 , 620134 ,29593


        if (is_null($user)) {
            return redirect()->back()->with(['message'=>'user tidak ditemukan']);
            // return response()->json(['message'=>'user tidak ditemukan'], 200);
        }else if(is_null($user->tmt_henti)){
            return redirect()->back()->with(['message'=>'TMT HENTI tidak ditemukan']);
        }


        $tmt_1 = $user->tmt_1 == '000000' ? '' : $user->tmt_1;
        $tmt_2 = $user->tmt_2 == '000000' ? '' : $user->tmt_2;
        $tmt_3 = $user->tmt_3 == '000000' ? '' : $user->tmt_3;
        $tmt_4 = $user->tmt_4 == '000000' ? '' : $user->tmt_4;
        $tmt_5 = $user->tmt_5 == '000000' ? '' : $user->tmt_5;
        $tmtrange=[$user->tmt_1,$user->tmt_2,$user->tmt_3,$user->tmt_4,$user->tmt_5,$user->tmt_henti];
        $pangkat=['tamtama','bintara','pama', 'pamen','pati','henti'];
        $panggkatbin=[];
        foreach ($tmtrange as $key=>$dam) {
            if (empty($dam)) {
                unset($tmtrange[$key]);
            } else {
                $panggkatbin[$key]=$pangkat[$key];
            }
        }

        $panggkatbin=array_values($panggkatbin);
        $tmtrange=array_values($tmtrange);

        $bunga_list = [];
        foreach (DB::table('bungas')->get() as $key => $value) {
            $bunga_list[$value->period] = $value->value;
        }

try {
    $dt1 = explode("-", $tmtrange[0]);
    $dat1 = $dt1[0]."-".$dt1[1]."-01";

    $dt2 = explode("-", $user->tmt_henti);

    $akh = $dt2[1]+1;


    if (strlen($akh) != 2) {
        $dat2 = $dt2[0]."-0".$akh."-01";
    }else {
        if ($akh > 12) {
            $dv = $dt2[0]+1;
            $dat2 = $dv."-01-01";
        }else {
            $dat2 = $dt2[0]."-".$akh."-01";
        }
    }

    $date1 = date_create($dat1);
    $date2 = date_create($dat2);
    $interval = $date1->diff($date2);
    $all = $interval->m + $interval->y * 12;
    $bunga =  DB::table('bungas')->where('period','<=',$dt1[0]."-".$dt1[1])->orderBy('period','DESC')->first()->value;


} catch (\Throwable $th) {
    return redirect()->back()->with(['message'=>'Error pada data itu']);
}

        if ($dt1[0].'-'.$dt1[1]<'1986-02') {
            $potongan=0;
        }
        else{
            $potongan =$this->loadPeriod(substr($tmtrange[0], 0, 7), $panggkatbin[0]);
        }

        $jml_tabungan = 0;
        $bunga_bulanan = 0;
        $bunga_arr = [];
        $tab_arr = [];
        $pangkat = '';
        $arr_pangkat = [];

        $pangkat_list = [];

        $dt = strtotime($dt1[0].'-'.$dt1[1]);

        $daass=[];
        for ($i=0; $i < $all; $i++) {
            if ($i == 0) {
                $jml_tabungan += $potongan;
            } else {
                $dn = date("Y-m", strtotime("+1 month", $dt));


                switch ($dn) {
            case substr($tmt_1, 0, 7):
                $pangkat = 'tamtama';
                break;
            case substr($tmt_2, 0, 7):
                $pangkat = 'bintara';
                break;
            case substr($tmt_3, 0, 7):
                $pangkat = 'pama';
                break;
            case substr($tmt_4, 0, 7):
                $pangkat = 'pamen';
                break;
            case substr($tmt_5, 0, 7):
                $pangkat = 'pati';
                break;
        }

        if ($dn == "1986-02") {
            $potongan = Potongan::where(['pangkat'=>$panggkatbin[0],'period'=>"1986-02"])->first()->value;

        }
        try {
            if (!is_null($bunga_list[$dn])) {
                $bunga = $bunga_list[$dn];
            }
        } catch (\Throwable $th) {

        }

        if ($dn == "2009-04" || $dn == "2017-01" ) {
            $potongan = $this->loadPeriod($dn, $pangkat);
                    $tab_arr[] = $jml_tabungan - array_sum($bunga_arr) - array_sum($tab_arr);
                } elseif (!in_array($pangkat, $pangkat_list)) {
                    if ($this->loadPeriod($dn, $pangkat) != 0) {
                        $potongan = $this->loadPeriod($dn, $pangkat);
                        $pangkat_list[] = $pangkat;
                        $tab_arr[] = $jml_tabungan - array_sum($bunga_arr) - array_sum($tab_arr);
                    }
                }
                // dump("jumlah tabungan ".$jml_tabungan ."pada tanggal ".$dn." pangkatnya ".$pangkat. " potongannya ".$potongan.'bunganya '.$bunga.' jml_bunga'.array_sum($bunga_arr));

                $bunga_bulanan = number_format(($jml_tabungan * ($bunga) / 12/100), 2, '.', '');
                $jml_tabungan = number_format(($jml_tabungan + ($jml_tabungan * ($bunga) / 12/100) + $potongan), 2, '.', '');
                $bunga_arr[] = (float) $bunga_bulanan;

                $dt = strtotime($dn);
            }
        }


        $hasil =[
            'bulan'=>$all,
            'jumlah'=>$jml_tabungan,
            'bunga'=>array_sum($bunga_arr)
        ];
        // die;
        return $hasil;
    }



    public function exportPensiun()
    {
        return Excel::download(new ExportPensiun, 'pensiun.xlsx');
    }



    public function profilingLengkap()
    {
        return datatables(dtpkk::where(['is_pengajuan'=>FALSE,'is_pensiun'=>TRUE,'is_complate'=>TRUE])->get())
        ->addColumn('check', function ($data) {
            return '<input class="check-profilinglengkap" name="profilinglengkap[]" type="checkbox" value="'.mb_convert_encoding($data['id'], 'UTF-8', 'UTF-8').'">';
        })

        ->addColumn('nama', function ($data) {
             return '<b>'.$data->nama.'</b><p>'.$data->nrp.'</p>';
        })
        ->addColumn('tg_lahir', function ($data) {
            return date('d F Y', strtotime($data['tg_lahir']));
        })
        ->addColumn('tgl_pensiun', function ($data) {
            return date('d F Y', strtotime($data['tgl_pensiun']));
        })
        ->addColumn('action',function ($data){
            return '<td style="text-align:center;" class="pointAction"><center>
            <div class="dropdown">
            <button style=" border: none;
            background: transparent;text-align:right;" class="buttonMore" type="button" id="moreAction2" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="moreAction2">
                <li> <a class="dropdown-item" href="/baltab/editBaltab?NRP='.$data->nrp.'">Edit</a></li>
                <li> <a class="dropdown-item" href="/baltab/datapok?NRP='.$data->nrp.'" >Lihat Profile</a></li>
            </ul>
            </div></center>
            </td>';



        })
        ->rawColumns(['check','nrp_formated','nama','tg_lahir','tgl_pensiun','action'])
        ->addIndexColumn()
        ->make(true);
    }

    public function profilingBiasa()
    {
        $i = 1;
        return datatables(dtpkk::where(['is_pensiun'=>TRUE,'is_complate'=>FALSE])->get())
        // ->addColumn('check', function ($data) {
        //     return '<input class="check-profilingbiasa" name="profilingbiasa[]" type="checkbox" value="'.mb_convert_encoding($data['_id'], 'UTF-8', 'UTF-8').'">';
        // })

        ->addColumn('tg_lahir', function ($data) {
            return date('d F Y', strtotime($data['tg_lahir']));
        })
        ->addColumn('tgl_pensiun', function ($data) {
            return date('d F Y', strtotime($data['tgl_pensiun']));
        })

        ->addColumn('nama', function ($data) {
            return '<b>'.$data->nama.'</b><p>'.$data->nrp.'</p>';
       })
        ->addColumn('action',function ($data){
            return '<td style="text-align:center;" class="pointAction"><center>
            <div class="dropdown">
            <button style=" border: none;
            background: transparent;text-align:right;" class="buttonMore" type="button" id="moreAction2" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="moreAction2">
                <li> <a class="dropdown-item" href="/baltab/editBaltab?NRP='.$data->nrp.'">Edit</a></li>
                <li> <a class="dropdown-item" href="/baltab/datapok?NRP='.$data->nrp.'" >Lihat Profile</a></li>
            </ul>
            </div></center>
            </td>';
        })
        ->rawColumns(['nrp_formated','nama','tg_lahir','tgl_pensiun','action'])
        ->addIndexColumn()
        ->make(true);
    }




    public function exportDataProfiling(Request $request)
    {

        try {
            if ($_GET['type'] == 1) {
                return Excel::download(new DataProfiling(1,$_GET['date']), 'DataLengkap '.Carbon::now()->toDateString().'.xlsx');

            }else {
                return Excel::download(new DataProfiling(0,$_GET['date']), 'DataTidakLengkap '.Carbon::now()->toDateString().'.xlsx');
            }
        } catch (\Throwable $th) {

            if ($_GET['type'] == 1) {
                return Excel::download(new DataProfiling(1),  'DataLengkap '.Carbon::now()->toDateString().'.xlsx');

            }else {
                return Excel::download(new DataProfiling(0), 'DataTidakLengkap '.Carbon::now()->toDateString().'.xlsx');
            }


        }

    }

    public function profilingbulan(Request $request)
    {

        $dt = $request->tahun.'-'.$request->bulan;

        // dd( dtpkk::where(['is_pengajuan'=>FALSE,'is_pensiun'=>TRUE,'is_complate'=>TRUE])->where('tgl_pensiun', 'LIKE' ,'%'.$dt.'%')->get() );
        if ($request->type == 1) {
            if ( dtpkk::where(['is_pengajuan'=>FALSE,'is_pensiun'=>TRUE,'is_complate'=>TRUE])->where('tgl_pensiun', 'LIKE' ,'%'.$dt.'%')->count() > 0) {
                return Excel::download(new DataProfiling(1,$dt),  'DataLengkap '.Carbon::now()->toDateString().'.xlsx');
            }
            else {
                return redirect()->back()->with(['message'=>'data pada bulan itu tidak ditemukan']);
            }


        } else {
            if (dtpkk::where(['is_pensiun'=>TRUE,'is_complate'=>FALSE])->where('tgl_pensiun', 'LIKE' ,'%'.$dt.'%')->count() > 0) {
                return Excel::download(new DataProfiling(0,$dt),  'DataLengkap '.Carbon::now()->toDateString().'.xlsx');
            }
            else {
                return redirect()->back()->with(['message'=>'data pada bulan itu tidak ditemukan']);
            }

        }


    }

    public function makeMessage()
    {
        return view('notification.make');
    }
    public function postMessage(Request $request)
    {
        if ($request->type == "*") {
            DB::table('notify')->insert([
                'nrp'=>'*',
                'pesan'=>$request->pesan,
                'judul'=>$request->judul,
                'kategori'=>'0',

            ]);

            return redirect()->back()->with(['message'=>"sudah di broadcast"]);
        }elseif ($request->type =="nb") {

            $ds = explode(',',$request->nrplist);
            foreach ($ds as $key => $value) {
                if ($key != count($ds) - 1) {
                    DB::table('notify')->insert([
                        'nrp'=>$value,
                        'pesan'=>$request->pesan,
                        'judul'=>$request->judul,
                        'kategori'=>'0',

                    ]);
                }
            }
            return redirect()->back()->with(['message'=>"sudah di kirim"]);
        }


    }


    public function getWho(Request $request)
    {
        $query = $request->get('query');
          $filterResult = DB::connection('login')->table('users')->where('nrp', 'LIKE', '%'. $query. '%')->limit(5)->get();
          return response()->json($filterResult);
    }

}
