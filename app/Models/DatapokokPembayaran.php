<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use Spatie\Activitylog\Traits\LogsActivity;

class DatapokokPembayaran extends Eloquent
{
    use LogsActivity;
    protected $collection = 'datapokok_pembayaran';

    protected $fillable = ['_id','datapokok_id','status','history','uraian','created_at','updated_at'];
    protected static $logFillable = true;

    public static function updatePembayaran($datapokok_id, $status, $uraian = []){
    	$find = DatapokokPembayaran::raw()->findOne(['datapokok_id'=>$datapokok_id]);

    	if($find){
    		$pembayaran = DatapokokPembayaran::find($find['_id']);
    		$pembayaran->status = $status;
    		$pembayaran->push('history', [
	    		'status'=>$status,
	    		'updated_at'=>date('Y-m-d H:i:s')
	    	]);

            if($status == 4 && isset($uraian['tanggal'])){
               $pembayaran->uraian = array_merge($pembayaran->uraian, ['tanggal'=>$uraian['tanggal']]);
            }

            if($status == 2){
                $pembayaran->sprin_date = date('Y-m-d');
            }

	    	$pembayaran->save();

    		return;
    	}

    	$pembayaran = new DatapokokPembayaran;
    	$pembayaran->datapokok_id = $datapokok_id;
    	$pembayaran->status = $status;
    	$pembayaran->history = [
    		[
	    		'status'=>$status,
	    		'updated_at'=>date('Y-m-d H:i:s')
	    	]
    	];
        $pembayaran->sprin_date = null;
        $pembayaran->uraian = $uraian;
    	$pembayaran->save();

    	return;
    }

    public static function getSprinDate($datapokok_id){
        $find = DatapokokPembayaran::raw()->findOne(['datapokok_id'=>$datapokok_id]);

        if($find){
            return $find['sprin_date'];
        }

        return false;
    }

    public static function getSprinDateFormat($datapokok_id){
        $months = [
         'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
         'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $find = DatapokokPembayaran::raw()->findOne(['datapokok_id'=>$datapokok_id]);

        if($find && !empty($find['sprin_date'])){
            $raw = \DateTime::createFromFormat('Y-m-d', $find['sprin_date']);

            return $raw ? $raw->format('d').' '.$months[intval($raw->format('m')) - 1].' '.$raw->format('Y') : $tg_lahir;
        }

        return false;
    }
}
