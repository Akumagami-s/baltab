<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Pengajuan;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\DB;
use App\Models\dtpkk;
class ExportPensiun implements FromCollection,WithHeadings, ShouldAutoSize,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = dtpkk::where('tgl_pensiun', 'LIKE' ,'%2021-10%')->select(
            'nama',
            'pangkat',
            'nrp',
            'tg_lahir',
            'tgl_pensiun',
            'total',
            'bunga',

        )->get()->toArray();


        $dt = collect($data)->map(function ($data, $key) {
            $collect = (object)$data;
            return [
                'nama' => $collect->nama,
                'pangkat' => $collect->pangkat,
                'nrp' => $collect->nrp.' ',
                'tg_lahir' => $collect->tg_lahir,
                'tgl_pensiun' => $collect->tgl_pensiun,
                'total' => $collect->total,

                'bunga' => $collect->bunga,


            ];
        });
        ini_set('memory_limit', '-1');
        return $dt;



    }

    public function styles(Worksheet $sheet)
    {
        $count = dtpkk::where('tgl_pensiun', 'LIKE' ,'%2021-10%')->count() + 1;
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
            'nama',
            'pangkat',
            'nrp',

            'tg_lahir',
            'tgl_pensiun',
            'total',
            'bunga'
        ];
    }
}

