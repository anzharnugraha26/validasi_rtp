<?php

namespace App\Http\Controllers;

use App\Models\ValidasiData;
use App\Models\ValidasiDataDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FrontEndController extends Controller
{
   public function index(Request $request){
        if ($request->ajax()) {
            $data = ValidasiData::orderBy('id' , 'desc')->get();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return '
                        <form id="form-' . $data->id . '" class="d-flex gap-2 align-items-center">
                            <input type="hidden" name="id" value="' . $data->id . '">

                            <label class="btn btn-sm btn-secondary m-0">
                                Upload 1
                                <input type="file" name="file1" accept=".csv,.xls,.xlsx"
                                    style="display:none"
                                    onchange="uploadFile(this, ' . $data->id . ', \'file1\')">
                            </label>

                            <label class="btn btn-sm btn-secondary m-0">
                                Upload 2
                                <input type="file" name="file2" accept=".csv,.xls,.xlsx"
                                    style="display:none"
                                    onchange="uploadFile(this, ' . $data->id . ', \'file2\')">
                            </label>

                            <button type="button" class="btn btn-sm btn-primary" onclick="submitValidate(' . $data->id . ')">
                                Validate
                            </button>
                            <button type="button" class="btn btn-sm btn-danger text-white" onclick="submitFinish('. $data->id.' )">
                                Finish
                            </button>
                        </form>
                    ';
                })
                ->addColumn('result', function ($data) {
                        $detail = ValidasiDataDetail::where('id_validasi' , $data->id)->first();

                        if ($detail) {
                            $html = '
                            <a href="'.url('validasi_result/'. $data->id ).'" class="btn btn-sm btn-success" title="Lihat Hasil">
                                <i class="fas fa-file-excel text-white" style="font-size:20px"></i>
                            </a>
                        ';
                        }else{
                            $html = '';
                        }

                        return $html;
                    })
                ->addColumn('formatted_total_1', fn($row) => number_format($row->total_1, 0, ',', '.'))
                ->addColumn('formatted_total_2', fn($row) => number_format($row->total_2, 0, ',', '.'))

                ->rawColumns([ 'actions' , 'result'])
                ->make(true);
        }


        return view('pages.index');
   }


   //old
    // <form method="post" action="'.url('/update_validasi').'" class="d-flex flex-nowrap gap-2 align-items-center" enctype="multipart/form-data">
    //                         <input type="hidden" name="_token" value="' . csrf_token() . '">
    //                         <input type="hidden" name="id" value="'.$data->id.'">
    //                         <div class="custom-file-wrapper">
    //                             <label class="btn btn-sm btn-secondary m-0">
    //                                 <span class="label-text">Upload 1</span>

    //                                 <input type="file"
    //                                  accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
    //                                 class="file-input" id="file1" name="file1"
    //                                 onchange="countExcelFileOne(this , '. $data->id.')"
    //                                 style="display: none;"
    //                                 >
    //                             </label>
    //                         </div>
    //                         <div class="custom-file-wrapper">
    //                             <label class="btn btn-sm btn-secondary m-0">
    //                                 <span class="label-text">Upload 2</span>

    //                                 <input
    //                                  accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
    //                                 type="file" class="file-input" data-label-target="file-label-2" name="file2"
    //                                  onchange="countExcelFileTwo(this , '. $data->id.')"
    //                                    style="display: none;"
    //                                 >
    //                              </label>
    //                         </div>
    //                         <button  class="btn btn-sm btn-primary m-0">Validate</button>
    //                         <a href="#" type="button" class="btn btn-sm btn-dark m-0">Finish</button>
    //                     </form>

}
