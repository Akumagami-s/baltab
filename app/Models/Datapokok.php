<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\Pengajuan;
use App\Models\DatapokokPembayaran;
use Spatie\Activitylog\Traits\LogsActivity;

class Datapokok extends Eloquent
{
    use LogsActivity;
    protected $collection = 'datapokok';

    protected $fillable = [
        '_id',
        'nrp',
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
        'kd_ktgr',
        'tmt_ktgr',
        'kd_stakel',
        'nm_kel1',
        'nm_kel2',
        'nm_kel3',
        'alamat',
        'created_at',
        'updated_at',
    ];
    protected static $logFillable = true;

    public function updatePensiun(){
        $last_pangkat = $this->getActivePangkat(date('Y-m'));
        if(empty($last_pangkat)){
            return;
        }

        switch ($last_pangkat) {
            case 'tamtama':
                $add = 'P52Y';
                break;
            case 'bintara':
                $add = 'P52Y';
                break;
            case 'pama':
                $add = 'P57Y';
                break;
            case 'pamen':
                $add = 'P57Y';
                break;
            case 'pati':
                $add = 'P58Y';
                break;
        }

        $tg_lahir = \DateTime::createFromFormat('Y-m-d', $this->tg_lahir);

        if($tg_lahir){
            $pensiun = $tg_lahir->add(new \DateInterval($add))->format('Y-m-d');
        
            $this->tmt_henti = $pensiun;
            $this->save();
        }
    }

    public function tg_lahir_formated(){
    	$months = [
		 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
		 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
		];

    	$tg_lahir = $this->tg_lahir;

        if(!empty($tg_lahir) && $tg_lahir != '0000000'){
            $raw = \DateTime::createFromFormat('Y-m-d', $tg_lahir);

            return $raw ? $raw->format('d').' '.$months[intval($raw->format('m')) - 1].' '.$raw->format('Y') : $tg_lahir;
        }

        return '-';
    }

    public function tg_pengangkatan_formated(){
    	$months = [
		 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
		 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
		];

    	$tmt_abri = $this->tmt_abri;

        if(!empty($tmt_abri) && $tmt_abri != '0000000'){
            $raw = \DateTime::createFromFormat('Y-m-d', $tmt_abri);

            return $raw ? $raw->format('d').' '.$months[intval($raw->format('m')) - 1].' '.$raw->format('Y') : $tmt_abri;
        }

        return '-';
    }

