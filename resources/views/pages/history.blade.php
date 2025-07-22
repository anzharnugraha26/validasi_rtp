@extends('layouts.master')
@section('pages_name')
    HISTORY
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
        @include('layouts.page_header', ['title' => 'HISTORY'])
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <form action="{{ url('log_download') }}" method="GET" target="_blank">
                    <div class="row">
                        <div class="col-md-3 mt-2">
                            <input type="text" class="form-control" placeholder="Client...." id="client_filter"
                                name="client">
                        </div>
                        <div class="col-md-3 mt-2">
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <div class="col-md-3 mt-2">
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                        <div class="col-md-3 mt-2">
                            <button type="button" class="btn btn-primary" id="filterBtn">Search</button>
                            <button type="submit" class="btn btn-success">Download</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">


                <div class="default-table-area ">
                    <div class="table-responsive">
                        <table class="table align-middle" id="datatable_1">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Klien</th>
                                    <th>Title</th>
                                    <th>Create By</th>
                                    <th>Sim id</th>
                                    <th>Parameter</th>
                                    <th>Data File 1</th>
                                    <th>Data File 2</th>

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

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.routes = {
            list: "{{ url('history') }}",

        };
    </script>
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Memuat data...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Tutup SweetAlert saat data selesai dimuat
            $('#datatable_1').on('xhr.dt', function() {
                Swal.close();
            });
            // datatable
            var table = $('#datatable_1').DataTable({
                searching: false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: window.routes.list,
                    data: function(d) {
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                        d.client_filter = $('#client_filter').val();
                    },
                    type: 'GET'
                },
                columns: [{
                        data: 'tanggal',
                        title: 'Tanggal'
                    },
                    {
                        data: 'waktu',
                        title: 'Waktu'
                    },
                    {
                        data: 'client',
                        title: 'Client'
                    },
                    {
                        data: 'title',
                        title: 'Judul Validasi'
                    },
                    {
                        data: 'create_by',
                        title: 'Dibuat Oleh'
                    },
                    {
                        data: 'sim_id',
                        title: 'SIMID_BPR'
                    },
                    {
                        data: 'parameter',
                        title: 'Kolom'
                    },
                    {
                        data: 'file1',
                        title: 'File 1'
                    },
                    {
                        data: 'file2',
                        title: 'File 2'
                    },
                ],
                order: [],

            });

            $('#filterBtn').on('click', function() {
                table.ajax.reload();
            });

            //form Save
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
@endsection
