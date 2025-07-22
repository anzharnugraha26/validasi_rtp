<?php

namespace App\Exports;

use App\Models\ValidasiDataDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ValidasiExport implements FromQuery , WithHeadings, ShouldAutoSize
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function query()
    {
        return ValidasiDataDetail::query()
            ->where('id_validasi', $this->id)
            ->select('sim_id', 'parameter', 'file1', 'file2');
    }

    public function headings(): array
    {
        return ['SIM ID', 'PARAMETER', 'FILE 1', 'FILE 2'];
    }
}
