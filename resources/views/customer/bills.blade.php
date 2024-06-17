@extends('layouts.landing')

@section('head-scripts')
@endsection

@section('title', 'Tagihan')

@section('content')
    <section id="bill" class="container my-5">
        <h2 class="text-center fw-bold">Tagihan Anda Bulan Ini</h2>
        <div class="row mx-2">
            <div class="col-md-6 card m-auto">
                <div class="card-body">
                    @if ($data->count() == 0)
                        <div class="alert alert-primary" role="alert">
                            <h4 class="alert-heading">Data tidak ditemukan</h4>
                            <p>harap periksa kembali ID Pelanggan/Meter anda</p>
                        </div>
                    @else
                        @if ($data->bills->first()->status == 'paid')
                            <h1 class="text-center">Tagihan Bulan ini sudah dibayarkan 🤝</h1>
                        @else
                            <div class="mb-3">
                                <label for="meter-id" class="form-label fw-bold">ID Pelanggan/Meter</label>
                                <input type="text" class="form-control" id="meter-id" readonly name="meter_id"
                                    value="{{ $data->meter_id }}">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Nama Pelanggan</label>
                                <input type="text" class="form-control" id="name" readonly name="name"
                                    value="{{ $data->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label fw-bold">Kategori Pelanggan</label>
                                <input type="text" class="form-control" id="category" readonly name="category"
                                    value="{{ $data->waterTarif->tariff_name }}">
                            </div>
                            <label for="usage_value" class="form-label fw-bold">Penggunaan bulan ini</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="usage_value" readonly name="usage_value"
                                    value="{{ $data->monthlyWaterUsageRecords->first() ? $data->monthlyWaterUsageRecords->first()->usage_value : 0 }}">
                                <span class="input-group-text" id="basic-addon2">M<sup>3</sup></span>
                            </div>
                            <label for="cost" class="form-label fw-bold">Total tagihan</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                <input type="text" class="form-control" id="cost" readonly name="cost"
                                    value="{{ $data->bills->first() ? $data->bills->first()->billing_costs : 0 }}">
                            </div>
                            <div class="mb-3">
                                <input id="bill_id" type="number" name="bill_id"
                                    value="{{ $data->bills->first() ? $data->bills->first()->id : 0 }}" hidden>
                                <button id="pay" class="btn btn-success float-end"><i
                                        class="fa-solid fa-hand-holding-dollar me-2"></i>Bayar</button>
                            </div>
                        @endif

                    @endif
                </div>
            </div>
        </div>
    </section>

    <section id="history-usage" class="container">
        <h2 class="text-center fw-bold mb-3">Riwayat Penggunaan</h2>
        <table class="table table-hover overflow-auto">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Penggunaan Awal</th>
                    <th>Penggunaan Akhir</th>
                    <th>Total Penggunaan</th>
                </tr>
            </thead>
            <tbody>
                @if ($count <= 0)
                    <tr>
                        <td colspan="5" class="text-center">Data penggunaan belum ada</td>
                    </tr>
                @else
                    @foreach ($historys->monthlyWaterUsageRecords as $history)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $history->created_at->format('d-m-Y') }}</td>
                            <td>{{ $history->initial_use }} M<sup>3</sup></td>
                            <td>{{ $history->last_use }} M<sup>3</sup></td>
                            <td>{{ $history->usage_value }} M<sup>3</sup></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </section>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        $('#pay').click(function(event) {
            console.log('pay clicked');
            event.preventDefault();

            $.ajax({
                url: '{{ route('pay') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: "POST",
                    name: $('#name').val(),
                    cost: $('#cost').val(),
                    bill: $('#bill_id').val()
                },
                success: function(response) {
                    console.log(response);
                    popUpPayment(response.snap_token);
                },
                error: function(response) {
                    console.log(response);
                }
            })
        });

        function popUpPayment($token) {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay($token, {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    let bill_id = $('#bill_id').val();
                    $.ajax({
                        url: `/pay-callback/${bill_id}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: "PUT",
                        },
                    })
                    Swal.fire({
                        title: 'Yaay! 🎉',
                        text: 'Pembayaran berhasil!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    // alert("payment success!");
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        }
    </script>
@endpush
