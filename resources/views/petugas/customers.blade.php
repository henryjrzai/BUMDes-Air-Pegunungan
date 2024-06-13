@extends('layouts.petugas')

@section('title', 'Data Pelanggan')

@section('content')
    <div class="container-fluid">
        <div class="card px-4 py-5">
            <h2 class="m-auto mb-3 fw-bold text-center">Pelanggan BUMNDes Air Pegunungan</h2>
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
                        <th>Jenis Tarif Penggunaan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $customer['meter_id'] }}</td>
                            <td>{{ $customer['name'] }}</td>
                            <td>{{ $customer['address'] }}</td>
                            <td>{{ $customer['phone'] }}</td>
                            <td>{{ $customer['dusun'] }}</td>
                            <td>{{ $customer['rt_rw'] }}</td>
                            <td>{{ $customer['jenis_tarif'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">Data Pelanggan Tidak Ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-customers').DataTable();
        });
    </script>
@endpush
