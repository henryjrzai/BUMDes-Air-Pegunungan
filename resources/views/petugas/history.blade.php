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

@section('title', 'Riwayat Penggunaan Pelanggan')

@section('content')
    <div class="container-fluid">
        <div class="card px-3 py-4">
            <h3 class="text-center mb-4">Penggunaan Air Pelanggan Bulan {{ $monthNow }} </h3>
            <div class="overflow-auto">
                <button id="report" class="btn btn-success float-end"><i class="fa-solid fa-file-arrow-down me-2"></i>Unduh Laporan</button>
                <table id="table-history" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Meter</th>
                            <th>Nama</th>
                            <th>Dusun</th>
                            <th>RT/RW</th>
                            <th>Jumlah Penggunaan</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $record['meter_id'] }}</td>
                                <td>{{ $record['name'] }}</td>
                                <td>{{ $record['dusun'] }}</td>
                                <td>{{ $record['rt'] }}/{{ $record['rw'] }}</td>
                                <td>{{ $record['latest_monthly_water_usage_record']['usage_value'] }} M<sup>3</td>
                                <td>
                                    <button type="button"
                                        data-idrecord="{{ $record['latest_monthly_water_usage_record']['id'] }}"
                                        id="detail" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#detailModal">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailModalLabel">Detail Penggunaan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="record-picture" src="" alt="" class="w-50 h-50">
                    <div class="mt-2">
                        <label for="initial_use" class="form-label">Penggunaan bulan lalu</label>
                        <div class="input-group mb-3">
                            <input type="number" id="initial_use" readonly class="form-control"
                                aria-describedby="initial_use">
                            <span class="input-group-text">M<sup>3</sup></span>
                        </div>
                        <label for="last_use" class="form-label">Penggunaan terakhir saat di rekam</label>
                        <div class="input-group mb-3">
                            <input type="number" id="last_use" readonly class="form-control" aria-describedby="last_use">
                            <span class="input-group-text">M<sup>3</sup></span>
                        </div>
                        <label for="usage_value" class="form-label">Total penggunaan</label>
                        <div class="input-group mb-3">
                            <input type="number" id="usage_value" readonly class="form-control"
                                aria-describedby="usage_value">
                            <span class="input-group-text">M<sup>3</sup></span>
                        </div>
                        <div class="mb-3">
                            <label for="petugas" class="form-label">Petugas perekam</label>
                            <input type="text" class="form-control" readonly id="petugas">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-history').DataTable();
        });

        $('#detailModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var idRecord = button.data('idrecord');
            var modal = $(this);

            $.ajax({
                url: `/petugas/getWaterUsageHistory/${idRecord}`,
                method: 'GET',
                success: function(response) {
                    modal.find('#initial_use').val(response.initial_use);
                    modal.find('#last_use').val(response.last_use);
                    modal.find('#usage_value').val(response.usage_value);
                    modal.find('#petugas').val(response.user.name);
                    // modal.find('#record-picture').attr('src', "{{ asset('assets/images/record/') }}" + response.url);
                    modal.find('#record-picture').attr('src', "../images/record/" + response.url);
                }
            });
        });

        $('#report').click(function() {
            window.location.href = '/petugas/report';
        });
    </script>
@endpush
