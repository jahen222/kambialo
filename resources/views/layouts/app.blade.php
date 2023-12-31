<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts
    <script src="{{ asset('js/app.js') }}" defer></script>-->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/material/css/mdb.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('js/jquery-ui/jquery-ui.min.css') }}">

    <!-- Styles -->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="padding: 0;">
            <div class="container">
				<div>
					<a style="width: 50%;" href="{{ url('/') }}">
						<img src="{{ asset('images/logo.png') }}" alt="" style="width: 50%;">
					</a>
					<button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
						<span class="navbar-toggler-icon"></span>
					</button>
				</div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent"style="flex-basis: 100%;">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                        </li>
                        @endif
                        @endguest
                        @auth
							{{ view('layouts.menu_auth') }}
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @include('flash-message')

            @yield('content')
        </main>
    </div>

    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/18f61f0b58.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('assets/material/js/mdb.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/app.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

	<script>
		$('.navbar-toggler').on('click',function(e){
			e.preventDefault();
			e.stopPropagation();
			$($(this).data('target')).collapse('toggle');
		})
	</script>
</body>

</html>
