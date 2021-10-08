<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potongan extends Model
{
    protected $table = 'potongans';
    protected $fillable = ['_id','period','type','value','pangkat','created_at','updated_at'];
    use HasFactory;
}
