<?php

namespace App\Http\Controllers;

use App\Models\datapokok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use PhpParser\Node\Stmt\Echo_;
use App\Models\Pengajuan;
use App\Models\dtpkk;
use Carbon\Carbon;
use Hash;
use App\Models\MasterPangkat;
// use Illuminate\Support\Facades\Auth;
use App\Exports\ExportSprin;
use Excel;
use DataTables;
use App\Models\Datapokokpembayaran;
use Alert;
use App\Imports\ImportVerifPengajuan;

class DatapokokController extends Controller
{
    public function __construct()
    {
        set_time_limit(8000000);
    }
    public function daftarkan2($pasing)
    {
        // dd($pasing);
        if ($pasing == null) {
            echo 'ada kesalahan pastoikan NRP yang Dimasuman Benar';
        } elseif (!$pasing == null) {
            $input = array([
                '_id' => hash("md5", now()),
                'is_pengajuan' => 0,
                'nrp' => $pasing->nrp,
                'notam' => $pasing->notam,
                'nama' => $pasing->name,
                'gelar_dpn' => $pasing->gelar_dpn,
                'gelar_blk' => $pasing->gelar_blk,
                'pangkat' => $pasing->pangkat,
                'tmt_pkt' => $pasing->tmt_pkt,
                'ur_jab_skep' => $pasing->ur_jab_skep,
                'corps' => $pasing->corps,
                'kd_ktm' => $pasing->kd_ktm,
                'kd_smkl' => $pasing->kd_smkl,
                'kesatuan' => $pasing->kesatuan,
                'tmt_1' => $pasing->tmt_1,
                'tmt_2' => $pasing->tmt_2,
                'tmt_3' => $pasing->tmt_3,
                'tmt_4' => $pasing->tmt_4,
                'tmt_5' => $pasing->tmt_5,
                'tmt_abri' => $pasing->tmt_abri,
                'npwp' => $pasing->npwp,
                'tmt_henti' => $pasing->tmt_henti,
                'kode_p_sub' => $pasing->kode_p_sub,
                'kd_bansus' => $pasing->kd_bansus,
                'tg_update' => $pasing->tg_update,
                'tmt_pa' => $pasing->tmt_pa,
                'tg_lahir' => $pasing->tg_lahir,
                'no_bitur' => $pasing->no_bitur,
                'kd_ktg' => $pasing->kd_ktg,
                'tmt_ktg' => $pasing->tmt_ktg,
                'g_pokok' => $pasing->g_pokok,
                't_istri' => $pasing->t_istri,
                't_anak' => $pasing->t_anak,
                'kpr1' => $pasing->kpr1,
                'kpr2' => $pasing->kpr2,
                'kd_stakel' => $pasing->kd_stakel,
                'nm_kel1' => $pasing->nm_kel1,
                'nm_kel2' => $pasing->nm_kel2,
                'nm_kel3' => $pasing->nm_kel3,
                'alamat' => $pasing->alamat,
            ]);
            $das = DB::table('datapokok')->insert($input);
        }
    }
    public function mas($data)
    {
        $data=DB::table('datapokok')->where('nrp', $data)->first();
        $total=0;
        $kosong=0;
        $ada=0;
        $validate=[
                // 'nrp','notam','nama','pangkat','tmt_pkt','corps','kd_ktm','kd_smkl','kesatuan','npwp','kode_p_sub','kd_bansus','tg_update','tmt_pa','tg_lahir','no_bitur','kd_ktg','tmt_ktg','t_istri','t_anak','kd_stakel','alamat'
                'nrp','tg_lahir','norek','narek','nabank'
            ];
        foreach ($data as $key => $value) {
            if (in_array($key, $validate, true)) {
                $total++;
                // dump($value, !($value==null||$value==""||$value=="0000-00-00"));
                if (!($value==null||$value==""||$value=="0000-00-00")) {
                    $ada++;
                } else {
                    $kosong++;
                }
            }
        }
        if ($ada==$total) {
            DB::table('datapokok')->where('nrp', $data->nrp)->update(['is_complate'=>1]);
        } else {
            DB::table('datapokok')->where('nrp', $data->nrp)->update(['is_complate'=>0]);
        }
        // dd($data);
        return $data=[
            'ada'=>$ada,
            'kosong'=>$kosong,
            'kelengkapan'=>$total
        ];
    }
    public function index($pas=22)
    {
        $dt =datapokok::whereNotNull('nrp')->orderBy('nama', 'asc')->paginate(100);
        // return response()->json(['data'=>$dt], 200);

        // pengecekan bahwa user sudah di validasi oleh system jika role bukan 0 maka user di golongkan sebagai user
        if (!Auth::user()->role == 0) {
            // mendapatkan data user pada tabel data pokok
            $data = DB::table('datapokok')->where("nrp", Auth::user()->nrp)->first();
            // dd($data);
            // $pes=$this->mas($data);
            // dd($pes);
            // dump($pes);
            // jika user tidak terdaftar
            if ($data == null) {
                echo 'Anda Belum Terdaftar Di Baltab';
            // $this->daftarkan1();
                // return redirect('/datapok');
            } //jika sudah terdaftar
            else {
                // $data=app('App\Http\Controllers\HaveController')->index(Auth::user()->nrp);
                // dd($data);
                $data->uang=app('App\Http\Controllers\HaveController')->index(Auth::user()->nrp);
                $this->data_user_pasing=$data;
                // if (!empty($_GET['mtb'])) {
                //     return view('A.ajax', ['data' => $this->data_user_pasing]);
                // }
                // $this->data_user_pasing=$data;
                // dd($this->data_user_pasing);
                $pas=$this->mas(Auth::user()->nrp);
                // dd($pas);

                return view('A.user_detail', ['dt'=>$dt,'data' => $this->data_user_pasing,'status'=>$pas]);
            }
            // pengecekan bahwa user sudah di validasi oleh system jika role 0 maka user di golongkan sebagai admin
        } elseif (Auth::user()->role == 0) {
            //jika tidak memiliki parameter get
            if (!empty($_GET['NRP'])) {
                $data =DB::table('datapokok')->where("nrp", $_GET['NRP'])->first();
                // jika tidak ada data yang sama
                // dd($data);
                if ($data==null) {
                    // dd('data tidak terdaftar');
                    return view('A.gagal');
                // die;
                    // mencari data diri user di sisfobeta_iuran_twp tabel user
                    // $data2 = DB::connection('login')->table('users')->where('nrp', $_GET['NRP'])->first();
                    // mendaftarakan user ke tabel data pokok
                    // $this->daftarkan2($data2);
                    // return redirect('/datapok?NRP=' . $_GET['NRP']);
                }
                // jika user terdeteksi sudah terdaftar
                else {
                    $data->uang=app('App\Http\Controllers\HaveController')->index($_GET['NRP']);
                    $this->data_user_pasing=$data;
                    $pas=$this->mas($_GET['NRP']);
                    // dd($pas);
                    if (!empty($_GET['mtb'])) {
                        return view('A.ajax', ['data' => $this->data_user_pasing,'status'=>$pas]);
                    }
                    // dd($data);

                    // dd($this->data_user_pasing);
                    return view('A.user_detail', ['dt'=>$dt,'data' => $this->data_user_pasing,'status'=>$pas]);
                }
            }
            // jika user variabel get kosong
            else {
                return view('A.user_detail', ['dt'=>$dt]);
            }
        }
    }

