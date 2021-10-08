<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Spatie\Activitylog\Traits\LogsActivity;

class Bunga extends Eloquent
{
    use LogsActivity;
    protected $collection = 'bungas';

    protected $fillable = ['_id','period','type','value','created_at','updated_at'];
    protected static $logFillable = true;

    public static function loadPeriod($period){
    	$find = Bunga::raw()->findOne(['period'=>['$lte'=>$period]],['sort'=>['period'=>-1]]);

    	if($find){
    		return $find['value'];
    	}

    	return 0;
    }

    public function period_range(){
    	$months = [
		 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
		 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
		];

    	$find = Bunga::raw()->findOne(['period'=>['$gt'=>$this->period]],['sort'=>['period'=>1]]);

    	$date_start = \DateTime::createFromFormat('Y-m', $this->period);
    	if($find){
    		$date_end = \DateTime::createFromFormat('Y-m', $find->period);
    		$date_end->modify('-1 month'); 

    		return $months[intval($date_start->format('m')) - 1].$date_start->format(' Y').' - '.$months[intval($date_end->format('m')) - 1].$date_end->format(' Y');
    	}

    	return $months[intval($date_start->format('m')) - 1].$date_start->format(' Y').' - Sekarang';
    }
}
