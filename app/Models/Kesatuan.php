<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Spatie\Activitylog\Traits\LogsActivity;

class Kesatuan extends Eloquent
{
	use LogsActivity;
    protected $collection = 'master_kesatuan';

    protected $fillable = ['_id','nopend','kobri','kosat','kpd','namsat','lokasi','kota','di','ku_kotama','created_at','updated_at'];
    protected static $logFillable = true;
}
