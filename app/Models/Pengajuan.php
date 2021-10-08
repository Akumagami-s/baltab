<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuans';
    protected $fillable = [
        'is_verif',
        'nrp',
        'is_pengajuan',
        'notam',
        'nama',
        'gelar_dpn',
        'gelar_blk',
        'pangkat',
        'tmt_pkt',
        'ur_jab_skep',
        'corps',
        'kd_ktm',
        'kd_smkl',
        'kesatuan',
        'tmt_1',
        'tmt_2',
        'tmt_3',
        'tmt_4',
        'tmt_5',
        'tmt_abri',
        'npwp',
        'tmt_henti',
        'kode_p_sub',
        'kd_bansus',
        'tg_update',
        'tmt_pa',
        'tg_lahir',
        'no_bitur',
        'kd_ktg',
        'tmt_ktg',
        'g_pokok',
        't_istri',
        't_anak',
        'kpr1',
        'kpr2',
        'kd_stakel',
        'nm_kel1',
        'nm_kel2',
        'nm_kel3',
        'alamat'];
    use HasFactory;


}
