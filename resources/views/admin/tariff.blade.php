@extends('layouts.main')

@section('title', 'Тarif Biaya')

@section('content')
    <div class="container-fluid">
        <div class="card px-2 py-3">
            <div class="card-body">
                <h2 class="m-auto mb-2 fw-bold text-center">Data Tarif Air</h2>
                <button id="addUserToggle" type="modal" data-bs-toggle="modal" data-bs-target="#addTariffModal"
                    class="btn btn-primary float-end"><i class="fa-solid fa-user-plus me-2"></i> Tarif Biaya Baru</button>
            </div>
            <div class="container-fluid overflow-auto">
                <table id="table-tariff" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelompok Pelanggan</th>
                            <th>Kategory</th>
                            <th>0 - 3 M<sup>3</sup></th>
                            <th>> 3 - 10 M<sup>3</sup></th>
                            <th>>10 - 20 M<sup>3</sup></th>
                            <th>>20 M<sup>3</sup></th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addTariffModal" tabindex="-1" aria-labelledby="addTariffModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addTariffModalLabel">Data Tarif Baru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tariff_name" class="form-label">Kelompok Pelanggan</label>
                            <input type="text" class="form-control" id="tariff_name" name="tariff_name"
                                placeholder="Rumah Tangga">
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategory</label>
                            <select class="form-select" id="category" aria-label="Default select example">
                                <option selected hidden>~ Pilih Kategori ~</option>
                                <option value="I">I</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                                <option value="III A">III A</option>
                                <option value="III B">III B</option>
                                <option value="IV">IV</option>
                                <option value="IV A">IV A</option>
                                <option value="IV B">IV B</option>
                                <option value="V Khusus">V Khusus</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="0_3_M3" class="form-label">0-3 M<sup>3</sup></label>
                            <input type="number" class="form-control" id="0_3_M3" name="t0_3_M3" placeholder="1500">
                        </div>
                        <div class="mb-3">
                            <label for="__3_10_M3" class="form-label">>3-10 M<sup>3</sup></label>
                            <input type="number" class="form-control" id="__3_10_M3" name="t__3_10_M3" placeholder="2500">
                        </div>
                        <div class="mb-3">
                            <label for="__10_20_M3" class="form-label">>10-20 M<sup>3</sup></label>
                            <input type="number" class="form-control" id="__10_20_M3" name="t__10_20_M3"
                                placeholder="3500">
                        </div>
                        <div class="mb-3">
                            <label for="__20_M3" class="form-label">20 M<sup>3</sup></label>
                            <input type="text" class="form-control" id="__20_M3" name="t_20__M3" placeholder="4500">
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
        // Get All Tariff
        $(document).ready(function() {
            $('#table-tariff').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('getAllTariff') }}',
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'tariff_name'
                    },
                    {
                        data: 'tariff_category'
                    },
                    {
                        data: 't0_3_M3'
                    },
                    {
                        data: 't__3_10_M3'
                    },
                    {
                        data: 't__10_20_M3'
                    },
                    {
                        data: 't__20_M3'
                    },
                    {
                        "render": function(data, type, row) {
                            return `
				<button id="updateToggle" data-id=${row.id} type="modal" data-bs-toggle="modal" data-bs-target="#addTariffModal" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button>
				<button id="delete" data-id=${row.id} class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
			`;
                        }
                    }
                ]
            });
        });

        $('#addTariffToggle').click(function() {
            $("#update").attr('id', 'save').text('Simpan');
            $("#addTariffModalLabel").text('Data Tarif Baru');
            cleanInput();
        })

        // Create Tariff
        $('#save').click(function() {
            let tariff_name = $('#tariff_name').val();
            let tariff_category = $('#category').val();
            let t0_3_M3 = $('#0_3_M3').val();
            let t__3_10_M3 = $('#__3_10_M3').val();
            let t__10_20_M3 = $('#__10_20_M3').val();
            let t__20_M3 = $('#__20_M3').val();
            $.ajax({
                url: '{{ route('createTariff') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: "POST",
                    tariff_name: tariff_name,
                    tariff_category: tariff_category,
                    t0_3_M3: t0_3_M3,
                    t__3_10_M3: t__3_10_M3,
                    t__10_20_M3: t__10_20_M3,
                    t__20_M3: t__20_M3,
                },
                success: function(response) {
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $('#table-tariff').DataTable().ajax.reload();
                    $('#addtariffModal').modal('hide');
                    cleanInput();
                },
                error: function(response) {
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });
        });

        // update modal to edit tariff & get tariff data by id
        $(document).on('click', '#updateToggle', function() {
            $("#save").attr('id', 'update').text('Perbarui');
            $("#addTariffModalLabel").text('Perbarui Data Tarif');
            let id = $(this).data('id');
            $.ajax({
                url: `/admin/getTariff/${id}`,
                type: 'GET',
                cache: false,
                success: function(response) {
                    $('#tariff_name').val(response.tariff_name);
                    $('#category').val(response.tariff_category);
                    $('#0_3_M3').val(response.t0_3_M3);
                    $('#__3_10_M3').val(response.t__3_10_M3);
                    $('#__10_20_M3').val(response.t__10_20_M3);
                    $('#__20_M3').val(response.t__20_M3);

                },
                error: function(response) {
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });
        });

        // Update Tariff
        $('#update').click(function() {
            let tariff_name = $('#tariff_name').val();
            let tariff_category = $('#category').val();
            let t0_3_M3 = $('#0_3_M3').val();
            let t__3_10_M3 = $('#__3_10_M3').val();
            let t__10_20_M3 = $('#__10_20_M3').val();
            let t__20_M3 = $('#__20_M3').val();
            $.ajax({
                url: `/admin/updateTariff/${id}`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: "POST",
                    tariff_name: tariff_name,
                    tariff_category: tariff_category,
                    t0_3_M3: t0_3_M3,
                    t__3_10_M3: t__3_10_M3,
                    t__10_20_M3: t__10_20_M3,
                    t__20_M3: t__20_M3,
                },
                success: function(response) {
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $('#table-tariff').DataTable().ajax.reload();
                    $('#addTariffModal').modal('hide');
                    cleanInput();
                },
                error: function(response) {
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: `${response.message}`,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });
        });

        // Delete Tariff
        $(document).on('click', '#delete', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/tarif/${id}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: "DELETE"
                        },
                        success: function(response) {
                            Swal.fire({
                                type: 'success',
                                icon: 'success',
                                title: `${response.message}`,
                                showConfirmButton: false,
                                timer: 3000
                            });
                            $('#table-tariff').DataTable().ajax.reload();
                        },
                        error: function(response) {
                            Swal.fire({
                                type: 'error',
                                icon: 'error',
                                title: `${response.message}`,
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    });
                }
            });
        });


        function cleanInput() {
            $('#tariff_name').val('');
            $('#category').val('');
            $('#0_3_M3').val('');
            $('#__3_10_M3').val('');
            $('#__10_20_M3').val('');
            $('#__20_M3').val('');
        }
    </script>
@endpush
