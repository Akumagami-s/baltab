<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Spatie\Activitylog\Traits\LogsActivity;

class Satminkal extends Eloquent
{
	use LogsActivity;
    protected $collection = 'master_satminkal';

    protected $fillable = ['_id','kode_ktm','kode','uraian','created_at','updated_at'];
    protected static $logFillable = true;
}
