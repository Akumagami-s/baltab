<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Pengajuan;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ExportSprin implements FromCollection,WithHeadings, ShouldAutoSize,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pengajuan::where('is_sprin',TRUE)->get();
    }

    public function styles(Worksheet $sheet)
    {
        $count = Pengajuan::where('is_sprin',TRUE)->count() + 1;
        $string = 'A1:AD' . $count;
        $sheet->getStyle('A1:AD1')->getFont()->setBold(true);
        $sheet->getStyle($string)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
    }

    public function headings(): array
    {
        return [
            'id',
            'NRP',
            'Nama',
            'Gelar Depan',
            'Gelar Belakang',
            'Pangkat',
            'tmt_pkt',
            'ur_jab_skep',
            'Corps',
            'Kotama',
            'Satminkal',
            'Kesatuan',
            'TMT 1',
            'TMT 2',
            'TMT 3',
            'TMT 4',
            'TMT 5',
            'TMT ABRI',
            'NPWP',
            'TMT HENTI',
            'Kode P sub',
            'kd bansus',
            'tanggal update',
            'tmt pa',
            'Tanggal Lahir',
            'No Bitur',
            'KD keterangan',
            'tmt ktg',
            'Gaji Pokok',
            'istri',
            'anak',
            'kpr1',
            'kpr2',
            'kd stakel',
            'nama keluarga 1',
            'nama keluarga 2',
            'nama keluarga 3',
            'alamat',
            'data pokok id',
            'is sprin',
            'no sprin',
            'selesai',
            'no urut',
            'updated at',
            'created at',
        ];
    }
}



// <?php

// namespace App\Exports;

// use App\Detailkpr;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithHeadings;

// use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


// use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
// use Maatwebsite\Excel\Concerns\With Styles;
// use Maatwebsite\Excel\Concerns\WithColumnFormatting;
// use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

// class DetailkprExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting, ShouldAutoSize
// {
//     /**
//      * @return \Illuminate\Support\Collection
//      */
//     private function status($status)
//     {
//         if($status == 0){
//             return 'MANUAL';
//         }elseif($status == 1){
//             return 'MASSDEBET BRI';
//         }elseif ($status == 2) {
//             return 'BELUM VERIFIKASI';
//         }elseif ($status == 3) {
//             return 'MASSDEBET BTN';
//         }else{
//             return 'STATUS TIDAK DITEMUKAN';
//         }
//     }
//     public function collection()
//     {
//         $detailkpr = Detailkpr::select(
//             'nama',
//             'pangkat',
//             'nrp',
//             'kesatuan',
//             'kotama',
//             'alamat',
//             'tahap',
//             'pinjaman',
//             'jk_waktu',
//             'tmt_angsuran',
//             'jml_angs',
//             'angs_ke',
//             'angsuran_masuk',
//             'angs_masuk_btn',
//             'angs_masuk_manual',
//             'tunggakan',
//             'jml_tunggakan',
//             'tunggakan_pokok',
//             'tunggakan_bunga',
//             'keterangan',
//             'rek_bri',
//             'rek_btn',
//             'status',
//             'bunga',
//             'pokok',
//             'inisial_bunga',
//             'inisial_pokok',
//             'piutang_bunga',
//             'piutang_pokok',
//             'rekening_kredit'
//         )->get()->toArray();

//         $data = collect($detailkpr)->map(function ($detailkpr, $key) {
//             $collect = (object)$detailkpr;
//             return [
//                 'nama' => $collect->nama,
//                 'pangkat' => $collect->pangkat,
//                 'nrp' => $collect->nrp.' ',
//                 'kesatuan' => $collect->kesatuan,
//                 'kotama' => $collect->kotama,
//                 'alamat' => $collect->alamat,
//                 'tahap' => $collect->tahap,
//                 'pinjaman' => $collect->pinjaman,
//                 'jk_waktu' => $collect->jk_waktu,
//                 'tmt_angsuran' => $collect->tmt_angsuran,
//                 'jml_angs' => $collect->jml_angs,
//                 'angs_ke' => $collect->angs_ke,
//                 'angsuran_masuk' => $collect->angsuran_masuk,
//                 'angs_masuk_btn' => $collect->angs_masuk_btn,
//                 'angs_masuk_manual' => $collect->angs_masuk_manual,
//                 'tunggakan' => $collect->tunggakan,
//                 'jml_tunggakan' => $collect->jml_tunggakan,
//                 'tunggakan_pokok' => $collect->tunggakan_pokok,
//                 'tunggakan_bunga' => $collect->tunggakan_bunga,
//                 'keterangan' => $collect->keterangan,
//                 'rek_bri' => $collect->rek_bri.' ',
//                 'rek_btn' => $collect->rek_btn.' ',
//                 'rekening_kredit' => $collect->rekening_kredit.' ',
//                 'status' => $this->status($collect->status),
//                 'bunga' => $collect->bunga,
//                 'pokok' => $collect->pokok,
//                 'inisial_bunga' => $collect->inisial_bunga,
//                 'inisial_pokok' => $collect->inisial_pokok,
//                 'piutang_bunga' => $collect->piutang_bunga,
//                 'piutang_pokok' => $collect->piutang_pokok
//             ];
//         });
//         ini_set('memory_limit', '-1');
//         return $data;
//     }
//     public function headings(): array
//     {
//         return [
//             'nama',
//             'pangkat',
//             'nrp',
//             'kesatuan',
//             'kotama',
//             'alamat',
//             'tahap',
//             'pinjaman',
//             'jk_waktu',
//             'tmt_angsuran',
//             'jml_angs',
//             'angs_ke',
//             'angsuran_masuk',
//             'angs_masuk_btn',
//             'angs_masuk_manual',
//             'tunggakan',
//             'jml_tunggakan',
//             'tunggakan_pokok',
//             'tunggakan_bunga',
//             'keterangan',
//             'rek_bri',
//             'rek_btn',
//             'rekening_kredit',
//             'status',
//             'bunga',
//             'pokok',
//             'inisial_bunga',
//             'inisial_pokok',
//             'piutang_bunga',
//             'piutang_pokok'
//         ];
//     }
//     public function styles(Worksheet $sheet)
//     {
//         $count = Detailkpr::count() + 1;
//         $string = 'A1:AD' . $count;
//         $sheet->getStyle('A1:AD1')->getFont()->setBold(true);
//         $sheet->getStyle($string)->applyFromArray([
//             'borders' => [
//                 'allBorders' => [
//                     'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
//                     'color' => ['argb' => '000000'],
//                 ],
//             ],
//         ]);
//     }
//     public function columnFormats(): array
//     {
//         return [
//             'E' => NumberFormat::FORMAT_TEXT,
//             'U' => NumberFormat::FORMAT_TEXT,
//             'V' => NumberFormat::FORMAT_TEXT,
//             'W' => NumberFormat::FORMAT_TEXT
//         ];
//     }
// }
