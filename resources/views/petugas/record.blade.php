@php
    $month = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];
    $monthNow = $month[date('n')];
@endphp

@extends('layouts.petugas')

@section('title', 'Catat Penggunaan Air')

@section('content')
    <div class="container-fluid">
        <form id="uploadForm" action="{{ route('record-water') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card px-2 py-5">
                <h3 class="text-center mb-4">Catat Penggunaan Air Bulan {{ $monthNow }} </h3>
                <div class="row">
                    <input type="number" hidden class="form-control" id="customer_id" name="customer_id">
                    <input type="number" hidden class="form-control" id="water_tariff_id" name="water_tariff_id">
                    <input type="number" hidden class="form-control" id="petugas_id" name="user_id"
                        value="{{ auth()->user()->id }}">
                    <div class="col-md-6 px-4">
                        <label for="meter_id" class="form-label">Id Meteran Air</label>
                        <div class="input-group mb-3">
                            <input id="meter_id" type="number" class="form-control" aria-label="982311xxxx"
                                aria-describedby="search_customer">
                            <button class="btn btn-info" type="button" id="search_customer">Cari Pelanggan </button>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Pelanggan</label>
                            <input type="text" class="form-control" id="name" name="name" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="dusun" class="form-label">Dusun</label>
                            <input type="text" class="form-control" id="dusun" name="dusun" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="initial_use" class="form-label">RT/RW</label>
                            <input type="text" class="form-control" id="rtrw" name="rtrw" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="tariff_name" class="form-label">Jenis Pelanggan</label>
                            <input type="text" class="form-control" id="tariff_name" name="tariff_name" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 px-4">
                        <div class="mb-3">
                            <label for="initial_use" class="form-label">Nilai m<sup>3</sup> Penggunaan Sebelumnya</label>
                            <input type="number" class="form-control" disabled id="initial_use" placeholder="0" name="initial_use"
                                >
                        </div>
                        <div class="mb-3">
                            <label for="last_use" class="form-label">Nilai m<sup>3</sup> Saat ini</label>
                            <input type="number" class="form-control" id="last_use" placeholder="0" name="last_use">
                        </div>
                        <div class="mb-3">
                            <label for="meter_photo" class="form-label">Foto meteran saat ini</label>
                            <input class="form-control" type="file" id="formFile" accept=".jpg, .png" name="url">
                        </div>
                        <button id="save" type="submit" class="btn btn-primary float-end w-25 py-2"><i
                                class="fa-solid fa-floppy-disk me-2"></i>Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        /*
         * Function to get customer data by meter id
         * @param meter_id
         * @return customer data
         * @return error message if customer not found
         */
        $('#search_customer').click(function() {
            let meter_id = $('#meter_id').val();
            $.ajax({
                url: `/petugas/getCustomerByMeterId/${meter_id}`,
                type: 'GET',
                success: function(response) {
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Yeay, data pelanggan berhasil ditemukan!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $('#customer_id').val(response.id);
                    $('#water_tariff_id').val(response.water_tariff_id);
                    $('#name').val(response.name);
                    $('#address').val(response.address);
                    $('#dusun').val(response.dusun);
                    $('#rtrw').val(response.rt_rw);
                    $('#tariff_name').val(response.tariff);
                    if (response.last_used == "Belum ada data") {
                        $('#initial_use').val(0);
                    } else {
                        $('#initial_use').val(response.last_used);
                    }
                },
                error: function(response) {
                    $('#id').val('');
                    $('#name').val('');
                    $('#address').val('');
                    $('#dusun').val('');
                    $('#rtrw').val('');
                    $('#tariff_name').val('');
                    $('#initial_use').val('');
                    Swal.fire({
                        title: 'Gagal',
                        text: response.responseJSON.message,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
            });
        });

        $('#uploadForm').on('submit', function(e) {
            e.preventDefault();
            $('#initial_use').removeAttr('disabled');
            var formData = new FormData(this);
            if ($('#initial_use').val() > $('#last_use').val()) {
                Swal.fire({
                    title: 'Gagal',
                    text: 'Nilai m3 saat ini harus lebih besar dari nilai m3 sebelumnya!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 3000
                })
                return;
            } else {
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Data penggunaan air berhasil dicatat!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        $('#meter_id').val('');
                        $('#customer_id').val('');
                        $('#water_tariff_id').val('');
                        $('#name').val('');
                        $('#address').val('');
                        $('#dusun').val('');
                        $('#rtrw').val('');
                        $('#tariff_name').val('');
                        $('#initial_use').val('');
                        $('#last_use').val('');
                        $('#formFile').val('');
                        $('#initial_use').attr('disabled', true);
                    },
                    error: function(response) {
                        Swal.fire({
                            title: 'Gagal',
                            text: response.responseJSON.message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        $('#initial_use').attr('disabled', true);
                    }
                });
            }
        });
    </script>
@endpush