    private function masn($tgl, $jumlah=1, $format='')
    {
        return date('Y-m', strtotime('+'.$jumlah.' month', strtotime($tgl)));
    }

    public function update(Request $res)
    {
        if (!empty($_POST)) {
            $ajukan=0;
            if (!empty($_GET['ac'])) {
                $ajukan=1;
            }
        // dd(datapokok::where('nrp', $res->nrp)->get());
            DB::table('datapokok')->where('nrp', $res->nrp)->update(
            [
            "notam" => $res->notam,
            "nama" => $res->nama,
            "gelar_dpn" =>    $res->gelar_dpn,
            "gelar_blk" =>    $res->gelar_blk,
            "pangkat" =>  $res->pangkat,
            "tmt_pkt" =>  $res->tmt_pkt,
            "ur_jab_skep" =>  $res->ur_jab_skep,
            "corps" =>    $res->corps,
            "kd_ktm" =>   $res->kd_ktm,
            "kd_smkl" =>  $res->kd_smkl,
            "kesatuan" => $res->kesatuan,
            "tmt_1" =>    $res->tmt_1,
            "tmt_2" =>    $res->tmt_2,
            "tmt_3" =>    $res->tmt_3,
            "tmt_4" =>    $res->tmt_4,
            "tmt_5" =>    $res->tmt_5,
            "tmt_abri" => $res->tmt_abri,
            "npwp" => $res->npwp,
            "tmt_henti" =>    $res->tmt_henti,
            "kode_p_sub" =>   $res->kode_p_sub,
            "kd_bansus" =>    $res->kd_bansus,
            "tg_update" =>    $res->tg_update,
            "tmt_pa" =>   $res->tmt_pa,
            "tg_lahir" => $res->tg_lahir,
            "no_bitur" => $res->no_bitur,
            "kd_ktg" =>   $res->kd_ktg,
            "tmt_ktg" =>  $res->tmt_ktg,
            "g_pokok" =>  $res->g_pokok,
            "t_istri" =>  $res->t_istri,
            "t_anak" =>   $res->t_anak,
            "kpr1" => $res->kpr1,
            "kpr2" => $res->kpr2,
            "kd_stakel" =>    $res->kd_stakel,
            "nm_kel1" =>  $res->nm_kel1,
            "nm_kel2" =>  $res->nm_kel2,
            "nm_kel3" =>  $res->nm_kel3,
            "alamat" =>   $res->alamat,
            "norek" =>  $res->norek,
            "narek" =>  $res->narek,
            "nabank" =>  $res->nabank,
            'is_pengajuan'=>$ajukan
            ]
            );
            // dd(Pengajuan::where('nrp', $res->nrp)->get());
            if (!empty($_GET['ac'])) {
                // dd('here');
                Pengajuan::create(
                    [
                    "is_verif"=>0,
                    "nrp"=>$res->nrp,
                    //   "is_pengajuan"=>0,
                    "notam" => $res->notam,
                    "nama" => $res->nama,
                    "gelar_dpn" =>    $res->gelar_dpn,
                    "gelar_blk" =>    $res->gelar_blk,
                    "pangkat" =>  $res->pangkat,
                    "tmt_pkt" =>  $res->tmt_pkt,
                    "ur_jab_skep" =>  $res->ur_jab_skep,
                    "corps" =>    $res->corps,
                    "kd_ktm" =>   $res->kd_ktm,
                    "kd_smkl" =>  $res->kd_smkl,
                    "kesatuan" => $res->kesatuan,
                    "tmt_1" =>    $res->tmt_1,
                    "tmt_2" =>    $res->tmt_2,
                    "tmt_3" =>    $res->tmt_3,
                    "tmt_4" =>    $res->tmt_4,
                    "tmt_5" =>    $res->tmt_5,
                    "tmt_abri" => $res->tmt_abri,
                    "npwp" => $res->npwp,
                    "tmt_henti" =>    $res->tmt_henti,
                    "kode_p_sub" =>   $res->kode_p_sub,
                    "kd_bansus" =>    $res->kd_bansus,
                    "tg_update" =>    $res->tg_update,
                    "tmt_pa" =>   $res->tmt_pa,
                    "tg_lahir" => $res->tg_lahir,
                    "no_bitur" => $res->no_bitur,
                    "kd_ktg" =>   $res->kd_ktg,
                    "tmt_ktg" =>  $res->tmt_ktg,
                    "g_pokok" =>  $res->g_pokok,
                    "t_istri" =>  $res->t_istri,
                    "t_anak" =>   $res->t_anak,
                    "kpr1" => $res->kpr1,
                    "kpr2" => $res->kpr2,
                    "kd_stakel" =>    $res->kd_stakel,
                    "nm_kel1" =>  $res->nm_kel1,
                    "nm_kel2" =>  $res->nm_kel2,
                    "nm_kel3" =>  $res->nm_kel3,
                    "alamat" =>   $res->alamat,
                    //   "norek" =>  $res->norek,
                    //   "narek" =>  $res->narek,
                    //   "nabank" =>  $res->nabank,
                    ]
                );
                return redirect('/pengajuan');
            }
            return redirect('/datapok?NRP=' . $_POST['nrp']);
        } else {
            if (!Auth::user()->role == 0) {
                $data = DB::table('datapokok')->where("nrp", Auth::user()->nrp)->first();
                // dd($data);
                return view('A.admin_edit_user', ['data' => $data]);
            } elseif (Auth::user()->role == 0) {
                // dd($_GET['NRP']);
                if (empty($_GET['NRP'])) {
                    return view('A.detail_user_update');
                } else {
                    $data = DB::table('datapokok')->where("nrp", $_GET['NRP'])->first();
                    return view('A.admin_edit_user', ['data' => $data]);
                }
            }
        }
    }

