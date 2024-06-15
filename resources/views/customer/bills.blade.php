@extends('layouts.landing')

@section('title', 'Tagihan')

@section('content')
    <section id="bill" class="container my-5">
        <h2 class="text-center fw-bold">Tagihan Anda Bulan Ini</h2>
        <div class="row mx-2">
            <div class="col-md-6 card m-auto">
                <div class="card-body">
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
                        <input type="text" class="form-control" id="usage_value" readonly name="usage_value" value="{{ $data->monthlyWaterUsageRecords->first() ? $data->monthlyWaterUsageRecords->first()->usage_value : 0 }}">
                        <span class="input-group-text" id="basic-addon2">M<sup>3</sup></span>
                    </div>
                    <label for="cost" class="form-label fw-bold">Total tagihan</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                        <input type="text" class="form-control" id="cost" readonly name="cost"
                            value="{{ $data->bills->first() ? $data->bills->first()->billing_costs : 0}}">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-success float-end"><i
                                class="fa-solid fa-hand-holding-dollar me-2"></i>Bayar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="history-usage" class="container">
        <h2 class="text-center fw-bold mb-3">Riwayat Penggunaan</h2>
        <table class="table table-hover">
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
