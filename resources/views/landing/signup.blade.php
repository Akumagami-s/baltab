<!DOCTYPE html>
<html lang="en">
	<head>
		<title>BALTAB | Sign Up</title>

		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="your,keywords">
		<meta name="description" content="Short explanation about this website">
		<!-- END META -->

		<!-- BEGIN STYLESHEETS -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
		<link type="text/css" rel="stylesheet" href="{{ url('/') }}/materialadmin/css/theme-default/bootstrap.css?1422792965" />
		<link type="text/css" rel="stylesheet" href="{{ url('/') }}/materialadmin/css/theme-default/materialadmin.css?1425466319" />
		<link type="text/css" rel="stylesheet" href="{{ url('/') }}/materialadmin/css/theme-default/font-awesome.min.css?1422529194" />
		<link type="text/css" rel="stylesheet" href="{{ url('/') }}/materialadmin/css/theme-default/material-design-iconic-font.min.css?1421434286" />
		<link type="text/css" rel="stylesheet" href="{{ url('/') }}/css/styles.css" />
		<!-- END STYLESHEETS -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="{{ url('/') }}/materialadmin/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="{{ url('/') }}/materialadmin/js/libs/utils/respond.min.js?1403934956"></script>
		<![endif]-->
	</head>
	<body class="menubar-hoverable header-fixed ">

		<!-- BEGIN LOGIN SECTION -->
		<section class="section-account">
			<div class="img-backdrop" style="background-image: url('{{ url('/') }}/images/header-backdrop.jpg')"></div>
			<div class="spacer"></div>
			<div class="card contain-sm style-transparent">
				<div class="card-body">
					<div class="row">
						<div class="col-xs-12 col-md-6 col-md-push-3">
							<div class="card">
								<div class="card-body">
									<h2 class="text-center text-primary">SIGN UP BALTAB</h2>
									<form class="form floating-label" action="{{ url('signup') }}" accept-charset="utf-8" method="post">
										{{ csrf_field() }}
										<div class="form-group">
											<input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}" required>
											<label for="fullname">Full Name</label>
											@if ($errors->has('fullname'))
		                                        <span class="text-danger">{{ $errors->first('fullname') }}</span>
		                                    @endif
										</div>
										<div class="form-group">
											<input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
											<label for="email">Username</label>
											@if ($errors->has('email'))
		                                        <span class="text-danger">{{ $errors->first('email') }}</span>
		                                    @endif
										</div>
										<div class="form-group">
											<input type="password" class="form-control" id="password" name="password" required>
											<label for="password">Password</label>
											@if ($errors->has('password'))
		                                        <span class="text-danger">{{ $errors->first('password') }}</span>
		                                    @endif
										</div>
										<div class="row">
											<div class="col-xs-12 text-right">
												<button class="btn btn-primary btn-raised" type="submit">Login</button>
											</div><!--end .col -->
										</div><!--end .row -->
									</form>	
								</div>
								
							</div>
							
						</div><!--end .col -->
					</div><!--end .card -->
				</section>
				<!-- END LOGIN SECTION -->

				<!-- BEGIN JAVASCRIPT -->
				<script src="{{ url('/') }}/materialadmin/js/libs/jquery/jquery-1.11.2.min.js"></script>
				<script src="{{ url('/') }}/materialadmin/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
				<script src="{{ url('/') }}/materialadmin/js/libs/bootstrap/bootstrap.min.js"></script>
				<script src="{{ url('/') }}/materialadmin/js/libs/spin.js/spin.min.js"></script>
				<script src="{{ url('/') }}/materialadmin/js/libs/autosize/jquery.autosize.min.js"></script>
				<script src="{{ url('/') }}/materialadmin/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
				<script src="{{ url('/') }}/materialadmin/js/core/source/App.js"></script>
				<script src="{{ url('/') }}/materialadmin/js/core/source/AppNavigation.js"></script>
				<script src="{{ url('/') }}/materialadmin/js/core/source/AppOffcanvas.js"></script>
				<script src="{{ url('/') }}/materialadmin/js/core/source/AppCard.js"></script>
				<script src="{{ url('/') }}/materialadmin/js/core/source/AppForm.js"></script>
				<script src="{{ url('/') }}/materialadmin/js/core/source/AppNavSearch.js"></script>
				<script src="{{ url('/') }}/materialadmin/js/core/source/AppVendor.js"></script>
				<script src="{{ url('/') }}/materialadmin/js/core/demo/Demo.js"></script>
				<!-- END JAVASCRIPT -->

			</body>
		</html>
