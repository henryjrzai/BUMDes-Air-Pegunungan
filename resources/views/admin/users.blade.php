@extends('layouts.main')

@section('title', 'Pengguna')

@section('content')
    <div class="container-fluid">
        <div class="card p-5">
            <div class="card-body">
                <h2 class="m-auto mb-2 fw-bold text-center">Daftar Pengguna Aplikasi</h2>
                <button id="addUserToggle" type="modal" data-bs-toggle="modal" data-bs-target="#addUserModal"
                    class="btn btn-primary float-end"><i class="fa-solid fa-user-plus me-2"></i> Pengguna</button>
            </div>
            <div class="container-fluid overflow-auto">
                <table id="table-users" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Hak Akses</th>
                            <th>No Telp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addUserModalLabel">Data Pengguna</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                name="email" placeholder="example@mail.com">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="name" class="form-control" id="name" name="name"
                                placeholder="xxxxx xxxxx">
                        </div>
                        <div class="mb-3" id="inputPassword">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="********">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role/Hak Akses</label>
                            <select class="form-select" id="role" aria-label="Default select example">
                                <option selected hidden>~ Pilih ~</option>
                                <option value="Administrator Sistem">Administrator Sistem</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Manajemen BUMDes">Manajemen BUMDes</option>
                                <option value="Petugas Pencatatan">Petugas Pencatatan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="address" class="form-control" id="address" name="address" placeholder="********">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">No Telp</label>
                            <input type="phone" class="form-control" id="phone" name="phone"
                                placeholder="08XXXXXXXXXX">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button id="save" type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        // Get all users
        $(document).ready(function() {
            $('#table-users').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/getAllUsers',
                    type: 'GET'
                },
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'role'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        "render": function(data, type, row) {
                            return `
						<button id="updateToggle" data-email=${row.email} type="modal" data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button>
						<button id="delete" data-email=${row.email} class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
					`;
                        }
                    }
                ],
            });
        });

        $(document).on('click', '#updateToggle', function() {
            $("#save").attr('id', 'update').text('Perbarui');
            $("#addUserModalLabel").text('Perbarui Data Pengguna');
			$('#inputPassword').addClass("d-none");
            let email = $(this).data('email');
            $.ajax({
                url: `/admin/userByEmail/${email}`,
                type: 'GET',
                cache: false,
                success: function(response) {
                    $('#email').val(response.data.email);
                    $('#name').val(response.data.name);
                    $('#role').val(response.data.role);
                    $('#address').val(response.data.address);
                    $('#phone').val(response.data.phone);
                },
                Error: function(error) {
                    console.log(error);
                }
            });
        });

        $(document).on('click', '#addUserToggle', function() {
            $("#update").attr('id', 'save').text('Simpan');
            $("#addUserModalLabel").text('Data Pengguna');
			$('#inputPassword').addClass("d-block");
            cleanInput();
        });

        $(document).on('click', '#delete', function() {
            let email = $(this).data('email');
            let token = $("meta[name='csrf-token']").attr("content");
            console.log(email);
            console.log(token);

            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "ingin menghapus pengguna ini!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'TIDAK',
                confirmButtonText: 'YA, HAPUS!'
            }).then((result) => {
                if (result.isConfirmed) {
                    //fetch to delete data
                    $.ajax({
                        url: `/admin/deleteusers/${email}`,
                        type: "DELETE",
                        cache: false,
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: "DELETE"
                        },
                        success: function(response) {

                            //show success message
                            Swal.fire({
                                type: 'success',
                                icon: 'success',
                                title: `${response.message}`,
                                showConfirmButton: false,
                                timer: 3000
                            });
                            console.log(response.success);

                            //remove post on table
                            $('#table-users').DataTable().ajax.reload();
                        },
                        Error: function(error) {
                            console.log(error);
                        }
                    });
                }
            })
        });

        $(document).on('click', '#save', function() {
            let email = $('#email').val();
            let name = $('#name').val();
            let password = $('#password').val();
            let role = $('#role').val();
            let address = $('#address').val();
            let phone = $('#phone').val();
            console.log(email);

            $.ajax({
                url: '/admin/adduser',
                type: 'POST',
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "POST",
                    email: email,
                    name: name,
                    password: password,
                    role: role,
                    address: address,
                    phone: phone
                },
                success: function(response) {
                    //show success message
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    console.log(response.success);

                    //remove post on table
                    $('#table-users').DataTable().ajax.reload();
                    $('#addUserModal').modal('hide');
                    cleanInput();
                },
                Error: function(error) {
                    console.log(error);
                }
            });
        });

        $(document).on('click', '#update', function() {
            let email = $('#email').val();
            let name = $('#name').val();
            let password = $('#password').val();
            let role = $('#role').val();
            let address = $('#address').val();
            let phone = $('#phone').val();
            console.log(email);

            $.ajax({
                url: `/admin/updateuser/${email}`,
                type: 'POST',
                cache: false,
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "PUT",
                    email: email,
                    name: name,
                    role: role,
                    address: address,
                    phone: phone
                },
                success: function(response) {
                    //show success message
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    //reload table
                    $('#table-users').DataTable().ajax.reload();
                    $('#addUserModal').modal('hide');
                    cleanInput();
                },
                error: function(error) {
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: 'Terjadi kesalahan!',
                        text: error.responseText,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });
        });


        function cleanInput() {
            $('#email').val('');
            $('#name').val('');
            $('#password').val('');
            $('#role').val('');
            $('#address').val('');
            $('#phone').val('');
        }
    </script>
@endpush
