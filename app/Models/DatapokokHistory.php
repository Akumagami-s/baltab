<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Spatie\Activitylog\Traits\LogsActivity;

class DatapokokHistory extends Eloquent
{
	use LogsActivity;
    protected $collection = 'baltab_history';

    protected $fillable = ['_id','datapokok_id','log','created_at','updated_at'];
    protected static $logFillable = true;
}