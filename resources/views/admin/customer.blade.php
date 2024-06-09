@extends('layouts.main')

@section('title', 'Data Pelanggan')

@section('content')
    <div class="container-fluid">
        <div class="card px-2 py-3">
            <div class="card-body">
                <h2 class="m-auto mb-2 fw-bold text-center">Pelanggan BUMNDes Air Pegunungan</h2>
                <button id="addUserToggle" type="modal" data-bs-toggle="modal" data-bs-target="#addCustomerModal"
                    class="btn btn-primary float-end"><i class="fa-solid fa-user-plus me-2"></i> Pelanggan Baru</button>
            </div>
            <div class="container-fluid overflow-auto">
                <table id="table-customers" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Meter</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th>Dusun</th>
                            <th>RT/RW</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addCustomerModalLabel">Data Pelanggan Baru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="meterId" class="form-label">Id Meter</label>
                            <input type="number" class="form-control" id="meterId" name="meter_id"
                                placeholder="1561131551">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="xxxxx xxxxx">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="********">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">No Telp</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="08XXXXXXXXXX">
                        </div>
                        <div class="mb-3">
                            <label for="dusun" class="form-label">Dusun</label>
                            <select class="form-select" id="dusun" aria-label="Default select example">
                                <option selected hidden>~ Pilih Dusun ~</option>
                                <option value="Dusun 1">Dusun 1</option>
                                <option value="Dusun 2">Dusun 2</option>
                                <option value="Dusun 3">Dusun 3</option>
                                <option value="Dusun 4">Dusun 4</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="rt" class="form-label">RT</label>
                            <select class="form-select" id="rt" aria-label="Default select example">
                                <option selected hidden>~ Pilih RT ~</option>
                                <option value="RT 1">RT 1</option>
                                <option value="RT 2">RT 2</option>
                                <option value="RT 3">RT 3</option>
                                <option value="RT 4">RT 4</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="rw" class="form-label">RW</label>
                            <select class="form-select" id="rw" aria-label="Default select example">
                                <option selected hidden>~ Pilih RW ~</option>
                                <option value="RW 1">RW 1</option>
                                <option value="RW 2">RW 2</option>
                                <option value="RW 3">RW 3</option>
                                <option value="RW 4">RW 4</option>
                            </select>
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
            $('#table-customers').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('getAllCustomers') }}',
                    type: 'GET'
                },
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'meter_id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'address'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'dusun'
                    },
                    {
                        data: 'rt_rw'
                    },
                    {
                        "render": function(data, type, row) {
                            return `
						<button id="updateToggle" data-meter=${row.meter_id} type="modal" data-bs-toggle="modal" data-bs-target="#addCustomerModal" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button>
						<button id="delete" data-meter=${row.meter_id} class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
					`;
                        }
                    }
                ],
            });
        });

        $('#addUserToggle').click(function() {
            $("#update").attr('id', 'save').text('Simpan');
            $("#addCustomerModalLabel").text('Data Pelanggan Baru');
            cleanInput();
        })

        // Create a new user
        $('#save').click(function() {
            let meterId = $('#meterId').val();
            let name = $('#name').val();
            let address = $('#address').val();
            let phone = $('#phone').val();
            let dusun = $('#dusun').val();
            let rt = $('#rt').val();
            let rw = $('#rw').val();

            $.ajax({
                url: '{{ route('createCustomer') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: "POST",
                    meter_id: meterId,
                    name: name,
                    address: address,
                    phone: phone,
                    dusun: dusun,
                    rt: rt,
                    rw: rw
                },
                success: function(response) {
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $('#addCustomerModal').modal('hide');
                    $('#table-customers').DataTable().ajax.reload();
                    console.log(url);
                    cleanInput();
                },
                error: function(response) {
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: `${response.responseJSON.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });
        });

        // Update modal to edit user & get user data by meter id
        $(document).on('click', '#updateToggle', function() {
            $("#save").attr('id', 'update').text('Perbarui');
            $("#addCustomerModalLabel").text('Perbarui Data Pelangggan');
            let meterId = $(this).data('meter');
            $.ajax({
                url: `/admin/getCustomer/${meterId}`,
                type: 'GET',
                cache: false,
                success: function(response) {
                    console.log(response);
                    $('#meterId').val(response.meter_id);
                    $('#name').val(response.name);
                    $('#address').val(response.address);
                    $('#phone').val(response.phone);
                    $('#dusun').val(response.dusun);
                    $('#rt').val(response.rt);
                    $('#rw').val(response.rw);
                },
                error: function(response) {
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: `${response.responseJSON.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });
        })

        $(document).on('click', '#update', function() {
            let meterId = $('#meterId').val();
            let name = $('#name').val();
            let address = $('#address').val();
            let phone = $('#phone').val();
            let dusun = $('#dusun').val();
            let rt = $('#rt').val();
            let rw = $('#rw').val();

            $.ajax({
                url: `/admin/updateCustomer/${meterId}`,
                type: 'POST',
                cache: false,
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "PUT",
                    name: name,
                    address: address,
                    phone: phone,
                    dusun: dusun,
                    rt: rt,
                    rw: rw
                },
                success: function(response) {
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $('#addCustomerModal').modal('hide');
                    $('#table-customers').DataTable().ajax.reload();
                    cleanInput();
                },
                error: function(response) {
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: `${response.responseJSON.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    console.log(response);
                }
            });
        });

        // Delete customer by meter id
        $(document).on('click', '#delete', function(){
            let meterId = $(this).data('meter');
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/customer/${meterId}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire({
                                type: 'success',
                                icon: 'success',
                                title: `${response.message}`,
                                showConfirmButton: false,
                                timer: 3000
                            });
                            $('#table-customers').DataTable().ajax.reload();
                        },
                        error: function(response) {
                            Swal.fire({
                                type: 'error',
                                icon: 'error',
                                title: `${response.responseJSON.message}`,
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    });
                }
            });

        })

        function cleanInput() {
            $('#meterId').val('');
            $('#name').val('');
            $('#address').val('');
            $('#phone').val('');
            $('#dusun').val('');
            $('#rt').val('');
            $('#rw').val('');
        }
    </script>
@endpush