    public function ajukan(Request $request)
    {
        // unset($_POST['_token']);
        $pasing = $request;
        // dd($pasing->role);
        $input = array([
            'nrp' => $pasing->nrp,
            'notam' => $pasing->notam,
            'nama' => $pasing->name,
            'gelar_dpn' => $pasing->gelar_dpn,
            'gelar_blk' => $pasing->gelar_blk,
            'pangkat' => $pasing->pangkat,
            'tmt_pkt' => $pasing->tmt_pkt,
            'ur_jab_skep' => $pasing->ur_jab_skep,
            'corps' => $pasing->corps,
            'kd_ktm' => $pasing->kd_ktm,
            'kd_smkl' => $pasing->kd_smkl,
            'kesatuan' => $pasing->kesatuan,
            'tmt_1' => $pasing->tmt_1,
            'tmt_2' => $pasing->tmt_2,
            'tmt_3' => $pasing->tmt_3,
            'tmt_4' => $pasing->tmt_4,
            'tmt_5' => $pasing->tmt_5,
            'tmt_abri' => $pasing->tmt_abri,
            'npwp' => $pasing->npwp,
            'tmt_henti' => $pasing->tmt_henti,
            'kode_p_sub' => $pasing->kode_p_sub,
            'kd_bansus' => $pasing->kd_bansus,
            'tg_update' => $pasing->tg_update,
            'tmt_pa' => $pasing->tmt_pa,
            'tg_lahir' => $pasing->tg_lahir,
            'no_bitur' => $pasing->no_bitur,
            'kd_ktg' => $pasing->kd_ktg,
            'tmt_ktg' => $pasing->tmt_ktg,
            'g_pokok' => $pasing->g_pokok,
            't_istri' => $pasing->t_istri,
            't_anak' => $pasing->t_anak,
            'kpr1' => $pasing->kpr1,
            'kpr2' => $pasing->kpr2,
            'kd_stakel' => $pasing->kd_stakel,
            'nm_kel1' => $pasing->nm_kel1,
            'nm_kel2' => $pasing->nm_kel2,
            'nm_kel3' => $pasing->nm_kel3,
            'alamat' => $pasing->alamat,
            'datapokok_id' => $pasing->id,
            'is_sprin' => null,
            'no_sprin' => null,
            'selesai' => null,
            'no_urut' => null,
        ]);
        // dd($input);
        $das = DB::table('pengajuans')->insert($input);
        // dd($das);
    }
    public function daftarkan1()
    {
        dd($_POST);
        $input = array([
            'nrp' => Auth::user()->nrp,
            'notam' => Auth::user()->notam,
            'nama' => Auth::user()->nama,
            'gelar_dpn' => Auth::user()->gelar_dpn,
            'gelar_blk' => Auth::user()->gelar_blk,
            'pangkat' => Auth::user()->pangkat,
            'tmt_pkt' => Auth::user()->tmt_pkt,
            'ur_jab_skep' => Auth::user()->ur_jab_skep,
            'corps' => Auth::user()->corps,
            'kd_ktm' => Auth::user()->kd_ktm,
            'kd_smkl' => Auth::user()->kd_smkl,
            'kesatuan' => Auth::user()->kesatuan,
            'tmt_1' => Auth::user()->tmt_abri, //perubahan1
            'tmt_2' => Auth::user()->tmt_2,
            'tmt_3' => Auth::user()->tmt_3,
            'tmt_4' => Auth::user()->tmt_4,
            'tmt_5' => Auth::user()->tmt_5,
            'tmt_abri' => Auth::user()->tmt_abri,
            'npwp' => Auth::user()->npwp,
            'tmt_henti' => Auth::user()->tmt_henti,
            'kode_p_sub' => Auth::user()->kode_p_sub,
            'kd_bansus' => Auth::user()->kd_bansus,
            'tg_update' => Auth::user()->tg_update,
            'tmt_pa' => Auth::user()->tmt_pa,
            'tg_lahir' => Auth::user()->tg_lahir,
            'no_bitur' => Auth::user()->no_bitur,
            'kd_ktg' => Auth::user()->kd_ktg,
            'tmt_ktg' => Auth::user()->tmt_ktg,
            'g_pokok' => Auth::user()->g_pokok,
            't_istri' => Auth::user()->t_istri,
            't_anak' => Auth::user()->t_anak,
            'kpr1' => Auth::user()->kpr1,
            'kpr2' => Auth::user()->kpr2,
            'kd_stakel' => Auth::user()->kd_stakel,
            'nm_kel1' => Auth::user()->nm_kel1,
            'nm_kel2' => Auth::user()->nm_kel2,
            'nm_kel3' => Auth::user()->nm_kel3,
            'alamat' => Auth::user()->alamat,
            'created_at' => Auth::user()->created_at,
            'updated_at' => Auth::user()->updated_at,
        ]);
        // dd($input);
        $das = DB::table('datapokok')->insert($input);
    }



