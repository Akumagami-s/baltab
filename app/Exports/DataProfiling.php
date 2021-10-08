<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use App\Models\dtpkk;

class DataProfiling implements FromCollection ,WithHeadings, ShouldAutoSize,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $type;
    protected $date;


    function __construct($type,$date=NULL) {
        $this->type = $type;
        $this->date = $date;

    }

    public function collection()
    {

        if (!is_null($this->date)) {



    if ($this->type == 0) {
        $data = dtpkk::where(['is_pensiun'=>TRUE,'is_complate'=>FALSE])->where('tgl_pensiun', 'LIKE' ,'%'.$this->date.'%')->select(
            'nama',
            'pangkat',
            'nrp',
            'tg_lahir',
            'tgl_pensiun',
            'total',
            'bunga',

        )->get()->toArray();
    }else if($this->type == 1){
        $data = dtpkk::where(['is_pengajuan'=>FALSE,'is_pensiun'=>TRUE,'is_complate'=>TRUE])->where('tgl_pensiun', 'LIKE' ,'%'.$this->date.'%')->select(
            'nama',
            'nrp',
            'tg_lahir',
            'tgl_pensiun',


        )->get()->toArray();
    }
        } else {


    if ($this->type == 0) {
        $data = dtpkk::where(['is_pensiun'=>TRUE,'is_complate'=>FALSE])->select(
            'nama',
            'pangkat',
            'nrp',
            'tg_lahir',
            'tgl_pensiun',
            'total',
            'bunga',

        )->get()->toArray();
    }else if($this->type == 1){
        $data = dtpkk::where(['is_pengajuan'=>FALSE,'is_pensiun'=>TRUE,'is_complate'=>TRUE])->select(
            'nama',
            'nrp',
            'tg_lahir',
            'tgl_pensiun',


        )->get()->toArray();
    }
        }




    $dt = collect($data)->map(function ($data, $key) {
        $collect = (object)$data;
        return [
            'nama' => $collect->nama,

            'nrp' => $collect->nrp.' ',
            'tg_lahir' => $collect->tg_lahir,
            'tgl_pensiun' => $collect->tgl_pensiun,
            'status' => $this->type == 1 ? "Data sudah lengkap " : "Data belum lengkap",


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
            'nrp',
            'tg_lahir',
            'tgl_pensiun',
            'status'
        ];
    }
}
