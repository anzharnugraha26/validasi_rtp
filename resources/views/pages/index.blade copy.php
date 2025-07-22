@extends('layouts.master')
@section('pages_name')
    Validasi Data
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            count1: "{{ url('validasi/count_file_one') }}",
            count2: "{{ url('validasi/count_file_two') }}",
        };
    </script>
    <script>
        $(document).ready(function() {
            // datatable
            var table = $('#datatable_1').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: window.routes.list,
                    type: 'GET'
                },
                columns: [{
                        data: null,
                        name: 'no',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'client',
                        name: 'client'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'create_by',
                        name: 'create_by'
                    },
                    {
                        data: 'nama_file_1',
                        name: 'nama_file_1'
                    },
                    {
                        data: 'nama_file_2',
                        name: 'nama_file_2'
                    },
                    {
                        data: 'jumlah_data_1',
                        name: 'jumlah_data_1'
                    },
                    {
                        data: 'jumlah_data_2',
                        name: 'jumlah_data_2'
                    },
                    {
                        data: 'total_1',
                        name: 'total_1'
                    },
                    {
                        data: 'total_2',
                        name: 'total_2'
                    },
                    {
                        data: 'result',
                        name: 'result',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [],

            });

            //form Save
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#myForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                Swal.fire({
                    title: 'Menyimpan...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });


                // Lanjut submit form ke backend
                $.ajax({
                    url: window.routes.save,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        $('#exampleModal').modal('hide');
                        $('#myForm')[0].reset();
                        $('#datatable_1').DataTable().ajax.reload(null,
                            false);
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: xhr.responseJSON.message
                        });
                    }
                });
            });


            $(document).on('click', '.btn-validate', function() {
                let $form = $(this).closest('.update-form');
                let id = $(this).data('id');
                let file1 = $form.find('.file-input1')[0].files[0];
                let file2 = $form.find('.file-input2')[0].files[0];

                if (!file1 || !file2) {
                    Swal.fire('Oops', 'Silakan upload kedua file terlebih dahulu.', 'warning');
                    return;
                }

                let formData = new FormData();
                formData.append('file1', file1);
                formData.append('file2', file2);
                formData.append('id', id);

                Swal.fire({
                    title: 'Validasi data...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: '/update_validasi',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        Swal.close();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message,
                        });
                        $('#datatable_1').DataTable().ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: xhr.responseJSON.message ||
                                'Terjadi kesalahan saat memproses',
                        });
                    }
                });
            });




        });
    </script>
    <script>
        function countExcelFileOne(input, id) {
            let file = input.files[0];
            if (!file) return;

            let formData = new FormData();
            formData.append("file", file);
            formData.append("id", id);

            $.ajax({
                url: window.routes.count1,
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Menghitung data...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                },
                success: function(res) {
                    Swal.close();
                    Swal.fire('Sukses', `Jumlah data: ${res.jumlah}`, 'success');

                    let table = $('#datatable_1').DataTable();
                    let rowIndex = table.row(`[data-id="${id}"]`).index();
                    if (rowIndex === undefined) return;

                    let rowData = table.row(rowIndex).data();
                    rowData.jumlah_data_1 = res.jumlah;
                    rowData.total_1 = res.total;
                    table.row(rowIndex).data(rowData).draw(false);
                },
                error: function(xhr) {
                    Swal.fire('Error', xhr.responseJSON.message || 'Gagal menghitung data',
                        'error');
                }
            });
        }

        function countExcelFileTwo(input, id) {
            let file = input.files[0];
            if (!file) return;

            let formData = new FormData();
            formData.append("file", file);
            formData.append("id", id);

            $.ajax({
                url: window.routes.count2,
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Menghitung data...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                },
                success: function(res) {
                    Swal.close();
                    Swal.fire('Sukses', `Jumlah data: ${res.jumlah}`, 'success');

                    let table = $('#datatable_1').DataTable();
                    let rowIndex = table.row(`[data-id="${id}"]`).index();
                    if (rowIndex === undefined) return;

                    let rowData = table.row(rowIndex).data();
                    rowData.jumlah_data_2 = res.jumlah;
                    rowData.total_2 = res.total;
                    table.row(rowIndex).data(rowData).draw(false);
                },
                error: function(xhr) {
                    Swal.fire('Error', xhr.responseJSON.message || 'Gagal menghitung data',
                        'error');
                }
            });
        }
    </script>
@endsection
