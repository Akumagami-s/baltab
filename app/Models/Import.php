<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\Datapokok;

class Import extends Eloquent
{
    protected $collection = 'imports';

    public function perubahan_formated($return_array = false, $return_update = false){
		$import = [
			'nrp'=>$this->nrp,
            'notam'=>$this->notam,
            'nama'=>$this->nama,
            'gelar_dpn'=>$this->gelar_dpn,
            'gelar_blk'=>$this->gelar_blk,
            'pangkat'=>$this->pangkat,
            'tmt_pkt'=>$this->tmt_pkt,
            'corps'=>$this->corps,
            'tmt_1'=>$this->tmt_1,
            'tmt_2'=>$this->tmt_2,
            'tmt_3'=>$this->tmt_3,
            'tmt_4'=>$this->tmt_4,
            'tmt_5'=>$this->tmt_5,
            'tmt_abri'=>$this->tmt_abri,
            'tg_lahir'=>$this->tg_lahir,
            'kd_ktg'=>$this->kd_ktg,
            'kd_ktm'=>$this->kd_ktm,
            'tmt_ktg'=>$this->tmt_ktg,
            'nm_kel1'=>$this->nm_kel1,
            'nm_kel2'=>$this->nm_kel2,
            'nm_kel3'=>$this->nm_kel3,
            'kd_smkl'=>$this->kd_smkl,
            'kd_stakel'=>$this->kd_stakel,
            'npwp'=>$this->npwp,
            'ur_jab_skep'=>$this->ur_jab_skep,
            'alamat'=>$this->alamat,
		];

		$baltab = Datapokok::find($this->old_id);
		
		$results = [];
		$update = [];
		$is_different = false;

		if($baltab){
			$original = [
				'nrp'=>$baltab->nrp,
                'notam'=>$baltab->notam,
                'nama'=>$baltab->nama,
                'gelar_dpn'=>$baltab->gelar_dpn,
                'gelar_blk'=>$baltab->gelar_blk,
                'pangkat'=>$baltab->pangkat,
                'tmt_pkt'=>$baltab->tmt_pkt,
                'corps'=>$baltab->corps,
                'tmt_1'=>$baltab->tmt_1,
                'tmt_2'=>$baltab->tmt_2,
                'tmt_3'=>$baltab->tmt_3,
                'tmt_4'=>$baltab->tmt_4,
                'tmt_5'=>$baltab->tmt_5,
                'tmt_abri'=>$baltab->tmt_abri,
                'tg_lahir'=>$baltab->tg_lahir,
                'kd_ktg'=>$baltab->kd_ktg,
                'kd_ktm'=>$baltab->kd_ktm,
                'tmt_ktg'=>$baltab->tmt_ktg,
                'nm_kel1'=>$baltab->nm_kel1,
                'nm_kel2'=>$baltab->nm_kel2,
                'nm_kel3'=>$baltab->nm_kel3,
                'kd_smkl'=>$baltab->kd_smkl,
                'kd_stakel'=>$baltab->kd_stakel,
                'npwp'=>$baltab->npwp,
                'ur_jab_skep'=>$baltab->ur_jab_skep,
                'alamat'=>$baltab->alamat,
			];
			
			$diff = array_diff($import, $original);

			$is_different = true;
		} else {
			$is_different = false;
		}

		if($is_different){
			foreach ($diff as $key => $value) {
				$results[$key] = [
					'before' => $original[$key],
					'after' => $import[$key]
				];

				$update[$key] = $import[$key];
			}
		}

		if($return_update){
			return $update;
		}

		if($return_array){
			return $results ? $results : false;
		}


		$html = '';
		$html .= '<div class="alert alert-callout alert-success box-verifikasi">';

		if(count($results)){
			$i = 1;
			foreach ($results as $key => $value) {
				$html .= '<strong>'.$key.'</strong><br>';
				$html .= 'Sebelum: '.$value['before'].'<br>';
				$html .= 'Sesudah: <strong class="text-warning"> '.$value['after'].'</strong><br>';
				if($i < count($results)){
					$html .= '<hr>';
				}
				$i++;
			}	
		} else {
			$html .= 'Tidak ada.';
		}
		
		$html .= '</div>';


		return $html;
    }

    public function data_formated(){
    	$data = $this->original;

    	unset(
	        $data['_id'],
	        $data['old_id'],
	        $data['created_at'],
	        $data['created_by']
	    );

    	$html = '';
		$html .= '<div class="alert alert-callout alert-info box-verifikasi">';

		$i = 0;
		foreach ($data as $key => $value) {
			$html .= $key.': <strong>'.$data[$key].'</strong><br>';
			$i++;
		}

		$html .= '</div>';

		return $html;	

		// return '<pre>'.json_encode($results, JSON_PRETTY_PRINT).'</pre>';
    }
}
