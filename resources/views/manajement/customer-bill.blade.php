@extends('layouts.manajement')

@section('title', 'Tagihan Pelanggan')

@php
    \Carbon\Carbon::setLocale('id');
    $monthName = \Carbon\Carbon::now()->translatedFormat('F');
@endphp

@section('content')
    <div class="container-fluid">
        <div class="card px-3 py-4">
            <h3 class="text-center mb-4">Tagihan Air Pelanggan Bulan {{ $monthName }} </h3>
            <div class="overflow-auto">
                <button id="report" class="btn btn-success float-end"><i class="fa-solid fa-file-arrow-down me-2"></i>Unduh
                    Laporan</button>
                <table id="table-history" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pel/Meter</th>
                            <th>Nama</th>
                            <th>No Telp</th>
                            <th>Dusun</th>
                            <th>Tagihan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bills as $bill)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bill->meter }}</td>
                                <td>{{ $bill->name }}</td>
                                <td>{{ $bill->phone }}</td>
                                <td>{{ $bill->dusun }}</td>
                                <td>{{ 'Rp ' . number_format($bill->cost, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <span
                                        class="badge {{ $bill->status == 'paid' ? 'bg-success' : 'bg-danger' }}">{{ $bill->status == 'paid' ? 'LUNAS' : 'BELUM BAYAR' }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-history').DataTable();
        })
        $('#report').click(function() {
            window.location.href = '/manajement/bill-report';
        });
    </script>
@endpush
