<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    protected $connection = "login";
    protected $table = 'data_master_pangkat';
    protected $fillable = ['_id','kode','uraian','created_at','updated_at'];
    use HasFactory;
}
