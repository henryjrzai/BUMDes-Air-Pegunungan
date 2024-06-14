@extends('layouts.petugas')

@section('title', 'Dashboard Petugas')
@section('content')
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-8 d-flex align-items-strech">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Pelanggan pengguna air terbanyak</h5>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">No</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Nama Pelanggan</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Jenis Pelanggan</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Jumlah Pemakaian</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($records as $customer)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{ $customer->name }}</h6>
                                            <span class="fw-normal">No. Pel/Meter : {{ $customer->meter }}</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $customer->tariff }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <p class="mb-0 fw-normal text-center">{{ $customer->usage }} M<sup>3</sup></p>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Yearly Breakup -->
                        <div class="card overflow-hidden">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-9 fw-semibold text-center">Total pelanggan saya rekam</h5>
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h4 class="fw-semibold mb-3 text-center" id="customerRecorded"></h4>
                                        <div class="d-flex justify-content-center">
                                            <div id="breakup"></div>
                                            <canvas id="myChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {

            $.ajax({
                url: "{{ route('getChartData') }}",
                method: "GET",
                success: function(response) {
                    console.log(response.length)
                    $('#customerRecorded').text(`${response.length} Pelanggan`);
                    customerRecordedChart(response);
                }
            })

        });


        /**
         * This function generates a doughnut chart using Chart.js library.
         * The chart represents the count of customers grouped by their tariff.
         *
         * @param {Array} data - The array of customer data. Each element is an object with properties: 'usage', 'cost', 'tariff'
         */
        function customerRecordedChart(data) {
            const groupedData = data.reduce((acc, item) => {
                acc[item.tariff] = (acc[item.tariff] || 0) + 1;
                return acc;
            }, {});

            const labels = Object.keys(groupedData);
            const counts = Object.values(groupedData);

            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pelanggan',
                        data: counts,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 69, 75)',
                            'rgb(86, 362, 192)',
                            'rgb(96, 53, 365)',
                        ],
                        hoverOffset: 4
                    }]
                },
            });
        }
    </script>
@endpush