    public function dataPokokTabel(Request $request)
    {

        // return DataTables::queryBuilder(DB::table('datapokok')->where('tg_lahir','!=',NULL)->limit(100000)->get());



$query = DB::table('datapokok')->whereNotNull('tg_lahir')->whereNotNull('nrp');
return DataTables::queryBuilder($query)
->editColumn('tg_lahir' ,function ($data){
    return date('d F Y', strtotime($data->tg_lahir));
})

->addColumn('uraian_nama', function ($data) {
    return '<b>'.$data->nama.'</b><p>'.$data->nrp.'</p>';
})
->addColumn('pangkat_uraian', function ($data) {
    if (is_null($data->pangkat)) {
                return "Null";
    } else {
                try {
                    return DB::connection('login')->table('data_master_pangkat')->where('kode', $data->pangkat)->first()->uraian;
                } catch (\Throwable $th) {
                    return '<i style="color:red;font-weight:italic;">Null</i>';
                }
            }
        })
        ->addColumn('kesatuan_uraian', function ($data) {
            if (is_null($data->kesatuan)) {
                return "Null";
            } else {
                try {
                    return DB::connection('login')->table('data_master_kesatuan')->where('kosat', $data->kesatuan)->first()->namsat;
                } catch (\Throwable $th) {
                    return '<i style="color:red;font-weight:italic;">Null</i>';
                }
            }
        })
        ->addColumn('corp_uraian', function ($data) {
            if (is_null($data->corps)) {
                return "Null";
            } else {
                try {
                    return DB::connection('login')->table('data_master_corp')->where('kode', $data->corps)->first()->uraian;
                } catch (\Throwable $th) {
                    return '<i style="color:red;font-weight:italic;">Null</i>';
                }
            }
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



})->rawColumns(['uraian_nama','action','pangkat_uraian','corp_uraian','kesatuan_uraian'])->addIndexColumn()->toJson();

// '<a href="/baltab/datapok?NRP='.$data->nrp.'" >'.$data->nama.'</a>'

        // dd( datapokok::whereNotNull('nrp')
        // ->whereNotNull('tmt_henti')

        // ->whereNotNull('nama')
        // ->whereNotNull('tg_lahir')
        // ->orderBy('nama', 'asc')->get()->count());

        // return datatables(
        //     datapokok::whereNotNull('nrp')
        // ->whereNotNull('tmt_henti')
        // ->whereNotNull('tmt_pa')
        // // ->whereNotNull('tmt_pa')
        // ->whereNotNull('tg_lahir')
        // ->orderBy('nama', 'asc')->limit(100)->get()
        // )

        // ->addColumn('nrp_formated', function ($data) {
        //     return $data['nrp'];
        // })
        // ->addColumn('nama', function ($data) {
        //     return '<a href="/baltab/datapok?NRP='.$data->nrp.'" >'.$data->nama.'</a>';
        // })

        // // ->addColumn('pangkat_uraian', function ($data) {
        // //     if (is_null($data->pangkat)) {
        // //         return "Null";
        // //     } else {
        // //         try {
        // //             return DB::connection('login')->table('data_master_pangkat')->where('kode', $data->pangkat)->first()->uraian;
        // //         } catch (\Throwable $th) {
        // //             return "tidak ada data ini di tabel master";
        // //         }
        // //     }
        // // })
        // // ->addColumn('kesatuan_uraian', function ($data) {
        // //     if (is_null($data->kesatuan)) {
        // //         return "Null";
        // //     } else {
        // //         try {
        // //             return DB::connection('login')->table('data_master_kesatuan')->where('kosat', $data->kesatuan)->first()->namsat;
        // //         } catch (\Throwable $th) {
        // //             return "tidak ada data ini di tabel master";
        // //         }
        // //     }
        // // })
        // // ->addColumn('corp_uraian', function ($data) {
        // //     if (is_null($data->corps)) {
        // //         return "Null";
        // //     } else {
        // //         try {
        // //             return DB::connection('login')->table('data_master_corp')->where('kode', $data->corps)->first()->uraian;
        // //         } catch (\Throwable $th) {
        // //             return "tidak ada data ini di tabel master";
        // //         }
        // //     }
        // // })
        // ->addColumn('pengangkatan', function ($data) {
        //     return $data->tmt_pa;
        // })
        // ->addColumn('tg_lahir', function ($data) {
        //     return  date('d F Y', strtotime($data->tg_lahir));
        // })
        // ->addColumn('action', function ($data) {
        //     return '<td>
        //     <div class="action">
        //     <a href="/baltab/editBaltab?NRP='.$data->nrp.'"><img src="../assets/img/editIcon.svg" alt=""></a>

        //     </div>
        //     </td>';
        // })


        // ->rawColumns(['nrp_formated','nama','pengangkatan','tg_lahir','action'])
        // ->addIndexColumn()
        // ->make(true);
    }


    // Start TABLE (KIGA)





