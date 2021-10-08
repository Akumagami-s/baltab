<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class MasterController extends Controller
{
    public function master(Request $request)
    {

        $pangkat = DB::connection('login')->table('data_master_pangkat')->get();
        $kesatuan = DB::connection('login')->table('data_master_kesatuan')->get();
        $corp = DB::connection('login')->table('data_master_corp')->get();
        $kategori = DB::connection('login')->table('data_master_kategori')->get();
        $kotama = DB::connection('login')->table('data_master_kotama')->get();
        $satminkal = DB::connection('login')->table('data_master_satminkal')->get();
        $bunga = DB::table('bungas')->get();
        $potongan = DB::table('potongans')->get();

        return view('master.index',['pangkat'=>$pangkat,'kesatuan'=>$kesatuan,'corp'=>$corp,'kategori'=>$kategori,'kotama'=>$kotama,'satminkal'=>$satminkal,'bunga'=>$bunga,'potongan'=>$potongan]);
    }


    public function createPangkat(Request $request)
    {
        $pangkat = DB::connection('login')->table('data_master_pangkat')->insert([
			'kode' => $request->kode,
			'uraian' => $request->uraian,

		]);

        return redirect()->back()->with(['message'=>'pangkat sudah dibuat']);
    }

    public function deletePangkat($id)
    {
        DB::connection('login')->table('data_master_pangkat')->where('id',$id)->delete();
        return redirect()->back()->with(['message'=>'pangkat berhasil didelete']);
    }

    public function deletePotongan($id)
    {
        DB::table('potongans')->where('id',$id)->delete();
        return redirect()->back()->with(['message'=>'potongan berhasil didelete']);
    }



    public function createKesatuan(Request $request)
    {
        $kesatuan = DB::connection('login')->table('data_master_kesatuan')->insert([
			'nopend' => $request->nopend,
			'kobri' => $request->kobri,
            'kosat' => $request->kosat,
            'kpd' => $request->kpd,
            'namsat' => $request->namsat,
            'lokasi' => $request->lokasi,
            'kota' => $request->kota,
            'di' => $request->di,
            'ku_kotama' => $request->ku_kotama,

		]);
        return redirect()->back()->with(['message'=>'kesatuan sudah dibuat']);
    }

    public function deleteKesatuan($id)
    {
        DB::connection('login')->table('data_master_kesatuan')->where('id',$id)->delete();
        return redirect()->back()->with(['message'=>'kesatuan berhasil didelete']);
    }

    public function createCorp(Request $request)
    {
        $corp = DB::connection('login')->table('data_master_corp')->insert([
            'kode' => $request->kode,
			'uraian' => $request->uraian,

		]);
        return redirect()->back()->with(['message'=>'corp sudah dibuat']);
    }

    public function deleteCorp($id)
    {
        DB::connection('login')->table('data_master_corp')->where('id',$id)->delete();
        return redirect()->back()->with(['message'=>'corp berhasil didelete']);
    }


    public function createKategori(Request $request)
    {
        $corp = DB::connection('login')->table('data_master_kategori')->insert([
            'kode' => $request->kode,
			'uraian' => $request->uraian,

		]);
        return redirect()->back()->with(['message'=>'kategori sudah dibuat']);
    }

    public function deleteKategori($id)
    {
        DB::connection('login')->table('data_master_kategori')->where('id',$id)->delete();
        return redirect()->back()->with(['message'=>'kategori berhasil didelete']);
    }

    public function createKotama(Request $request)
    {
        $kategori = DB::connection('login')->table('data_master_kotama')->insert([
            'kode' => $request->kode,
			'uraian' => $request->uraian,
		]);
        return redirect()->back()->with(['message'=>'kotama sudah dibuat']);
    }


    public function deleteKotama($id)
    {
        DB::connection('login')->table('data_master_kotama')->where('id',$id)->delete();
        return redirect()->back()->with(['message'=>'kotama berhasil didelete']);
    }


    public function createSatminkal(Request $request)
    {
        $satminkal = DB::connection('login')->table('data_master_satminkal')->insert([
			'kode_ktm' => $request->kode_ktm,
			'kode' => $request->kode,
            'uraian' => $request->uraian,

		]);
        return redirect()->back()->with(['message'=>'satminkal sudah dibuat']);
    }

    public function deleteSatminkal($id)
    {
        DB::connection('login')->table('data_master_satminkal')->where('id',$id)->delete();
        return redirect()->back()->with(['message'=>'kotama berhasil didelete']);
    }

    public function createBunga(Request $request)
    {
        $bunga = DB::table('bungas')->insert([
            'period'=> $request->period,
            'type'=> "value",
            'value'=> $request->jumlah,

        ]);


        return redirect()->back()->with(['message'=>'bunga telah ditambahkan']);
    }

    public function deleteBunga($id)
    {
        DB::table('bungas')->where('id',$id)->delete();
        return redirect()->back()->with(['message'=>'kotama berhasil didelete']);
    }

    public function createPotongan(Request $request)
    {
        $period = $request->tahun .'-'.$request->bulan;
        $bunga = DB::table('potongans')->insert([
            'period'=> $period,
            'type'=> 'value',
            'value'=> $request->value,
            'pangkat'=> $request->pangkat,

        ]);

        return redirect()->back()->with(['message'=>'potongan telah ditambahkan']);
    }



    public function updatePangkat($id)
    {
        $data = DB::connection('login')->table('data_master_pangkat')->where('id',$id)->first();

        return view('master.edit',['type'=>'pangkat','data'=>$data]);
    }

    public function editPangkat(Request $request,$id)
    {
        DB::connection('login')->table('data_master_pangkat')->where('id',$id)->update([
            'kode'=>$request->kode,
            'uraian'=>$request->uraian
        ]);
        return redirect()->back()->with(['message'=>'pangkat telah di edit']);
    }

    public function updateKesatuan($id)
    {
        $data = DB::connection('login')->table('data_master_kesatuan')->where('id',$id)->first();

        return view('master.edit',['type'=>'kesatuan','data'=>$data]);
    }

    public function editKesatuan(Request $request,$id)
    {
        DB::connection('login')->table('data_master_kesatuan')->where('id',$id)->update([
            'nopend'=>$request->nopend,
            'kobri'=>$request->kobri,
            'kosat'=>$request->kosat,
            'namsat'=>$request->namsat,
        ]);
        return redirect()->back()->with(['message'=>'kesatuan telah di edit']);
    }

    public function updateCorp($id)
    {
        $data = DB::connection('login')->table('data_master_corp')->where('id',$id)->first();

        return view('master.edit',['type'=>'corp','data'=>$data]);
    }

    public function editCorp(Request $request,$id)
    {
        DB::connection('login')->table('data_master_corp')->where('id',$id)->update([
            'kode'=>$request->kode,
            'uraian'=>$request->uraian,

        ]);
        return redirect()->back()->with(['message'=>'Corp telah di edit']);
    }

    public function updateKategori($id)
    {
        $data = DB::connection('login')->table('data_master_kategori')->where('id',$id)->first();

        return view('master.edit',['type'=>'kategori','data'=>$data]);
    }


    public function editKategori(Request $request,$id)
    {
        DB::connection('login')->table('data_master_kategori')->where('id',$id)->update([
            'kode'=>$request->kode,
            'uraian'=>$request->uraian,

        ]);
        return redirect()->back()->with(['message'=>'Kategori telah di edit']);
    }


    public function updateKotama($id)
    {
        $data = DB::connection('login')->table('data_master_kotama')->where('id',$id)->first();

        return view('master.edit',['type'=>'kotama','data'=>$data]);
    }


    public function editKotama(Request $request,$id)
    {
        DB::connection('login')->table('data_master_kotama')->where('id',$id)->update([
            'kode'=>$request->kode,
            'uraian'=>$request->uraian,

        ]);
        return redirect()->back()->with(['message'=>'Kotama telah di edit']);
    }



    public function updateSatminkal($id)
    {

        $data = DB::connection('login')->table('data_master_satminkal')->where('id',$id)->first();
        return view('master.edit',['type'=>'satminkal','data'=>$data]);
    }

    public function editSatminkal(Request $request,$id)
    {
        DB::connection('login')->table('data_master_satminkal')->where('id',$id)->update([
            'kode_ktm'=>$request->kode_ktm,
            'kode'=>$request->kode,
            'uraian'=>$request->uraian,

        ]);
        return redirect()->back()->with(['message'=>'Satminkal telah di edit']);
    }

    public function updateBunga($id)
    {
        return view('master.edit',['type'=>'bunga']);
    }

    public function updatePotongan($id)
    {
        return view('master.edit',['type'=>'potongan']);
    }



}


