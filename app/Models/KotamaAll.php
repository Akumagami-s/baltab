<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KotamaAll extends Model
{
    protected $connection = "login";
    protected $table = "data_master_kotama";
    use HasFactory;
}
