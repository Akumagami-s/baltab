@extends('layouts/main')

@section('content')
<div class="row">
	<div class="col-xs-12 col-md-6">
		<div class="card">
			<div class="card-body">
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
				
				<h4><span class="text-red">{{ \App\Helpers\ActivityHelper::unsync_count() }}</span> Data Not Synced</h4>
				<div class="clearfix"></div>
				<a href="{{ url('activity/sync') }}" class="btn btn-primary btn-lg btn-sync">Sync Data</a>
			</div>
		</div>
	</div>

	<div class="col-xs-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-xs-6 text-center">				
						<h4>Kelengkapan Pengajuan</h4>
						<div class="knob knob-primary knob-default-light-track size-4"><input type="text" class="dial" value="56" data-angleOffset=-125 data-angleArc=250 data-readOnly=true></div>
						<h4>Maret 2018</h4>
					</div>
					<div class="col-xs-6 text-center">				
						<h4>Approval Sprin</h4>
						<div class="knob knob-primary knob-default-light-track size-4"><input type="text" class="dial" value="56" data-angleOffset=-125 data-angleArc=250 data-readOnly=true></div>
						<h4>Maret 2018</h4>
					</div>
				</div>
			</div><!--end .card-body -->
		</div><!--end .card -->
	</div>

	<div class="col-xs-12">
		<div class="card">
			<div class="card-body">
				<h2 class="text-primary">Pengajuan Pengembalian 2018</h2>
				<div id="visitor-chart" class="flot height-6" data-title="Site visits" data-color="#9C27B0,#0aa89e"></div>
			</div><!--end .card-body -->
		</div><!--end .card -->
	</div>
</div>
@endsection

@section('footer_script')
	<script src="{{ url('/') }}/materialadmin/js/core/demo/DemoCharts.js"></script>
@endsection