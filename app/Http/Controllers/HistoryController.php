<?php

namespace App\Http\Controllers;

use App\Exports\LogExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class HistoryController extends Controller
{
   public function index(Request $request){
        if ($request->ajax()) {
            $data = DB::table('validasi_logs as a')
            ->leftJoin('validasi_data as b' , 'a.id_validasi' , '=' , 'b.id')
            ->select('a.created_at' , 'b.client' , 'b.title' , 'b.create_by' , 'a.sim_id' , 'a.parameter' , 'a.file1' , 'a.file2' )
            ->orderBy('a.id' , 'desc');

            if ($request->start_date) {
                $data->whereDate('a.created_at', '>=', $request->start_date);
            }

            if ($request->end_date) {
                $data->whereDate('a.created_at', '<=', $request->end_date);
            }

            if ($request->client_filter) {
                $data->where('b.client', 'like', '%' . $request->client_filter . '%');
            }

            return DataTables::of($data)
            ->addColumn('tanggal', fn($row) => \Carbon\Carbon::parse($row->created_at)->format('Y-m-d'))
            ->addColumn('waktu', fn($row) => \Carbon\Carbon::parse($row->created_at)->format('H:i:s'))
            ->make(true);
        }
        return view('pages.history');
   }


   public function download(Request $request){
      $filename = 'log_validasi_' . now()->format('Ymd_His') . '.xlsx';
      return Excel::download(new LogExport($request), $filename);
   }
}