    public function tg_pensiun_formated(){
        $months = [
         'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
         'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $tmt_henti = $this->tmt_henti;

        if(!empty($tmt_henti) && $tmt_henti != '00000000'){
            $raw = \DateTime::createFromFormat('Y-m-d', $tmt_henti);

            return $raw ? $raw->format('d').' '.$months[intval($raw->format('m')) - 1].' '.$raw->format('Y') : $tmt_henti;
        }

        return '-';
    }

    public function updated_at_formated(){
        $months = [
         'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
         'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $updated_at = $this->updated_at->format('Y-m-d');

        if(!empty($updated_at)){
            $raw = \DateTime::createFromFormat('Y-m-d', $updated_at);

            return $raw ? $raw->format('d').' '.$months[intval($raw->format('m')) - 1].' '.$raw->format('Y') : $updated_at;
        }

        return '-';
    }

    public function get_pangkat_uraian(){
		$kode = $this->pangkat;
        $pangkat = Pangkat::raw()->findOne(['kode'=>$kode]);

        if(!empty($kode)){
           	return $pangkat ? $pangkat['uraian'] : '<span class="text-danger">Undefined ('.$kode.')</span>';
        }

        return null;
    }

    public function get_corp_uraian(){
		$kode = $this->corps;
        $corp = Corp::raw()->findOne(['kode'=>strtoupper($kode)]);

        if(!empty($kode)){
            return $corp ? $corp['uraian'] : '<span class="text-danger">Undefined ('.$kode.')</span>';
        }

        return null;
    }

    public function get_kesatuan_uraian(){
        $kode = $this->kesatuan;
        $kesatuan = Kesatuan::raw()->findOne(['kosat'=>$kode]);
        
        if(!empty($kode)){
            return $kesatuan ? $kesatuan['namsat'] : '<span class="text-danger">Undefined ('.$kode.')</span>';
        }

        return null;
    }

    public function get_kotama_uraian(){
    	$kode = $this->kd_ktm;
        $kotama = Kotama::raw()->findOne(['kode'=>$kode]);
        
        if(!empty($kode)){
            return $kotama ? $kotama['uraian'] : '<span class="text-danger">Undefined ('.$kode.')</span>';
        }

        return null;
    }

    public function kenaikan_pangkat($tmt = false){
        if(!$tmt)
            return false;

        $months = [
         'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
         'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        if($this->validateDate($this->$tmt, 'Y-m-d')){
            $date = \DateTime::createFromFormat('Y-m-d', $this->$tmt);
            return $date->format('d').' '.$months[intval($date->format('m')) - 1].' '.$date->format('Y');

        }

        if($this->validateDate($this->$tmt, 'Y')){
            $date = \DateTime::createFromFormat('Y', $this->$tmt);
            return $date->format('Y');
        }

        return $this->$tmt && $this->$tmt != '0000000' ? $this->$tmt : '-';
    }    

    public function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }

    public static function validateDateStatic($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }

    public function status_pembayaran(){
        $pembayaran = DatapokokPembayaran::raw()->findOne(['datapokok_id'=>$this->_id]);

        return $pembayaran ? $pembayaran->status : 0;
    }

    public function status_pembayaran_msg(){
        $pembayaran = DatapokokPembayaran::raw()->findOne(['datapokok_id'=>$this->_id]);

        $msg = 'Belum Dicairkan';
        
        if($pembayaran){
            switch ($pembayaran->status) {
                case 1:
                    $msg = 'Pengajuan';
                    break;
                
                case 2:
                    $msg = 'Menunggu Persetujuan';
                    break;

                case 3:
                    $msg = 'Proses Pencairan';
                    break;

                case 4:
                    $msg = 'Sudah Dibayarkan';
                    break;
            }
        }

        return $msg;
    }

    public function hasPangkat(){
        if(
            $this->tmt_1 != '0000000' && $this->tmt_1 != null ||
            $this->tmt_2 != '0000000' && $this->tmt_2 != null ||
            $this->tmt_3 != '0000000' && $this->tmt_3 != null ||
            $this->tmt_4 != '0000000' && $this->tmt_4 != null ||
            $this->tmt_5 != '0000000' && $this->tmt_5 != null
        ){
            return true;
        }

        return false;
    }

    public function getActivePangkat($period_raw){
        $tmt_1 = $this->tmt_1 == '000000' ? '' : $this->tmt_1;
        $tmt_2 = $this->tmt_2 == '000000' ? '' : $this->tmt_2;
        $tmt_3 = $this->tmt_3 == '000000' ? '' : $this->tmt_3;
        $tmt_4 = $this->tmt_4 == '000000' ? '' : $this->tmt_4;
        $tmt_5 = $this->tmt_5 == '000000' ? '' : $this->tmt_5;

        $date_from = \DateTime::createFromFormat('Y-m-d', $this->tmt_abri);
        if(!$date_from){
            return '';
        }

        $date_from = $date_from->format('Y-m-d');
        $date_to = date('Y-m-d');

        $end_date = new \DateTime($date_to);
        $periods = new \DatePeriod(
            new \DateTime($date_from),
            new \DateInterval('P1M'),
            $end_date
        );

        $pangkat = '';
        $arr_pangkat = [];
        foreach ($periods as $period) {
            $period_format = $period->format('Y-m');

            switch ($period_format) {
                case substr($tmt_1, 0, 7):
                    $pangkat = 'tamtama';
                    break;
                case substr($tmt_2, 0, 7):
                    $pangkat = 'bintara';
                    break;
                case substr($tmt_3, 0, 7):
                    $pangkat = 'pama';
                    break;
                case substr($tmt_4, 0, 7):
                    $pangkat = 'pamen';
                    break;
                case substr($tmt_5, 0, 7):
                    $pangkat = 'pati';
                    break;
            }

            $arr_pangkat[$period->format('Y-m')] = $pangkat;
        }

        return isset($arr_pangkat[$period_raw]) ? $arr_pangkat[$period_raw] : '';
    }

    public function alreadyPengajuan(){
        $find = Pengajuan::raw()->findOne(['datapokok_id'=>$this->_id]);

        if($find){
            return $find['_id'];
        }

        return false;
    }

    public static function kalkulasi($data){
        if(!$data->hasPangkat()){
            return false;
        }

        $date_from = \DateTime::createFromFormat('Y-m-d', $data['tmt_abri'])->format('Y-m-01');
        
        if($data['kpr1'] == "S"){
            $date_from = \DateTime::createFromFormat('Y-m-d', '2009-04-01')->format('Y-m-01');
        }

        $date_to = date('Y-m-d');

        if(Datapokok::validateDateStatic($data['tmt_henti'], 'Y-m-d')){
            if($data['tmt_henti'] < date('Y-m-d')){
                $date_to = $data['tmt_henti'];
            }
        } else if(strtolower($data['kpr1']) == 'p' || strtolower($data['kpr1']) == 'g'){
            if(DatapokokPembayaran::getSprinDate($data['_id'])){
                $date_to = DatapokokPembayaran::getSprinDate($data['_id']);
            }
        }

        /** Prevent invalid month **/
        $date_to = substr($date_to, 0, 7).'-02';

        $end_date = new \DateTime($date_to);
        $periods = new \DatePeriod(
            new \DateTime($date_from),
            new \DateInterval('P1M'),
            $end_date
        );

        $potongan = 0;
        $bunga = 0;
        $nilai_bunga = 0;
        $jml_tabungan = 0;
        $bunga_bulanan = 0;

        $bunga_arr = [];

        $bulan_counter = 0;
        $last_potongan = 0;
        $last_period = '';

        $potongans = [];
        $potongan_i = 0;

        $i = 0;

        $html = '';

        $html .= "<style>
            table.testing {
                border-spacing: 0px;
            }
            table.testing td, table.testing th {
                border: 1px solid #000;
                padding: 5px;
            }
            </style>
        ";
        $html .= "
            <table class='table table-striped table-bordered' >
                <tr>
                    <th width='100'>Period</th>
                    <th width='100'>Potongan</th>
                    <th width='100'>Bunga</th>
                    <th width='100'>Bunga Pada Bulan</th>
                    <th width='200'>Jumlah Tabungan</th>
                </tr>
        ";

        foreach ($periods as $period) {
            $period_format = $period->format('Y-m');

            $pangkat = $data->getActivePangkat($period_format);
            $potongan = Potongan::loadPeriod($period_format, $pangkat);

            if($potongan <= 0){ // bypass potongan = 0
                continue;
            }

            if($i == 0){
                $nilai_bunga = 0;
                $jml_tabungan += $potongan;
            } else {
                $bunga = Bunga::loadPeriod($period_format);
                $bunga_bulanan = number_format(($jml_tabungan * ($bunga/100) / 12) , 2, '.', '');
                $jml_tabungan = number_format(($jml_tabungan + ($jml_tabungan * ($bunga/100) / 12) + $potongan) , 2, '.', '');
            }

            $html .= "<tr>";
            $html .= " <td>".$period_format."</td>";
            $html .= " <td>".(float) $potongan."</td>";
            $html .= " <td>".$bunga."%</td>";
            $html .= " <td>".number_format($bunga_bulanan,2,',','.')."</td>";
            $html .= " <td>".number_format($jml_tabungan,2,',','.')."</td>";
            $html .= "</tr>";

            $bunga_arr[] = (float) $bunga_bulanan;

            if($i == 0){
                $potongans[$potongan_i] = [
                    'period_start'=>$period_format,
                    'nilai'=>$potongan,
                ];
            }

            if($potongan != $last_potongan){
                $potongans[$potongan_i]['period_end'] = $last_period;
                $potongans[$potongan_i]['nilai_akhir'] = ($last_potongan * $bulan_counter);
                $potongans[$potongan_i]['jumlah_bulan'] = ($bulan_counter);
            }

            if($potongan != $last_potongan && $i !=0){
                $potongan_i++;
                $potongans[$potongan_i] = [
                    'period_start'=>$period_format,
                    'nilai'=>$potongan
                ];

                $bulan_counter = 0;
            }

            $bulan_counter++;
            $last_potongan = $potongan;
            $last_period = $period_format;

            $i++;
        }

        $total_bunga = array_sum($bunga_arr);

        $html .= "</table>";

        if(!count($potongans)){
            return false;
        }
        
        $potongans[$potongan_i]['period_end'] = $last_period;
        $potongans[$potongan_i]['nilai_akhir'] = ($last_potongan * $bulan_counter);
        $potongans[$potongan_i]['jumlah_bulan'] = ($bulan_counter);

        $rekap = Datapokok::parsePotongan($potongans, $data);

        $potongans = $rekap['new_potongans'];
        $bulan_potongan = $rekap['bulan_potongan'];
        $pokok_potongan = number_format($rekap['pokok_potongan'],2,',','.');
        $periode_potongan = $rekap['periode_potongan'];

        $final_bunga = $total_bunga;
        $final_potongan = ($rekap['pokok_potongan'] + $final_bunga);

        $bunga_potongan = number_format($final_bunga,2,',','.');
        $total_potongan = number_format($final_potongan,2,',','.');

        $html = $html;

        return compact('potongans','bulan_potongan','pokok_potongan','periode_potongan','bunga_potongan','total_potongan','html');
    }

    public static function parsePotongan($potongans, $data){
        $new_potongans = [];
        
        $bulan_potongan = 0;
        $pokok_potongan = 0;

        $str_period_start = '';

        foreach ($potongans as $key=>$potongan) {
            if(empty($str_period_start) && $potongan['nilai'] > 0){
                $str_period_start = \Carbon\Carbon::createFromFormat('Y-m', $potongan['period_start'])->format("F Y");
            }

            $str_start = \Carbon\Carbon::createFromFormat('Y-m', $potongan['period_start'])->format("M' y");
            $str_end = \Carbon\Carbon::createFromFormat('Y-m', $potongan['period_end'])->format("M' y");
            $str_period = $str_start.' s.d '.$str_end;

            if($potongan['period_end'] == '1986-01' || empty($data['tmt_henti']) && $potongan['period_start'] == '2018-01' || $data['tmt_henti'] == '00000' && $potongan['period_start'] == '2018-01'){
                
            } else {
                if($potongan['period_end'] <= '2009-03'){
                    $keterangan = ucfirst($data->getActivePangkat($potongan['period_start']));
                } else {
                    $keterangan = '(Index Rp.'.number_format($potongan['nilai'],0,',','.').'.-)';
                }

                $new_potongans[] = [
                    'keterangan'=>$keterangan,
                    'period'=>$str_period,
                    'bulan'=>$potongan['jumlah_bulan'],
                    'nilai'=>number_format($potongan['nilai'],0,',','.'),
                    'nilai_akhir'=>number_format($potongan['nilai_akhir'],0,',','.'),
                ];
            }

            if($potongan['nilai'] > 0){
                $bulan_potongan += $potongan['jumlah_bulan'];
            }

            $pokok_potongan += $potongan['nilai_akhir'];

            if(($key+1) == count($potongans)){
                $str_period_end = \Carbon\Carbon::createFromFormat('Y-m', $potongan['period_end'])->format("F Y");
            }
        }

        $periode_potongan = 'Pokok ('.$str_period_start.' s.d '.$str_period_end.')';

        return compact('bulan_potongan','pokok_potongan','periode_potongan','new_potongans');
    }

    public function getPembayaran(){
        $find = DatapokokPembayaran::raw()->findOne(['datapokok_id'=>$this->_id]);

        return $find ? $find['uraian'] : [];
    }

    public static function updateKpr($datapokok_id){
        $datapokok = Datapokok::find($datapokok_id);

        if(strtolower($datapokok['kpr1']) == 's'){
            $datapokok->kpr1 = 'G';
        } else {
            $datapokok->kpr1 = 'P';
        }

        $datapokok->save();
    }

}
