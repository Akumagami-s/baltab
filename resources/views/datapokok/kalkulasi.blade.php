@extends('layouts/main')

@section('content')
<div class="row">
	<div class="col-xs-12 col-md-8 col-md-push-2">
		<div class="card">
			<div class="card-body">
				<button class="btn btn-lg btn-warning pull-right">
					<i class="fa fa-print"></i>
				</button>
				<h2 class="text-primary">Kalkulasi Tabungan</h2>
				<div class="row">
					<div class="col-xs-12">
						<h4>{{ $data['nama'] }}/{{ $data['nrp'] }}</h4>
						<table class="table">
							@foreach($potongans as $potongan)
								<tr>
									<td>{{ $potongan['keterangan'] }}</td>
									<td>{{ $potongan['period'] }}</td>
									<td class="text-right">{{ $potongan['bulan'] }} Bulan x</td>
									<td class="text-right">{{ $potongan['nilai'] }}</td>
									<td class="text-right is-rupiah">Rp {{ $potongan['nilai_akhir'] }}</td>
								</tr>
							@endforeach
							<tr class="active">
								<td colspan="2">								
									<strong>{{ $periode_potongan }}</strong>
								</td>
								<td class="text-right">
									<strong>{{ $bulan_potongan }} Bulan</strong>
								</td>
								<td></td>
								<td class="text-right is-rupiah">
									<strong>Rp {{ $pokok_potongan }}</strong>
								</td>
							</tr>
							<tr class="active">
								<td colspan="4">
									<strong>Bunga</strong>
								</td>
								<td class="text-right is-rupiah">
									<strong>Rp {{ $bunga_potongan }}</strong>
								</td>
							</tr>
							<tr class="warning">
								<td colspan="4">
									<strong>Total</strong>
								</td>
								<td class="text-right is-rupiah">
									<strong>Rp {{ $total_potongan }}</strong>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection