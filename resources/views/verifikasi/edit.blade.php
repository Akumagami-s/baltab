@extends('layouts/main')

@section('header_script')
	<link href="{{ url('css/select2.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="{{ url('css/select2-bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
<div class="row">
	<div class="col-xs-12">
		@if(session('success'))
			<div class="alert alert-success">
				<strong>Success!</strong> {{ session('success') }}
			</div>
		@endif

		@if(session('error'))
			<div class="alert alert-danger">
				<strong>Failed!</strong> {{ session('error') }}
			</div>
		@endif

		<h2>Edit Data Verifikasi</h2>
		
		<form class="form" method="post" action="{{ url('verifikasi/update') }}">
			{{ csrf_field() }}

			<input type="hidden" name="_id" value="{{ $data['_id'] }}">
			<div class="card card-underline">
				<div class="card-head">
					<header>HR</header>
				</div>
				<div class="card-body">
					<input type="hidden" name="_id" value="{{ $data['_id'] }}">
					<div class="form-group">
						<input id="nrp" type="text" name="nrp" class="form-control" value="{{ $data['nrp'] }}">
						<label for="nrp">NRP</label>
					</div>
					<div class="form-group">
						<input id="nama" type="text" name="nama" class="form-control" value="{{ $data['nama'] }}">
						<label for="nama">Nama Prajurit</label>
					</div>
					<div class="form-group">
						<div class="pt-10">						
							{{ Form::select('pangkat', \App\Models\Pangkat::pluck('uraian','kode'), $data['pangkat'], ['class'=>'form-control is-select2','placeholder'=>'Pilih Pangkat']) }}
						</div>
						<label for="pangkat">Pangkat Prajurit</label>
					</div>
					<div class="form-group">
						<input id="tmt_abri" type="text" name="tmt_abri" class="form-control is-datepicker" placeholder="yyyy-mm-dd"  value="{{ $data['tmt_abri'] }}">
						<label for="tmt_abri">Tanggal Pengangkatan</label>
					</div>
					<div class="form-group">
						<div class="pt-10">
							{{ Form::select('corps', \App\Models\Corp::pluck('uraian','kode'), $data['corps'], ['class'=>'form-control is-select2','placeholder'=>'Pilih Corp']) }}
						</div>
						<label for="corps">Corp</label>
					</div>
					<div class="form-group">
						<div class="pt-10">
							{{ Form::select('kesatuan', \App\Models\Kesatuan::pluck('namsat','kosat'), $data['kesatuan'], ['class'=>'form-control is-select2','placeholder'=>'Pilih Kesatuan']) }}
						</div>
						<label for="kesatuan">Kesatuan</label>
					</div>
					<div class="form-group">
						<div class="pt-10">
							{{ Form::select('kd_ktm', \App\Models\Kotama::pluck('uraian','kode'), $data['kd_ktm'], ['class'=>'form-control is-select2','placeholder'=>'Pilih Kotama']) }}
						</div>
						<label for="kesatuan">Kotama</label>
					</div>
					<div class="form-group">
						<input id="tg_lahir" type="text" name="tg_lahir" class="form-control is-datepicker" placeholder="yyyy-mm-dd"  value="{{ $data['tg_lahir'] }}">
						<label for="tg_lahir">Tanggal Lahir</label>
					</div>
					<div class="form-group">
						<input id="tg_update" type="text" name="tg_update" class="form-control is-datepicker" placeholder="yyyy-mm-dd"  value="{{ $data['tg_update'] }}">
						<label for="tg_update">Tanggal Update</label>
					</div>
				</div>
			</div>
			<div class="card card-underline">
				<div class="card-head">
					<header>PANGKAT</header>
				</div>
				<div class="card-body">
					<div class="form-group">
						<input id="tmt_1" type="text" name="tmt_1" class="form-control" value="{{ $data['tmt_1'] }}">
						<label for="tmt_1">Tmt Tamtama</label>
					</div>
					<div class="form-group">
						<input id="tmt_2" type="text" name="tmt_2" class="form-control" value="{{ $data['tmt_2'] }}">
						<label for="tmt_2">Tmt Bintara</label>
					</div>
					<div class="form-group">
						<input id="tmt_3" type="text" name="tmt_3" class="form-control" value="{{ $data['tmt_3'] }}">
						<label for="tmt_3">Tmt Pama</label>
					</div>
					<div class="form-group">
						<input id="tmt_4" type="text" name="tmt_4" class="form-control" value="{{ $data['tmt_4'] }}">
						<label for="tmt_4">Tmt Pamen</label>
					</div>
					<div class="form-group">
						<input id="tmt_5" type="text" name="tmt_5" class="form-control" value="{{ $data['tmt_5'] }}">
						<label for="tmt_5">Tmt Pati</label>
					</div>
				</div>
			</div>
			<div class="card card-underline">
				<div class="card-head">
					<header>LAINNYA</header>
				</div>
				<div class="card-body">
					<div class="form-group">
						<input id="tmt_pkt" type="text" name="tmt_pkt" class="form-control is-datepicker" placeholder="yyyy-mm-dd"  value="{{ $data['tmt_pkt'] }}">
						<label for="tmt_pkt">Tmt Pangkat</label>
					</div>
					<div class="form-group">
						<input id="tmt_henti" type="text" name="tmt_henti" class="form-control is-datepicker" placeholder="yyyy-mm-dd"  value="{{ $data['tmt_henti'] }}">
						<label for="tmt_henti">Tmt Pensiun</label>
					</div>
					<!-- <div class="form-group">
						<input id="kode_p_sub" type="text" name="kode_p_sub" class="form-control" value="{{ $data['kode_p_sub'] }}">
						<label for="kode_p_sub">Kode Baltab</label>
					</div> -->
					<div class="form-group">
						<input id="kd_bansus" type="text" name="kd_bansus" class="form-control" value="{{ $data['kd_bansus'] }}">
						<label for="kd_bansus">Kd Bansus</label>
					</div>
					<div class="form-group">
						<input id="tmt_pa" type="text" name="tmt_pa" class="form-control" value="{{ $data['tmt_pa'] }}">
						<label for="tmt_pa">Tmt Perwira</label>
					</div>
					<div class="form-group">
						<input id="no_bitur" type="text" name="no_bitur" class="form-control" value="{{ $data['no_bitur'] }}">
						<label for="no_bitur">No Bitur</label>
					</div>
					<div class="form-group">
						<div class="pt-10">
							{{ Form::select('kd_ktg', \App\Models\Kategori::pluck('uraian','kode'), $data['kd_ktg'], ['class'=>'form-control is-select2','placeholder'=>'Pilih Kategori']) }}
						</div>
						<label for="kd_ktg">Kategori</label>
					</div>
					<div class="form-group">
						<input id="tmt_ktg" type="text" name="tmt_ktg" class="form-control is-datepicker" placeholder="yyyy-mm-dd"  value="{{ $data['tmt_ktg'] }}">
						<label for="tmt_ktg">Tmt KTg</label>
					</div>
					<div class="form-group">
						<input id="g_pokok" type="text" name="g_pokok" class="form-control is-money" value="{{ $data['g_pokok'] }}">
						<label for="g_pokok">Gaji Pokok</label>
					</div>
					<div class="form-group">
						<input id="t_istri" type="text" name="t_istri" class="form-control is-money" value="{{ $data['t_istri'] }}">
						<label for="t_istri">Tunjangan Istri</label>
					</div>
					<div class="form-group">
						<input id="t_anak" type="text" name="t_anak" class="form-control is-money" value="{{ $data['t_anak'] }}">
						<label for="t_anak">Tunjangan Anak</label>
					</div>
					<div class="form-group">
						<input id="kpr1" type="text" name="kpr1" class="form-control" value="{{ $data['kpr1'] }}">
						<label for="kpr1">KPR 1</label>
					</div>
					<div class="form-group">
						<input id="kpr2" type="text" name="kpr2" class="form-control" value="{{ $data['kpr2'] }}">
						<label for="kpr2">KPR 2</label>
					</div>
				</div>
			</div>
			
			<button class="btn btn-primary">Update</button>
			<a href="{{ url('verifikasi') }}" class="btn btn-danger">Cancel</a>
		</form>
		
	</div>
</div>
@endsection

@section('footer_script')
	<script src="{{ url('js/select2.min.js') }}"></script>
	<script src="{{ url('js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ url('js/jquery.inputmask.bundle.js') }}"></script>
	<script type="text/javascript">
		$(function(){
			$('.is-select2').select2({
				theme: "bootstrap"
			});

			$(".is-datepicker").each(function() {
				// $(this).datepicker({
				// 	format:'yyyy-mm-dd',
				// 	defaultDate: null
				// });

			 //    $(this).datepicker('setDate', $(this).val());
			});

			$('.is-money').each(function(){
				$(this).inputmask({
					alias : "currency", 
					prefix: '',
					groupSeparator: ".",
					digits: 0,
				});
			});
		});
	</script>
@endsection