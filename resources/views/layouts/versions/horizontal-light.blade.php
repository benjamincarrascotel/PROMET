<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="Azea – Laravel Admin & Dashboard Template" name="description">
		<meta content="Spruko Private Limited" name="author">
		<meta name="keywords" content="laravel ui admin template, laravel admin template, laravel dashboard template,laravel ui template, laravel ui, livewire, laravel, laravel admin panel, laravel admin panel template, laravel blade, laravel bootstrap5, bootstrap admin template, admin, dashboard, admin template">

		<!-- Title -->
		<title>Azea – Laravel Admin & Dashboard Template</title>

        @include('layouts.horizontal.styles')

    </head>

	<body class="app">

		<!---Global-loader-->
		<div id="global-loader" >
			<img src="{{asset('assets/images/svgs/loader.svg')}}" alt="loader">
		</div>
		<!--- End Global-loader-->

		<!-- Page -->
		<div class="page">
			<div class="page-main">

                @include('layouts.horizontal.app-header')

                @include('layouts.horizontal.horizontal-main')

                <!-- App-Content -->
				<div class="hor-content main-content">
                    <div class="container">

                @yield('content')

                    </div>
                </div>
            </div>

            @include('layouts.footer')

            @yield('modal')

        </div>

        @include('layouts.horizontal.scripts')

    </body>
</html>