    public function pengajuan(Request $request)
    {

        $banyak = Datapokokpembayaran::where('status',2)->get()->count();
        $jumlah = 0;

        foreach (Datapokokpembayaran::where('status',2)->get() as $key => $value) {

            $jumlah += floatval(str_replace(',', '.', str_replace('.', '', $value->jumlah)));

        }



        return view('pengajuan.index',['banyak'=>$banyak,'jumlah'=>$jumlah]);
    }

    public function dataPengajuan(Request $request)
    {
        // return datatables(Pengajuan::where('is_sprin', null)->orWhere('is_sprin', false)->get())
        // ->addColumn('check', function ($data) {
        //     return '<input class="check-pengajuan" name="pengajuan[]" type="checkbox" value="'.$data['nrp'].'">';
        // })
        // ->addColumn('nrp_formated', function ($data) {
        //     // if (!empty($data['tmt_abri']) && $data['tmt_abri'] != '000000' && $data['kpr1'] != 'S') {
        //     return $data['nrp'];
        //     // }
        // })
        // ->addColumn('nama', function ($data) {
        //     // if (!empty($data['tmt_abri']) && $data['tmt_abri'] != '000000' && $data['kpr1'] != 'S') {
        //         return '<a style="text-decoration:none;color:blue;" href="/baltab/datapok?NRP='.$data->nrp.'" >'.$data->nama.'</a>';
        //     // }
        // })
        // ->addColumn('pangkat_uraian', function ($data) {
        //     if (is_null($data->pangkat)) {
        //         return "Null";
        //     } else {
        //         try {
        //             return MasterPangkat::where('kode', $data->pangkat)->first()->uraian;
        //         } catch (\Throwable $th) {
        //             return "null";
        //         }
        //     }
        // })
        // ->addColumn('kesatuan_uraian', function ($data) {
        //     if (is_null($data->kesatuan)) {
        //         return "Null";
        //     } else {
        //         try {
        //             return DB::connection('login')->table('data_master_kesatuan')->where('kosat', $data->kesatuan)->first()->namsat;
        //         } catch (\Throwable $th) {
        //             return "tidak ada data ini di tabel master";
        //         }
        //     }
        // })
        // // ->addColumn('corp_uraian', function ($data) {
        // //     if (is_null($data->corps)) {
        // //         return "Null";
        // //     }
        // //     // else {
        // //     //     try {
        // //     //         return DB::connection('login')->table('data_master_corp')->where('kode', $data->corps)->first()->uraian;
        // //     //     } catch (\Throwable $th) {
        // //     //         return "tidak ada data ini di tabel master";
        // //     //     }
        // //     // }
        // // })
        // // ->addColumn('pengangkatan', function ($data) {
        // //     return $data->pengangkatan;
        // // })
        // ->addColumn('tg_lahir', function ($data) {
        //     return date('d F Y', strtotime($data->tg_lahir));
        // })
        // ->addColumn('action', function ($data) {
        //     return '<td><div class="action"><a href="/baltab/editBaltab?NRP='.$data->nrp.'"><img src="../assets/img/editIcon.svg" alt=""></a></div></td>';
        // })


        // ->rawColumns(['check','nama','pangkat_uraian','kesatuan_uraian','tg_lahir','action'])
        // ->addIndexColumn()
        // ->make(true);







        return datatables(Datapokokpembayaran::where('status',2)->get())
        ->addColumn('check', function ($data) {
            return '<input class="check-pengajuan" name="pengajuan[]" type="checkbox" value="'.dtpkk::where('_id',$data['datapokok_id'])->first()->nrp.'">';
        })
        ->addColumn('nama', function ($data) {
                return '<b>'.$data->atas_nama.'</b><p>'.dtpkk::where('_id',$data->datapokok_id)->first()->nrp.'</p>';
        })
        ->addColumn('nabank', function ($data) {
            return '<b>'.$data->nama_bank.'</b><p>'.$data->no_rekening.'</p>';
        })
    ->addColumn('jumlah_tabungan', function ($data) {
            return "Rp.".$data->jumlah;

        })
    ->addColumn('status', function ($data) {
            return "Dalam pengajuan";
        })

        ->rawColumns(['check','nama','nabank'])->addIndexColumn()->make(true);



















    }

    public function cekSprin(Request $request)
    {


        $jml_pembayaran = Datapokokpembayaran::where('status',3)->get()->count();
        $jumlah_pembayaran = 0;
        foreach (Datapokokpembayaran::where('status',3)->get() as $key => $value) {
            $jumlah_pembayaran += floatval(str_replace(',', '.', str_replace('.', '', $value->jumlah)));
        }

        $jml_pencairan = Datapokokpembayaran::where('status',4)->get()->count();
        $jumlah_pencairan = 0;
        foreach (Datapokokpembayaran::where('status',4)->get() as $key => $value) {
            $jumlah_pencairan += floatval(str_replace(',', '.', str_replace('.', '', $value->jumlah)));
        }



        // dd(Pengajuan::where('is_sprin', true)->whereNotNull('no_sprin')->get());
        return view('sprin.index',['jml_pembayaran'=>$jml_pembayaran,'jumlah_pembayaran'=>$jumlah_pembayaran,'jml_pencairan'=>$jml_pencairan,'jumlah_pencairan'=>$jumlah_pencairan]);
    }



    // 3910256321270
    public function importPengajuan(Request $request)
    {
        $file = $request->file('file');


        $import = new ImportVerifPengajuan();
        $import->import($file);
        foreach ($import->failures() as $failure) {
            dump("row ". $failure->row()." have error with error is ".$failure->errors()[0]);
        }
    }

    public function deletePengajuan(Request $request)
    {

        foreach ($request->pengajuan_ids as $key => $value) {

            Pengajuan::where('nrp', $value)->delete();
        }

        return response()->json(['message'=>'beres didelete'], 200);
    }


