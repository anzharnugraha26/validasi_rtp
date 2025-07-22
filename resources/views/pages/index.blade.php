@extends('layouts.master')
@section('pages_name')
    Validasi Data
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .table-responsive {
            overflow-x: auto;
            white-space: nowrap;
        }
    </style>
@endsection
@section('content')
    <div class="main-content-container overflow-hidden">
        @include('layouts.page_header', ['title' => 'VALIDASI DATA'])
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-4">
                        <button type="button"
                            class="btn btn-outline-primary py-1 px-2 px-sm-4 fs-14 fw-medium rounded-3 hover-bg"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <span class="py-sm-1 d-block">
                                <i class="ri-add-line"></i>
                                <span>Tambah</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">


                <div class="default-table-area ">
                    <div class="table-responsive">
                        <table class="table align-middle" id="datatable_1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Client</th>
                                    <th>Title</th>
                                    <th>Create By</th>
                                    <th>File 1</th>
                                    <th>File 2</th>
                                    <th>Jumlah data 1</th>
                                    <th>Jumlah data 2</th>
                                    <th>Total 1</th>
                                    <th>Total 2</th>
                                    <th>Result</th>
                                    <th style="min-width: 300px;">Kontrol</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="myForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">VALIDASI DATA</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 p-4">
                                <div class="form-group">
                                    <label for="">Client</label>
                                    <input type="text" class="form-control mt-2" name="client" id=""
                                        placeholder="Masukan Nama Client..." required>
                                </div>
                            </div>
                            <div class="col-md-12 p-4">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control mt-2" name="title" id=""
                                        placeholder="Masukan Title" required>
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.routes = {
            list: "{{ url('/') }}",
            save: "{{ url('save_validasi') }}",
            uploadfiletmp : "{{ url('/upload-temp-file') }}",
            updateValidasi :  "{{ url('/update_validasi') }}",
            finish : "{{ url('/validasi/finish') }}"
        };
    </script>
    <script src="{{ asset('js/index.js') }}"></script>
@endsection
