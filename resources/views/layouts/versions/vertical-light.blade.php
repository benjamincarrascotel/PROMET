<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="Azea – Laravel Admin & Dashboard Template" name="description">
		<meta content="Spruko Private Limited" name="author">
		<meta name="keywords" content="laravel ui admin template, laravel admin template, laravel dashboard template,laravel ui template, laravel ui, livewire, laravel, laravel admin panel, laravel admin panel template, laravel blade, laravel bootstrap5, bootstrap admin template, admin, dashboard, admin template">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		
		<!-- Title -->
		<title>CEMIN</title>

        @include('layouts.vertical.styles')

	</head>

	<style>
		.color-header .header-icon {
			fill: #212529!important;
		}

	</style>

	<!--TODO dark-menu -->
	<body class="app sidebar-mini dark-menu color-header">

        <!---Global-loader-->
        <div id="global-loader" >
            <img src="{{asset('assets/images/svgs/loader.svg')}}" alt="loader">
        </div>
        <!--- End Global-loader-->

		<!-- PAGE -->
		<div class="page">
			<div class="page-main">

            @include('layouts.vertical.app-sidebar')

            @include('layouts.vertical.app-header')

                <!--app-content open-->
				<div class="app-content main-content">
					<div class="side-app">

                        @yield('form_open')
                        @include('flash::message')
						@yield('title')
                        @yield('content')
						@stack('cards')
						@yield('down_cards')
						@yield('form_close')

					</div>
				</div>
				<!-- CONTAINER END -->
            </div>

            @include('layouts.footer')

            @yield('modal')

		</div>

        @include('layouts.vertical.scripts')

	</body>

	<script>
		$.ajaxSetup({
                 headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
	</script>
</html>