    public function seePembayaran(Request $request)
    {
    //     return datatables(Pengajuan::where('is_sprin', true)->whereNotNull('no_sprin')->get())
    //     ->addColumn('check', function ($data) {
    //         return '<input class="check-pembayaran" name="pembayaran[]" type="checkbox" value="'.mb_convert_encoding($data['_id'], 'UTF-8', 'UTF-8').'">';
    //     })
    //     ->addColumn('no_sprin', function ($data) {
    //         return $data->no_sprin;
    //     })
    //     ->addColumn('nrp_formated', function ($data) {
    //         // if (!empty($data['tmt_abri']) && $data['tmt_abri'] != '000000' && $data['kpr1'] != 'S') {
    //         return $data['nrp'];
    //         // }
    //     })
    //     ->addColumn('narek', function ($data) {
    //         try {
    //             $narek  = Datapokokpembayaran::where('datapokok_id',dtpkk::where('nrp', $data->nrp)->first()->_id)->first()->atas_nama;
    //             if (is_null($narek)) {
    //                 return '<i style="color:red;font-weight:italic;">Null</i>';
    //             } else {
    //                 return $narek;
    //             }
    //         } catch (\Throwable $th) {
    //             return '<i style="font-weight:italic;color:red;">Null</i>';
    //         }

    //     })
    //     ->addColumn('nabank', function ($data) {
    //         try {

    //             $nabank  = Datapokokpembayaran::where('datapokok_id',dtpkk::where('nrp', $data->nrp)->first()->_id)->first()->nama_bank;
    //             if (is_null($nabank)) {
    //                 return '<i style="color:red;font-weight:italic;">Null</i>';
    //             } else {
    //                 return $nabank;
    //             }
    //         } catch (\Throwable $th) {
    //             return '<i style="color:red;font-weight:italic;">Null</i>';
    //         }
    //     })
    // ->addColumn('norek', function ($data) {
    //     try {

    //         $norek  = Datapokokpembayaran::where('datapokok_id',dtpkk::where('nrp', $data->nrp)->first()->_id)->first()->no_rekening;
    //         if (is_null($norek)) {
    //             return '<i style="color:red;font-weight:italic;">Null</i>';
    //         } else {
    //             return $norek;
    //         }
    //     } catch (\Throwable $th) {
    //         return '<i style="color:red;font-weight:italic;">Null</i>';
    //     }
    // })->addColumn('jumlah_tabungan', function ($data) {
    //         try {
    //             $jml = Datapokokpembayaran::where('datapokok_id',dtpkk::where('nrp', $data->nrp)->first()->_id)->first()->jumlah;
    //             if ($jml) {
    //                 return "Rp. ".$jml;
    //             } else {
    //                 return '<i style="color:red;font-weight:italic;">Null</i>';
    //             }


    //         } catch (\Throwable $th) {
    //             return '<i style="color:red;font-weight:italic;">Null</i>';
    //         }
    //     })
    //     ->addColumn('nama', function ($data) {
    //         // if (!empty($data['tmt_abri']) && $data['tmt_abri'] != '000000' && $data['kpr1'] != 'S') {
    //             return '<a style="text-decoration:none;color:blue;" href="/baltab/datapok?NRP='.$data->nrp.'" >'.$data->nama.'</a>';
    //         // }
    //     })
    //     ->addColumn('status', function ($data) {
    //         return "Proses Pencairan";
    //     })
    //     ->rawColumns(['check','no_sprin','nama','jumlah_tabungan','status','narek','nabank','norek'])
    //     ->addIndexColumn()
    //     ->make(true);

    // $query = DB::table('datapokok_pembayaran')->where('status',3);
    // return DataTables::queryBuilder($query)
    // ->addColumn('no_sprin', function ($data) {

    //     try {
    //         return Pengajuan::where('nrp',dtpkk::where('_id',$data->datapokok_id)->first()->nrp)->first()->no_sprin;

    //     } catch (\Throwable $th) {
    //         return '<i style="color:red;font-weight:italic;">Null</i>';
    //     }
    // })
    // ->addColumn('jumlah_tabungan' ,function ($data){
    //    return $data->jumlah;
    // })
    // ->addColumn('narek' ,function ($data){
    //     return $data->atas_nama;
    //  })
    //  ->addColumn('nabank' ,function ($data){
    //     return $data->nama_bank;
    //  })
    //  ->addColumn('norek' ,function ($data){
    //     return $data->no_rekening;
    //  }) ->addColumn('status', function ($data) {
    //     return "Proses pencairan";
    // })->rawColumns(['no_sprin'])->addIndexColumn()->make(true);




    $query = DB::table('datapokok_pembayaran')->where('status',3);
    return DataTables::queryBuilder($query)
    ->addColumn('no_sprin', function ($data) {

        try {
        return Pengajuan::where('nrp',dtpkk::where('_id',$data->datapokok_id)->first()->nrp)->first()->no_sprin;
                } catch (\Throwable $th) {
                    return '<i style="color:red;font-weight:italic;">Null</i>';
                }


})

->addColumn('nama', function ($data) {
    return '<b>'.$data->atas_nama.'</b><p>'.dtpkk::where('_id',$data->datapokok_id)->first()->nrp.'</p>';
})
->addColumn('namabank', function ($data) {
    return '<b>'.$data->nama_bank.'</b><p>'.$data->no_rekening.'</p>';
})
->addColumn('jumlah_tabungan', function ($data) {
    return "Rp.".$data->jumlah;

})
->addColumn('status', function ($data) {

        return "Proses Pencairan";


})->rawColumns(['no_sprin','nama','namabank'])->addIndexColumn()->toJson();






    }






