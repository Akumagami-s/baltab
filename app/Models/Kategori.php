<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Spatie\Activitylog\Traits\LogsActivity;

class Kategori extends Eloquent
{
	use LogsActivity;
    protected $collection = 'master_kategori';

    protected $fillable = ['_id','kode','uraian','created_at','updated_at'];
    protected static $logFillable = true;
}
