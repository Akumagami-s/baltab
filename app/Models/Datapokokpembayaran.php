<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datapokokpembayaran extends Model
{
    protected $table = 'datapokok_pembayaran';
    protected $fillable = ['datapokok_id','status','sprin_date','jumlah','bunga','bulan','nama_bank','no_rekening','atas_nama','tanggal'];
    use HasFactory;
}
