
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="description" content="Ekka - Admin Dashboard HTML Template.">

		@if($setting->first()->title != null)
            <title>{{$setting->first()->title}}</title>
        @endif

		<!-- GOOGLE FONTS -->
		<link rel="preconnect" href="https://fonts.googleapis.com/">
		<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;family=Poppins:wght@300;400;500;600;700;800;900&amp;family=Roboto:wght@400;500;700;900&amp;display=swap" rel="stylesheet">

		{{-- <link href="../../../../../cdn.jsdelivr.net/npm/%40mdi/font%404.4.95/css/materialdesignicons.min.css" rel="stylesheet" /> --}}

		<!-- Ekka CSS -->
		<link id="ekka-css" rel="stylesheet" href="{{ asset('backend') }}/css/ekka.css" />

		<!-- FAVICON -->
		@if($setting->first()->favicon != null)
            <link rel="shortcut icon" href="{{ asset('uploads/setting') }}/{{ $setting->first()->favicon }}">
        @endif
	</head>

	<body class="sign-inup" id="body">
		<div class="container d-flex align-items-center justify-content-center form-height-login pt-24px pb-24px">
			@yield('login_content')
		</div>

		<!-- Javascript -->
		<script src="{{ asset('backend') }}/plugins/jquery/jquery-3.5.1.min.js"></script>
		<script src="{{ asset('backend') }}/js/bootstrap.bundle.min.js"></script>
		<script src="{{ asset('backend') }}/plugins/jquery-zoom/jquery.zoom.min.js"></script>
		<script src="{{ asset('backend') }}/plugins/slick/slick.min.js"></script>

		<!-- Ekka Custom -->
		<script src="{{ asset('backend') }}/js/ekka.js"></script>
	</body>
</html>
