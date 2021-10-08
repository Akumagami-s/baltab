@extends('layouts/main')

@section('content')
<div class="row">
	<div class="col-xs-12 col-md-8 col-md-push-2">
		<div class="card">
			<div class="card-body">
				<h2 class="text-primary">Kalkulasi Tabungan</h2>
				<div class="row">
					<div class="col-xs-12">
						<h4>{{ $data['nama'] }}/{{ $data['nrp'] }}</h4>
						<div class="alert alert-danger">
							Tanggal pengangkatan kosong.
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection