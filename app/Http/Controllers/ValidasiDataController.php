<?php

namespace App\Http\Controllers;

use App\Exports\ValidasiExport;
use App\Models\ValidasiData;
use App\Models\ValidasiDataDetail;
use App\Models\ValidasiLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ValidasiDataController extends Controller
{
    public function saveValidasi(Request $request){
        $validasi = ValidasiData::create([
            'client' => $request->client,
            'title' => $request->title,
            'create_by' => Auth::user()->name
        ]);

         return response()->json([
            'message' => 'User berhasil disimpan.',
            'data' => $validasi
        ], 200);
    }

   public function updateValidasiOld(Request $request)
    {
        // Hapus data detail sebelumnya untuk validasi ini
        ValidasiDataDetail::where('id_validasi', $request->id)->delete();

        $file1 = $request->file('file1');
        $file2 = $request->file('file2');

        $sheet1 = Excel::toArray([], $file1)[0];
        $sheet2 = Excel::toArray([], $file2)[0];

        $headers = $sheet1[0]; // Ambil header

        unset($sheet1[0], $sheet2[0]); // Buang header dari data

        // Ubah data ke associative array dengan SIMID_BPR sebagai key
        $convertRows = function ($sheet) use ($headers) {
            return collect($sheet)
                ->filter(fn($row) => collect($row)->filter()->isNotEmpty())
                ->mapWithKeys(function ($row) use ($headers) {
                    if (count($row) < count($headers)) {
                        $row = array_pad($row, count($headers), null);
                    }
                    if (count($row) !== count($headers)) {
                        return [];
                    }

                    $assoc = array_combine($headers, $row);
                    $key = $assoc['SIMID_BPR'] ?? uniqid();

                    return [$key => $assoc];
                });
        };

        $data1 = $convertRows($sheet1);
        $data2 = $convertRows($sheet2);

        // dd($data1->pluck('TOTAL')->take(5));


        // Hitung total dari kolom TOTAL (dengan cleaning angka)
        $sumTotal1 = round($data1->sum(fn($row) => $this->parseNumber($row['TOTAL'] ?? null)), 0);
        $sumTotal2 = $data2->sum(fn($row) => $this->parseNumber($row['TOTAL'] ?? null));

        // Gabungkan semua SIMID_BPR dari dua file
        $allSimids = $data1->keys()->merge($data2->keys())->unique();

        $differences = [];

        foreach ($allSimids as $simid) {
            $row1 = $data1->get($simid, []);
            $row2 = $data2->get($simid, []);

            if ($row1 !== $row2) {
                foreach ($row1 as $key => $value1) {
                    $value2 = $row2[$key] ?? null;

                    if ($value1 !== $value2) {
                        $normalized1 = trim((string) ($value1 ?? ''));
                        $normalized2 = trim((string) ($value2 ?? ''));

                        // Jika keduanya numerik, bandingkan sebagai float
                        if (is_numeric($normalized1) && is_numeric($normalized2)) {
                            // Bandingkan dengan pembulatan 0 desimal (kamu bisa ubah ke 2-4 desimal jika mau lebih sensitif)
                            if (round((float) $normalized1, 0) !== round((float) $normalized2, 0)) {
                                $differences[] = [
                                    'id_validasi' => $request->id,
                                    'sim_id' => $simid,
                                    'parameter' => $key,
                                    'file1' => $value1,
                                    'file2' => $value2,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ];
                            }
                        } else {
                            // Bandingkan string (tanpa beda huruf besar/kecil)
                            if (strtolower($normalized1) !== strtolower($normalized2)) {
                                $differences[] = [
                                    'id_validasi' => $request->id,
                                    'sim_id' => $simid,
                                    'parameter' => $key,
                                    'file1' => $value1,
                                    'file2' => $value2,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ];
                            }
                        }
                    }
                }
            }
        }

        // Simpan metadata ke tabel validasi_data
        ValidasiData::where('id', $request->id)->update([
            'nama_file_1' => $file1->getClientOriginalName(),
            'nama_file_2' => $file2->getClientOriginalName(),
            'jumlah_data_1' => $data1->count(),
            'jumlah_data_2' => $data2->count(),
            'total_1' => $sumTotal1,
            'total_2' => $sumTotal2,
            'updated_at' => now()
        ]);

        // Simpan hasil perbedaan ke tabel detail
        if (!empty($differences)) {
            ValidasiDataDetail::insert($differences);
        }

        return response()->json([
            'message' => 'Berhasil dibandingkan dan disimpan.',
            'total_perbedaan' => count($differences),
            'total_file1' => $sumTotal1,
            'total_file2' => $sumTotal2,
            'differences' => $differences
        ]);
    }

// Fungsi bantu untuk membersihkan angka dari format ribuan atau simbol
    private function parseNumber($value)
    {
        if (is_null($value)) return 0;

        // Buang semua karakter selain angka, titik, dan minus
        $cleaned = preg_replace('/[^\d\.\-]/u', '', trim($value));

        return is_numeric($cleaned) ? floatval($cleaned) : 0;
    }

    public function uploadTemp(Request $request){
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx,csv',
            'tipe' => 'required|in:file1,file2',
            'id'   => 'required|numeric',
        ]);

        $file = $request->file('file');
        $tipe = $request->tipe; // file1 atau file2
        $id   = $request->id;

        $filename = 'validasi_' . $id . '_' . $tipe . '.' . $file->getClientOriginalExtension();
        $originalName = $file->getClientOriginalName();
        $file->storeAs('temp_validasi', $filename);

        // Baca isi Excel
        $sheet = Excel::toArray([], $file)[0] ?? [];
        $headers = $sheet[0] ?? [];
        unset($sheet[0]);

        // Filter baris kosong & konversi ke asosiatif
        $data = collect($sheet)->filter(fn($row) => collect($row)->filter()->isNotEmpty());
        $rows = $data->map(function ($row) use ($headers) {
            $row = array_pad($row, count($headers), null);
            return array_combine($headers, $row);
        });

        $jumlahBaris = $rows->count();
        $totalSum = round($rows->sum(fn($row) => $this->parseNumber($row['TOTAL'] ?? 0)), 0);

        // Update database
        $update = [
            'temp_' . $tipe => $filename,
            'jumlah_data_' . ($tipe == 'file1' ? '1' : '2') => $jumlahBaris,
            'total_' . ($tipe == 'file1' ? '1' : '2') => $totalSum,
            'nama_file_' . ($tipe == 'file1' ? '1' : '2') => $originalName,
            'updated_at' => now(),
        ];

        ValidasiData::where('id', $id)->update($update);

        return response()->json([
            'filename' => $filename,
            'original_name' => $originalName,
            'jumlah_data' => $jumlahBaris,
            'total' => $totalSum,
            'message' => 'Upload dan analisa berhasil'
        ]);
    }

   public function updateValidasi(Request $request)
{
    $id = $request->id;
    $record = ValidasiData::findOrFail($id);

    // Hapus data sebelumnya
    ValidasiDataDetail::where('id_validasi', $id)->delete();
    ValidasiLog::where('id_validasi', $id)->where('aksi', 'validasi_dijalankan')->delete();

    $file1Path = storage_path('app/temp_validasi/' . $record->temp_file1);
    $file2Path = storage_path('app/temp_validasi/' . $record->temp_file2);

    $sheet1 = Excel::toArray([], $file1Path)[0] ?? [];
    $sheet2 = Excel::toArray([], $file2Path)[0] ?? [];

    $headers1 = $sheet1[0] ?? [];
    $headers2 = $sheet2[0] ?? [];
    unset($sheet1[0], $sheet2[0]);

    // Cari header kolom SIM ID secara fleksibel
    $normalizeHeader = fn($h) => strtolower(str_replace(' ', '', trim($h)));

    $simIdHeader = collect($headers1)->first(function ($h) use ($normalizeHeader) {
        $norm = $normalizeHeader($h);
        return $norm === 'simid' || $norm === 'simid_bpr';
    });

    if (!$simIdHeader) {
        return response()->json([
            'message' => 'Kolom SIM ID tidak ditemukan di file pertama'
        ], 400);
    }

    // Mapping header file2 ke header file1 berdasarkan nama kolom
    $mapHeaders2 = [];
    foreach ($headers2 as $i => $h2) {
        $norm2 = $normalizeHeader($h2);
        $matchIndex = collect($headers1)->search(fn($h1) => $normalizeHeader($h1) === $norm2);
        if ($matchIndex !== false) {
            $mapHeaders2[$i] = $headers1[$matchIndex];
        }
    }

    // Konversi baris sheet1
    $convertRows1 = function ($sheet) use ($headers1, $simIdHeader) {
        return collect($sheet)
            ->filter(fn($row) => collect($row)->filter()->isNotEmpty())
            ->mapWithKeys(function ($row) use ($headers1, $simIdHeader) {
                $row = array_pad($row, count($headers1), null);
                $assoc = array_combine($headers1, $row);
                $key = $assoc[$simIdHeader] ?? uniqid();
                return [$key => $assoc];
            });
    };

    // Konversi baris sheet2 pakai mapping header
    $convertRows2 = function ($sheet) use ($mapHeaders2, $simIdHeader) {
        return collect($sheet)
            ->filter(fn($row) => collect($row)->filter()->isNotEmpty())
            ->mapWithKeys(function ($row) use ($mapHeaders2, $simIdHeader) {
                $assoc = [];
                foreach ($row as $i => $val) {
                    if (isset($mapHeaders2[$i])) {
                        $assoc[$mapHeaders2[$i]] = $val;
                    }
                }
                $key = $assoc[$simIdHeader] ?? uniqid();
                return [$key => $assoc];
            });
    };

    $data1 = $convertRows1($sheet1);
    $data2 = $convertRows2($sheet2);

    $allSimids = $data1->keys()->merge($data2->keys())->unique();

    $differences = [];
    $logs = [];

    foreach ($allSimids as $simid) {
        $row1 = $data1->get($simid, []);
        $row2 = $data2->get($simid, []);

        foreach ($row1 as $key => $value1) {
            $value2 = $row2[$key] ?? null;

            $normalized1 = trim((string) ($value1 ?? ''));
            $normalized2 = trim((string) ($value2 ?? ''));

            $isDifferent = false;

            if (is_numeric($normalized1) && is_numeric($normalized2)) {
                $isDifferent = round((float)$normalized1, 0 ) !== round((float)$normalized2, 0);
            } else {
                $isDifferent = strtolower($normalized1) !== strtolower($normalized2);
            }

            if ($isDifferent) {
                 $file1Value = is_numeric($value1) ? round((float)$value1, 0) : $value1;
                 $file2Value = is_numeric($value2) ? round((float)$value2, 0) : $value2;

                $differences[] = [
                    'id_validasi' => $id,
                    'sim_id' => $simid,
                    'parameter' => $key,
                    'file1' => $file1Value,
                    'file2' => $file2Value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $logs[] = [
                    'id_validasi' => $id,
                    'client' =>$record->client,
                    'title' =>$record->title,
                    'created_date' => $record->create_by,
                    'aksi' => 'validasi_dijalankan',
                    'deskripsi' => "Perbedaan ditemukan di kolom {$key}, SIM ID: {$simid}",
                    'file1' => $file1Value,
                    'file2' => $file2Value,
                    'parameter' => $key,
                    'sim_id' => $simid,
                    'oleh' => auth()->user()->name ?? request()->ip(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
    }

    // Insert chunked
    collect($differences)->chunk(1000)->each(fn($chunk) => ValidasiDataDetail::insert($chunk->toArray()));
    collect($logs)->chunk(1000)->each(fn($chunk) => ValidasiLog::insert($chunk->toArray()));

    return response()->json([
        'message' => 'Validasi berhasil',
        'total_perbedaan' => count($differences),
        'total_file1' => number_format($record->total_1, 0, '.', ''),
        'total_file2' => number_format($record->total_2, 0, '.', ''),
        'differences' => [] // bisa dikosongkan jika takut overload
    ]);
}


    public function result($id){
        ini_set('memory_limit', '2048M'); // 2 GB cukup untuk > 500rb baris
        set_time_limit(600);             // 10 menit
        $validasi = ValidasiData::where('id' , $id)->first();
        $data = ValidasiDataDetail::where('id_validasi' , $id)->get();
        return view('pages.report' , compact('data' , 'validasi'));

        // $filename = $validasi->client . '_result.xlsx';
        // return Excel::download(new ValidasiExport($id), $filename);
    }


    public function finish(Request $request){
        $id = $request->id;

        $data = ValidasiData::findOrFail($id);

        // Hapus file dari storage jika ada
        foreach (['temp_file1', 'temp_file2'] as $field) {
            if ($data->{$field}) {
                Storage::delete('temp_validasi/' . $data->{$field});
            }
        }

        // Hapus log
        // ValidasiLog::where('id_validasi', $id)->delete();

        // Hapus detail & header
        ValidasiDataDetail::where('id_validasi', $id)->delete();
        $data->delete();

        return response()->json([
            'message' => 'Data validasi dan file berhasil dihapus.'
        ]);
    }

}