    public function seeBeres(Request $request)
    {

    //     return datatables(Datapokokpembayaran::where('status',4)->get())

    //     ->addColumn('no_sprin', function ($data) {

    //         try {
    //             return Pengajuan::where('nrp',dtpkk::where('_id',$data->datapokok_id)->first()->nrp)->first()->no_sprin;

    //         } catch (\Throwable $th) {
    //             return '<i style="color:red;font-weight:italic;">Null</i>';
    //         }
    //     })

    //     ->addColumn('narek', function ($data) {

    //             return $data->atas_nama;


    //     })
    //     ->addColumn('nabank', function ($data) {

    //         return $data->nama_bank;
    //     })
    // ->addColumn('norek', function ($data) {

    //     return $data->no_rekening;

    // })
    // // dtpkk::where('_id',$data->datapokok_id)->first()->nrp
    //     ->addColumn('jumlah_tabungan', function ($data) {
    //         return $data->jumlah;

    //     })
    //     ->addColumn('status', function ($data) {
    //         return "Sudah dicairkan";
    //     })

    //     ->rawColumns(['no_sprin','jumlah_tabungan','status','narek','nabank','norek'])->addIndexColumn()->make(true);


    $query = DB::table('datapokok_pembayaran')->where('status',4);
    return DataTables::queryBuilder($query)
    ->addColumn('no_sprin', function ($data) {

        try {
                    return Pengajuan::where('nrp',dtpkk::where('_id',$data->datapokok_id)->first()->nrp)->first()->no_sprin;

                } catch (\Throwable $th) {
                    return '<i style="color:red;font-weight:italic;">Null</i>';
                }


})
->addColumn('jumlah_tabungan', function ($data) {
    return "Rp.".$data->jumlah;

})
->addColumn('nama', function ($data) {
    try {
        return '<b>'.$data->atas_nama.'</b><p>'.dtpkk::where('_id',$data->datapokok_id)->first()->nrp.'</p>';
    } catch (\Throwable $th) {
        return $data->atas_nama;
    }
})
->addColumn('namabank', function ($data) {
    return '<b>'.$data->nama_bank.'</b><p>'.$data->no_rekening.'</p>';
})
->addColumn('status', function ($data) {

        return "Sudah dicairkan";


})->rawColumns(['no_sprin','nama','namabank'])->addIndexColumn()->toJson();





    }

    public function seeDetailSprin($param)
    {
        return datatables(Pengajuan::where(['is_sprin'=>true,'no_sprin'=>$param])->get())
        ->addColumn('check', function ($data) {
            return '<input class="check-pengajuan" name="pengajuan[]" type="checkbox" value="'.mb_convert_encoding($data['_id'], 'UTF-8', 'UTF-8').'">';
        })
        ->addColumn('no_sprin', function ($data) {
            return $data->no_sprin;
        })
        ->addColumn('nrp_formated', function ($data) {
            if (!empty($data['tmt_abri']) && $data['tmt_abri'] != '000000' && $data['kpr1'] != 'S') {
                return $data['nrp'];
            }
        })
        ->addColumn('pangkat_uraian', function ($data) {
            if (is_null($data->pangkat)) {
                return '<i style="color:red;font-weight:italic;">Null</i>';
            } else {
                try {
                    return DB::connection('login')->table('data_master_pangkat')->where('kode', $data->pangkat)->first()->uraian;
                } catch (\Throwable $th) {
                    return "tidak ada data ini di tabel master";
                }
            }
        })
        ->addColumn('corp_uraian', function ($data) {
            if (is_null($data->corps)) {
                return '<i style="color:red;font-weight:italic;">Null</i>';
            } else {
                try {
                    return DB::connection('login')->table('data_master_corp')->where('kode', $data->corps)->first()->uraian;
                } catch (\Throwable $th) {
                    return "tidak ada data ini di tabel master";
                }
            }
        })
        ->addColumn('kesatuan_uraian', function ($data) {
            if (is_null($data->kesatuan)) {
                return '<i style="color:red;font-weight:italic;">Null</i>';
            } else {
                try {
                    return DB::connection('login')->table('data_master_kesatuan')->where('kosat', $data->kesatuan)->first()->namsat;
                } catch (\Throwable $th) {
                    return "tidak ada data ini di tabel master";
                }
            }
        })
        ->rawColumns(['no_sprin','pangkat_uraian','corp_uraian','kesatuan_uraian'])

        ->make(true);
    }

    // end table (KIGA)

    public function editBaltab()
    {
        if (!Auth::user()->role == 0) {
            $user = datapokok::where('nrp', Auth::user()->nrp)->first();
            return view('edit.editDataBaltab', ['user'=>$user]);
        } else {
            if (!empty($_GET['ac'])) {
                $user = datapokok::where('nrp', $_GET['NRP'])->first();
                return view('edit.Ajukan', ['user'=>$user]);
            } else {
                $user = datapokok::where('nrp', $_GET['NRP'])->first();
                return view('edit.editDataBaltab', ['user'=>$user]);
            }
        }
    }


    public function addPengajuan(Request $request)
    {
        foreach ($request->pengajuan_ids as $key => $value) {


            $data = dtpkk::where('id', $value)->first();
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



        }

        return response()->json(['message'=>'berhasil menambah pengajuan'], 200);
    }



    public function addSprin(Request $request)
    {
        foreach ($request->pengajuan_ids as $key => $value) {
            Pengajuan::where('_id', $request->pengajuan_ids)->update([
                'is_sprin'=>true,
                'nosprin'=>$request->nosprin
            ]);
        }

        return response()->json(['message'=>'berhasil'], 200);
    }

    public function addNoSprin(Request $request)
    {
        $err = [];
        $succ  = [];

        foreach ($request->pengajuan_ids as $value) {
            try {
                $dapok = dtpkk::where('nrp', $value)->first();
                $dtp = Datapokokpembayaran::where('datapokok_id',$dapok->_id);
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
            } catch (\Throwable $th) {
                $err[] = 'error di pengajuan NRP '.$value;
            }
        }




        return response()->json(['err'=>$err,'succ'=>$succ], 200);
    }

