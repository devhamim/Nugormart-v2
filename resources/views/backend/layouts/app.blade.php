
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Admin Dashboard">

    <meta name="csrf-token" content="{{ csrf_token() }}">
	@if($setting->first()->title != null)
        <title>{{$setting->first()->title}}</title>
    @endif

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;family=Poppins:wght@300;400;500;600;700;800;900&amp;family=Roboto:wght@400;500;700;900&amp;display=swap" rel="stylesheet">

	<link href="{{ asset('backend') }}/css/materialdesignicons.min.css" rel="stylesheet" />

	<!-- PLUGINS CSS STYLE -->
	<link href="{{ asset('backend') }}/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
	<link href="{{ asset('backend') }}/plugins/simplebar/simplebar.css" rel="stylesheet" />

    <!-- Bootstrap -->
	<link id="ekka-css" href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="{{asset('backend/css/select2.css')}}"> --}}

    {{-- calander --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- Data Tables -->
	<link href='{{ asset('backend') }}/plugins/data-tables/datatables.bootstrap5.min.css' rel='stylesheet'>
	<link href='{{ asset('backend') }}/plugins/data-tables/responsive.datatables.min.css' rel='stylesheet'>

	<!-- Ekka CSS -->
	<link id="ekka-css" href="{{ asset('backend') }}/css/ekka.css" rel="stylesheet" />

	<!-- FAVICON -->
    @if($setting->first()->favicon != null)
        <link rel="shortcut icon" href="{{ asset('uploads/setting') }}/{{ $setting->first()->favicon }}">
    @endif

    <style>
        .multiprint tr td{
    font-size: 12px !important;
    padding: 0 !important;
    margin: 0;
}
    </style>
</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-light ec-header-light" id="body">

	<!--  WRAPPER  -->
	<div class="wrapper">
        @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Successfully",
                text: "{{ session('success') }}",
            });
        </script>
    @endif
    @if (session('warning'))
        <script>
            Swal.fire({
                icon: "warning",
                title: "warning",
                text: "{{ session('warning') }}",
            });
        </script>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Opps..",
                    text: "{{ $error }}",
                });
            </script>
        @endforeach
    @endif

		<!-- LEFT MAIN SIDEBAR -->
		@include('backend.layouts.sidebar')

		<!--  PAGE WRAPPER -->
		<div class="ec-page-wrapper">

			<!-- Header -->
			@include('backend.layouts.header')

			<!-- CONTENT WRAPPER -->
			<div class="ec-content-wrapper">
				@yield('content')
			</div> <!-- End Content Wrapper -->

			<!-- Footer -->
			@include('backend.layouts.footer')

		</div> <!-- End Page Wrapper -->
	</div> <!-- End Wrapper -->

	<!-- Common Javascript -->
	{{-- <script src="{{ asset('backend') }}/plugins/jquery/jquery-3.5.1.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script src="{{ asset('backend') }}/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('backend') }}/plugins/simplebar/simplebar.min.js"></script>
	<script src="{{ asset('backend') }}/plugins/jquery-zoom/jquery.zoom.min.js"></script>
    {{-- <script src="{{ asset('backend/js/select2.js') }}')}}"></script> --}}
	<script src="{{ asset('backend') }}/plugins/slick/slick.min.js"></script>

    {{-- calander --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

	<!-- Chart -->
	<script src="{{ asset('backend') }}/plugins/charts/Chart.min.js"></script>
	<script src="{{ asset('backend') }}/js/chart.js"></script>

	<!-- Google map chart -->
	{{-- <script src="{{ asset('backend') }}/plugins/charts/google-map-loader.js"></script> --}}
	{{-- <script src="{{ asset('backend') }}/plugins/charts/google-map.js"></script> --}}

    <!-- Data Tables -->
	<script src='{{ asset('backend') }}/plugins/data-tables/jquery.datatables.min.js'></script>
	<script src='{{ asset('backend') }}/plugins/data-tables/datatables.bootstrap5.min.js'></script>
	<script src='{{ asset('backend') }}/plugins/data-tables/datatables.responsive.min.js'></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
	<!-- Date Range Picker -->
	<script src="{{ asset('backend') }}/plugins/daterangepicker/moment.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/daterangepicker/daterangepicker.js"></script>
	<script src="{{ asset('backend') }}/js/date-range.js"></script>

	<!-- Option Switcher -->
	<script src="{{ asset('backend') }}/plugins/options-sidebar/optionswitcher.js"></script>

	<!-- Ekka Custom -->
	<script src="{{ asset('backend') }}/js/ekka.js"></script>

    <script>
        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 400
        });

    });
</script>

@yield('footer_scripts')

</body>
</html>
