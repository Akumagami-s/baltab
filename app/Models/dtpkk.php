<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dtpkk extends Model
{
    protected $table = "datapokok";

    protected $fillable = ['tgl_pensiun'];
    use HasFactory;
}
