<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ImportFile extends Eloquent
{
    protected $collection = 'import_files';

    protected $fillable = ['filename','rows'];
}
