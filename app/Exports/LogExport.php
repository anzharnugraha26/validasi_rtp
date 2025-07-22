<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LogExport implements FromQuery , WithHeadings
{
      protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $query = DB::table('validasi_logs as a')
            ->leftJoin('validasi_data as b', 'a.id_validasi', '=', 'b.id')
            ->select(
                DB::raw('DATE(a.created_at) as tanggal'),
                DB::raw('TIME(a.created_at) as waktu'),
                'b.client',
                'b.title',
                'b.create_by',
                'a.sim_id',
                'a.parameter',
                'a.file1',
                'a.file2'
            );

        if ($this->request->start_date) {
            $query->whereDate('a.created_at', '>=', $this->request->start_date);
        }
        if ($this->request->end_date) {
            $query->whereDate('a.created_at', '<=', $this->request->end_date);
        }
        if ($this->request->client) {
            $query->where('b.client', 'like', '%' . $this->request->client . '%');
        }

        $query->orderBy('a.created_at', 'desc');

        return $query;
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Waktu',
            'Client',
            'Judul Validasi',
            'Dibuat Oleh',
            'SIMID_BPR',
            'Kolom',
            'File 1',
            'File 2'
        ];
    }
}