    public function downloadSprin()
    {
        $data = Pengajuan::where('is_sprin', true)->get();

        return Excel::download(new ExportSprin, 'sprin.xlsx');
    }
}




// else {
            //     // credintian
            //     $user=$data;
            //     $potongan=[];
            //     $bulan=[];
            //     $totalbulan=[];
            //     $replace=[];
            //     $bungas=[];
            //     $panggkatbin=[];
            //     $total=[];
            //     $totalbunga=[];
            //     $ig=0;

            //     //reduce
            //     $tmtrange=[$user->tmt_1,$user->tmt_2,$user->tmt_3,$user->tmt_4,$user->tmt_5,$user->tmt_henti];
            //     $pangkat=['tamtama','bintara','pama', 'pamen','pati','henti'];

            //     foreach ($tmtrange as $key=>$dam) {
            //         if (empty($dam)) {
            //             unset($tmtrange[$key]);
            //         } else {
            //             $panggkatbin[$key]=$pangkat[$key];
            //         }
            //     }
            //     // dd($panggkatbin);
            //     $tmtrange=array_values($tmtrange);
            //     $panggkatbin=array_values($panggkatbin);
            //     // dd($tmtrange,$panggkatbin);
            //     foreach ($tmtrange as $key=>$dam) {
            //         if ($dam==end($tmtrange)) {
            //         } else {
            //             $diff = date_diff(date_create($dam), date_create($tmtrange[$key+1]));
            //             $bulan[$key]=floor($diff->days/30);
            //             $totalbulan[$key]['total']=floor($diff->days/30);
            //             $totalbulan[$key]['awal']=$dam;
            //             $totalbulan[$key]['akhir']=$tmtrange[$key+1];
            //         }
            //     }
            //     foreach ($bulan as $key => $value) {
            //         // dump($value);
            //         // dump($tmtrange[$key+1]);
            //         for ($i=0; $i < $value ; $i++) {
            //             $das=$this->masn($tmtrange[$key], $i, 'mount');
            //             // dd($i,$key);
            //             //potongan
            //             if ($das<=$tmtrange[$key+1]) {
            //                 $replace[$key][$i]=DB::table('potongans')
            //                                             ->where('period', '<=', $das)
            //                                             ->where('pangkat', '*')
            //                                             ->orderBy('period', 'desc')->first();
            //                 if (empty($replace[$key][$i])) {
            //                     $replace[$key][$i]=DB::table('potongans')
            //                                             ->where('period', '<=', $das)
            //                                             ->where('pangkat', $panggkatbin[$key])
            //                                             ->orderBy('period', 'desc')->first();
            //                 }
            //                 if (empty($replace[$key][$i])) {
            //                     $replace[$key][$i]=DB::table('potongans')
            //                                             // ->where('period','<=',$das)
            //                                             ->where('pangkat', $panggkatbin[$key])
            //                                             ->orderBy('period', 'asc')->first();
            //                 }
            //                 //bunga
            //                 $bungas[$key][$i]=DB::table('bungas')
            //                                             ->where('period', '<=', $das)
            //                                             // ->where('pangkat','*')
            //                                             ->orderBy('period', 'desc')->first();
            //                 if (empty($bungas[$key][$i])) {
            //                     $bungas[$key][$i]=DB::table('bungas')
            //                                             ->where('period', '<=', $das)
            //                                             // ->where('pangkat',$panggkatbin[$key])
            //                                             ->orderBy('period', 'desc')->first();
            //                 }
            //                 if (empty($bungas[$key][$i])) {
            //                     $bungas[$key][$i]=DB::table('bungas')
            //                                             ->where('period', '<=', $das)
            //                                             // ->where('pangkat',$panggkatbin[$key])
            //                                             ->orderBy('period', 'asc')->first();
            //                 }



            //                 $replace[$key][$i]=$replace[$key][$i]->value;
            //                 $totalbulan[$key]['potongan']=$replace[$key][$i];
            //                 $bungas[$key][$i]=($replace[$key][$i]*$bungas[$key][$i]->value)/100;
            //             }
            //         }
            //     }
            //     // dd($bungas);
            //     foreach ($replace as $key => $value) {
            //         foreach ($value as $key2 => $value2) {
            //             if ($key2==0) {
            //                 $total[$key]=0;
            //                 $totalbunga[$key]=0;
            //             }
            //             // dd($key);
            //             $total[$key]=$total[$key]+$value2;
            //             $totalbunga[$key]=$totalbunga[$key]+$bungas[$key][$key2];
            //             // dd($bungas[$key][$key2]);
            //         }
            //     }

            //     foreach ($total as $key => $value) {
            //         $ig=$ig+$value+$totalbunga[$key];
            //     }
            //     // dump($total);
            //     // dump($totalbunga);
            //     $finbunga=0;
            //     $finuang=0;
            //     foreach ($totalbunga as $key => $value) {
            //         $finbunga=$finbunga+$value;
            //     }
            //     foreach ($total as $key => $value) {
            //         $finuang=$finuang+$value;
            //     }
            //     foreach ($totalbulan as $key => $value) {
            //         $totalbulan[$key]['pangkat']=$panggkatbin[$key];
            //         $totalbulan[$key]['total_uang_bulanan']=$total[$key];
            //     }
            //     // dump($totalbulan);
            //     // dump($panggkatbin);


            //     $data=$user;
            //     $data->rekap_uang=$totalbulan;
            //     $data->data_uang=$finuang+$finbunga;
            //     $data->data_bunga=$finbunga;
            //     // $data->kelengkapan=$pes;
            //     $this->data_user_pasing=$data;
            //     // user biasa
            //     // dump($this->data_user_pasing);
            //     return view('A.user_detail', ['data' => $this->data_user_pasing, 'status'=>$pes]);
            // }
