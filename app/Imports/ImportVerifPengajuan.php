<?php

namespace App\Imports;

use App\Models\Pengajuan;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class ImportVerifPengajuan implements ToModel, WithBatchInserts , WithHeadingRow,SkipsOnFailure
{
    use Importable,SkipsFailures;
    public function model(array $row)
    {
        Pengajuan::where('nrp',$row['nrp'])->update(
            [
                'is_verif'=>TRUE
            ]
            );

    }


    // public function rules(): array
    // {
    //     return [
    //         'email' => [
    //             'email',
    //             'string',
    //         ],
    //     ];
    // }


    public function batchSize(): int
    {
        return 3000;
    }
}
