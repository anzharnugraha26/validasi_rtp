<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CompareController extends Controller
{
     public function index()
    {
        return view('compare');
    }

    public function compare(Request $request)
    {
        $request->validate([
            'file1' => 'required|file|mimes:xlsx,xls',
            'file2' => 'required|file|mimes:xlsx,xls',
        ]);

        $file1 = Excel::toArray([], $request->file('file1'));
        $file2 = Excel::toArray([], $request->file('file2'));

        $data1 = $file1[0]; // hanya sheet pertama
        $data2 = $file2[0];

        $differences = [];

        $rowCount = max(count($data1), count($data2));
        for ($i = 0; $i < $rowCount; $i++) {
            $colCount = max(
                isset($data1[$i]) ? count($data1[$i]) : 0,
                isset($data2[$i]) ? count($data2[$i]) : 0
            );

            for ($j = 0; $j < $colCount; $j++) {
                $val1 = $data1[$i][$j] ?? null;
                $val2 = $data2[$i][$j] ?? null;

                if ($val1 !== $val2) {
                    $differences[] = [
                        'row' => $i + 1,
                        'col' => $j + 1,
                        'file1' => $val1,
                        'file2' => $val2,
                    ];
                }
            }
        }

        return view('compare', compact('differences'));
    }
}
