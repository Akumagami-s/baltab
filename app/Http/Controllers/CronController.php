<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\dtpkk;
use Carbon\Carbon;

class CronController extends Controller
{
    public function profiling()
    {
        // set_time_limit(1800);
        // ini_set('MAX_EXECUTION_TIME', '-1');
        $time_start = microtime(true);
        $divide = 0;
        $count = DB::table('datapokok')->where(['is_pengajuan'=> 0,'is_pensiun'=>FALSE])->whereNotNull('tgl_pensiun')->count();

        for ($i=0; $i < intval($count/5000); $i++) {
            $dt = DB::table('datapokok')->where(['is_pengajuan'=> 0,'is_pensiun'=>FALSE])->whereNotNull('tgl_pensiun')->skip($divide)->limit(5000)->get();

            foreach ($dt as $key => $value) {
                if (!is_null($value->tg_lahir)) {

                        try {
                            $pensiun = date('Y-m-d', strtotime("+609 months", strtotime($value->tg_lahir)));
                    if (is_null(dtpkk::where('id', $value->id)->first()->tgl_pensiun)) {
                    // try {
                        dtpkk::where('id', $value->id)->update([
                            'tgl_pensiun'=>$pensiun,
                        ]);
                    // } catch (\Throwable $th) {
                           //throw $th;
                    // }
                    }
                    $awal  = date_create($value->tg_lahir);
                    // if (is_null($value->tmt_henti)) {
                        $akhir = date_create();
                        // } else {
                            // $akhir = date_create($value->tmt_henti);
                            // }
                            $diff  = date_diff($awal, $akhir);
                            // dd($diff);

                    if (is_null($value->tmt_5)) {
                        if ($diff->y == 50 && $diff->m >= 9) {

                            dtpkk::where('id', $value->id)->update([
                                'is_pensiun'=>TRUE,
                            ]);

                        }
                    } else {
                        if ($diff->y == 57 && $diff->m >= 9) {
                            dtpkk::where('id', $value->id)->update([
                                'is_pensiun'=>TRUE,
                            ]);
                        }
                    }
                        } catch (\Throwable $th) {
                            //throw $th;
                        }


                }


                // $time_end = microtime(true);
                // $execution_time = ($time_end - $time_start)/60;

                // echo '<b>Total Execution Time:</b> '.$execution_time.' Mins';
                // die;
            }
//   $time_end = microtime(true);
//                 $execution_time = ($time_end - $time_start)/60;

//                 echo '<b>Total Execution Time:</b> '.$execution_time.' Mins';
//                 die;
            sleep(3);
            $divide += 5000;

        }
        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start)/60;

        echo '<b>Total Execution Time:</b> '.$execution_time.' Mins';
    }


    public function validate_profiling()
    {

        $one = 0;
        $time_start = microtime(true);

        $divide = 0;
        $count = DB::table('datapokok')->where('is_pensiun',TRUE)->count();

        for ($i=0; $i <= intval($count/5000); $i++) {
            $dt = DB::table('datapokok')->where('is_pensiun', TRUE)->skip($divide)->limit(5000)->get();

            foreach ($dt as $key => $value) {
                $spec = DB::table('datapokok')->where('nrp', $value->nrp)->first();

                $total=0;
                $kosong=0;
                $ada=0;
                $validate=['nrp','tmt_henti','norek','nabank','narek'];
                foreach ($spec as $key => $val) {
                    if (in_array($key, $validate, true)) {
                        $total++;
                        if (!($val==null||$val==""||$val=="0000-00-00")) {
                            $ada++;
                        } else {
                            $kosong++;
                        }
                    }
                }

                if ($ada==$total) {
                    if (is_null(DB::table('notify')->where(['nrp'=>$value->nrp,'kategori'=>1])->first())) {
                        DB::table('notify')->insert([
                            'judul'=>'Terimakasih data anda sudah lengkap !',
                            'nrp'=>$value->nrp,
                            'pesan'=>"Terimakasih data anda telah lengkap !",
                            'kategori'=>1,
                            'created_at'=>Carbon::now()
                        ]);
                        dtpkk::where('id', $value->id)->update([
                            'is_complate'=>TRUE,
                        ]);
                    }else {
                        DB::table('notify')->where(['nrp'=>$value->nrp,'kategori'=>1])->update([
                            'pesan'=>"Terimakasih data anda telah lengkap !",
                        ]);
                        dtpkk::where('id', $value->id)->update([
                            'is_complate'=>TRUE,
                        ]);
                    }

                }
                else {
                    // if (is_null(DB::table('notify')->where(['nrp'=>$value->nrp,'kategori'=>1])->first())) {
                    //     DB::table('notify')->insert([
                    //         'judul'=>'lengkapi data anda',
                    //         'nrp'=>$value->nrp,
                    //         'pesan'=>"Silahkan lengkapi data anda terlebih dahulu ! ",
                    //         'kategori'=>1,
                    //         'created_at'=>Carbon::now()
                    //     ]);
                    // }else {
                    //     DB::table('notify')->where(['nrp'=>$value->nrp,'kategori'=>1])->update([
                    //         'is_read'=>0
                    //     ]);
                    // }
                }

                // $one += 1;
                // if ($one == 100) {
                    // $time_end = microtime(true);
                    // $execution_time = ($time_end - $time_start)/60;

                    // dd('<b>Total Execution Time:</b> '.$execution_time.' Mins');
                // }
            }
            $time_end = microtime(true);
            $execution_time = ($time_end - $time_start)/60;

            echo '<b>Total Execution Time:</b> '.$execution_time.' Mins';
            die;

            sleep(3);
            $divide += 5000;

        }
        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start)/60;

        echo '<b>Total Execution Time:</b> '.$execution_time.' Mins';



    }
}
