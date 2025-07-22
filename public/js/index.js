$(document).ready(function () {
    Swal.fire({
        title: 'Memuat data...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Tutup SweetAlert saat data selesai dimuat
    $('#datatable_1').on('xhr.dt', function () {
        Swal.close();
    });
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
            render: function (data, type, row, meta) {
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
        { data: 'formatted_total_1', name: 'formatted_total_1' },
        { data: 'formatted_total_2', name: 'formatted_total_2' },
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


    $('#myForm').on('submit', function (e) {
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
            success: function (res) {
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
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: xhr.responseJSON.message
                });
            }
        });
    });

});

function uploadFile(input, id, tipe) {
    let formData = new FormData();
    formData.append('file', input.files[0]);
    formData.append('tipe', tipe);
    formData.append('id', id);

    Swal.fire({
        title: 'Uploading ' + tipe + '...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: window.routes.uploadfiletmp,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            Swal.fire({
                icon: 'success',
                title: 'Upload Berhasil',
                text: `File: ${res.filename}\nJumlah Data: ${res.jumlah_data}\nTotal: ${res.total}`,
                timer: 3000,
                showConfirmButton: false
            });

            // Reload DataTable (ganti #tabel-validasi dengan ID tabel kamu)
            $('#datatable_1').DataTable().ajax.reload(null, false);
        },
        error: function (err) {
            Swal.fire({
                icon: 'error',
                title: 'Upload Gagal',
                text: 'Pastikan file valid dan sesuai format.',
            });
            console.error('Upload error:', err);
        }
    });
}

function submitValidate(id) {
    Swal.fire({
        title: 'Memproses Validasi...',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    $.ajax({
        url: window.routes.updateValidasi,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id
        },
        success: function (res) {
            Swal.fire({
                icon: 'success',
                title: 'Validasi Berhasil',
                html: `Perbedaan: ${res.total_perbedaan}<br>Total File 1: ${res.total_file1}<br>Total File 2: ${res.total_file2}`,
                timer: 3000,
                showConfirmButton: false
            });
            $('#datatable_1').DataTable().ajax.reload(null, false);
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                text: 'Terjadi kesalahan saat validasi.'
            });
        }
    });
}

function submitFinish(id) {
    Swal.fire({
        title: 'Yakin selesai dan hapus data ini?',
        text: 'Data validasi dan file akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: window.routes.finish,
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: id
                },
                success: function (res) {
                    Swal.fire('Berhasil', res.message, 'success');
                    $('#datatable_1').DataTable().ajax.reload(null, false);
                },
                error: function () {
                    Swal.fire('Gagal', 'Gagal menghapus data.', 'error');
                }
            });
        }
    });
}

