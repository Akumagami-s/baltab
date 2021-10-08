<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Spatie\Activitylog\Traits\LogsActivity;

class Kotama extends Eloquent
{
	use LogsActivity;
    protected $collection = 'master_kotama';

    protected $fillable = ['_id','kode','uraian','created_at','updated_at'];
    protected static $logFillable = true;
}
