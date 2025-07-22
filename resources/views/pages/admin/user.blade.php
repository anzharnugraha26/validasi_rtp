@extends('layouts.master')
@section('pages_name')
    User Account
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="main-content-container overflow-hidden">
        @include('layouts.page_header', ['title' => 'USER ACCOUNT'])
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
                                    <th>Username</th>
                                    <th>Grup Role</th>
                                    <th>Control</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">USER ACCOUNT</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 p-4">
                                <div class="form-group">
                                    <label for="">USERNAME</label>
                                    <input type="text" class="form-control mt-2" name="username" id=""
                                        placeholder="Masukan Username" required>
                                </div>
                            </div>
                            <div class="col-md-12 p-4">
                                <div class="form-group">
                                    <label for="">EMAIL</label>
                                    <input type="text" class="form-control mt-2" name="email" id=""
                                        placeholder="Masukan Email" required>
                                </div>
                            </div>
                            <div class="col-md-12 p-4">
                                <div class="form-group">
                                    <label for="">GROUP ROLE</label>
                                    <select name="role" class="form-control form-select mt-2" id="" required>
                                        <option value="">-- PILIH ROLE --</option>
                                        <option value="1">Admin</option>
                                        <option value="0">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 p-4">
                                <div class="form-group">
                                    <label for="">PASSWORD</label>
                                    <div class="input-group mt-2">
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Masukan Password" id="password" required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
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
    <div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="myFormEdit">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">USER ACCOUNT</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 p-4">
                                <div class="form-group">
                                    <label for="">USERNAME</label>
                                    <input type="hidden" name="id" id="id">
                                    <input type="text" class="form-control mt-2" name="username" id=""
                                        placeholder="Masukan Username" required>
                                </div>
                            </div>
                            <div class="col-md-12 p-4">
                                <div class="form-group">
                                    <label for="">EMAIL</label>
                                    <input type="text" class="form-control mt-2" name="email" id=""
                                        placeholder="Masukan Email" required>
                                </div>
                            </div>
                            <div class="col-md-12 p-4">
                                <div class="form-group">
                                    <label for="">GROUP ROLE</label>
                                    <select name="role" class="form-control form-select mt-2" id="role_edit" required>
                                        <option value="">-- PILIH ROLE --</option>
                                        <option value="1">Admin</option>
                                        <option value="0">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 p-4">
                                <div class="form-group">
                                    <label for="">PASSWORD <small class="text-danger">*kosongkan apabila tidak ada
                                            perubahan password</small></label>
                                    <div class="input-group mt-2">
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Masukan Password" id="password_edit">
                                        <button class="btn btn-outline-secondary" type="button"
                                            id="togglePassword_edit">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
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
            list: "{{ url('/user_account') }}",
            save: "{{ url('/user_account/save') }}",
            checkuser: "{{ url('user_account/cek') }}",
            edit: "{{ url('user_account/show/') }}",
            update: "{{ url('user_account/update') }}",
            delete: "{{ url('user_account/delete/') }}"
        };
    </script>
    <script src="{{ asset('js/user.js') }}"></script>
@endsection
