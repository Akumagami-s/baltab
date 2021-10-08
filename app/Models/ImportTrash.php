<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\Import;

class ImportTrash extends Eloquent
{
    protected $collection = 'import_trash';
}
