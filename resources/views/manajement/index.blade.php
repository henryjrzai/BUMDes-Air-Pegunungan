@extends('layouts.manajement')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
	<!--  Row 1 -->
	<div class="row">
		<div class="col-lg-8 d-flex align-items-strech">
			<div class="card w-100">
				<div class="card-body">
					<div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
						<div class="mb-3 mb-sm-0">
							<h5 class="card-title fw-semibold">Pendapatan Tahun Ini</h5>
						</div>
					</div>
					<div id="chart"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="row">
				<div class="col-lg-12">
					<!-- Yearly Breakup -->
					<div class="card overflow-hidden">
						<div class="card-body p-4">
							<h5 class="card-title mb-9 fw-semibold">Jumlah Pengguna Dashboard</h5>
							<div class="row align-items-center">
								<div class="col-8">
									<h4 class="fw-semibold mb-3" id="userCount"></h4>
								</div>
								<div class="col-4">
									<div class="d-flex justify-content-center">
										<div id="breakup"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<!-- Monthly Earnings -->
					<div class="card">
						<div class="card-body">
							<div class="row alig n-items-start">
								<div class="col-8">
									<h5 class="card-title mb-9 fw-semibold"> Pendapatan Bulan Ini </h5>
									<h4 class="fw-semibold mb-3" id="earning"></h4>
								</div>
								<div class="col-4">
									<div class="d-flex justify-content-end">
										<div
											class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
											<i class="ti ti-currency-dollar fs-6"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="earning"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4 d-flex align-items-stretch">
			<div class="card w-100">
				<div class="card-body p-4">
					<div class="mb-4">
						<h5 class="card-title fw-semibold">Transaksi Terakhir</h5>
					</div>
					<ul class="timeline-widget mb-0 position-relative mb-n5">
						@foreach ($last_transactions as $transaction)
							<li class="timeline-item d-flex position-relative overflow-hidden">
								<div class="timeline-time text-dark flex-shrink-0 text-end">
									{{ \Carbon\Carbon::parse($transaction->date)->format('H:i') }}</div>
								<div class="timeline-badge-wrap d-flex flex-column align-items-center">
									<span
										class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
									<span class="timeline-badge-border d-block flex-shrink-0"></span>
								</div>
								<div class="timeline-desc fs-3 text-dark mt-n1">Pembayaran diterima dari
									<b>{{ $transaction->name }}</b>
									sejumlah {{ "Rp " . number_format($transaction->cost, 0, ',', '.') }}
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-8 d-flex align-items-stretch">
			<div class="card w-100">
				<div class="card-body p-4">
					<h5 class="card-title fw-semibold mb-4">Pelanggan pemakai air terbanyak</h5>
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
												<p class="mb-0 fw-normal text-center">{{ $customer->usage }}
													M<sup>3</sup></p>
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
	</div>
</div>
@endsection

@push('scripts')
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/js/dashboard-manajement.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
@endpush
