$(document).ready(function () {
    // datatable
    var table = $('#datatable_1').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: window.routes.list,
            type: 'GET'
        },
        columns: [{
            data: 'username',
            name: 'username'
        },
        {
            data: 'role_label',
            name: 'role_label'
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

    //TOGLE PASSWORD
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');

        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';

        // Ganti ikon
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });

    document.getElementById('togglePassword_edit').addEventListener('click', function () {
        const passwordInput = document.getElementById('password_edit');
        const icon = this.querySelector('i');

        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';

        // Ganti ikon
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });

    // FUNCTION SAVE
    $('#myForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        let username = formData.get('username');
        let email = formData.get('email');

        // Validasi username tidak boleh pakai spasi
        if (/\s/.test(username)) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Username tidak boleh mengandung spasi!'
            });
            return;
        }

        // Cek email dan username ke server untuk memastikan unik
        $.ajax({
            url: window.routes.checkuser, // Buat endpoint ini
            method: 'POST',
            data: {
                email: email,
                username: username
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                if (res.exists) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: res.message
                    });
                } else {
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
                }
            }
        });
    });

    //FUNCTION GET DATA EDIT
    $(document).on('click', '.btn-edit', function () {
        const id = $(this).data('id');
        const url = `${window.routes.edit}/${id}`;
        Swal.fire({
            title: 'Mengambil data...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            }
        });

        $.ajax({
            url: url,
            method: 'GET',
            success: function (res) {
                Swal.close();
                $('#myFormEdit input[name="id"]').val(id);
                $('#myFormEdit input[name="username"]').val(res.username);
                $('#myFormEdit input[name="email"]').val(res.email);
                $('#role_edit').val(res.role);
                // console.log('Role:', res.role);

                $('#myFormEdit input[name="password"]').val('');

                $('#exampleModalEdit').modal('show');
            },
            error: function () {
                alert('Gagal mengambil data user.');
            }
        });
    });

    //FUNCTION UPDATE
    $('#myFormEdit').submit(function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = form.serialize();

        $.ajax({
            url: window.routes.update,
            method: 'POST',
            data: formData,
            success: function (res) {
                Swal.fire({
                    title: 'Menyimpan...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
                // alert(res.message);
                $('#exampleModalEdit').modal('hide');
                $('#datatable_1').DataTable().ajax.reload(null,
                    false);
                Swal.close(); // tutup loading
                setTimeout(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: res.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }, 100); // kasih jeda sedikit setelah Swal.close()
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors;
                let msg = Object.values(errors).map(e => e).join('\n');
                alert('Error:\n' + msg);
            }
        });
    });


    $(document).on('click', '.btn-delete', function () {
        const id = $(this).data('id');
        const url = `${window.routes.delete}/${id}`;
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data yang dihapus tidak bisa dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (res) {
                        Swal.fire('Berhasil!', res.message, 'success');
                        $('#datatable_1').DataTable().ajax.reload();
                    },
                    error: function (xhr) {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus.',
                            'error');
                    }
                });
            }
        });
    });


});
