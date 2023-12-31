<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <!-- PAGE TITLE -->
    <title>HOMEPAGE</title>

    <!-- META-DATA -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="{{ asset('homes/assets/images/favicon.png')}}">

    <!-- CSS:: FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat:400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('homes/assets/css/fonts/font-awesome.css') }}">

    <!-- CSS:: OWL -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('homes/assets/css/plugins/owl/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('homes/assets/css/plugins/owl/owl.theme.default.min.css') }}">

    <!-- CSS:: REVOLUTION -->
    <link rel="stylesheet" type="text/css" href="{{ asset('homes/assets/css/plugins/revolution/settings.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('homes/assets/css/plugins/revolution/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('homes/assets/css/plugins/revolution/navigation.css') }}">

    <!-- CSS:: MAIN -->
    <link rel="stylesheet" type="text/css" href="{{ asset('homes/assets/css/main.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('homes/assets/css/style.css') }}">

    <style>
        .b-header_fixed .b-header_main .b-logo a img{
            content: url({{ url()->to('images/logo.png') }});
        }


        .kb-plans {
            background-color: transparent;
        }

        .kb-plans .plan-box .card {
            padding: 0%;
            border-radius: 0%;
            border: none;
            box-shadow: 5px 5px 10px 2px #afafaf;
        }

        .card-box {
            display: grid;
            justify-content: center;
            flex-wrap: wrap;
        }

        .kb-plans .plan-box {
            text-align: center;
            margin: 4% 0;
        }

        .kb-plans .plan-box .card .card-header {
            color: #ffffff;
            border-bottom: none;
            border-radius: 0%;
        }

        .kb-plans .plan-box .card .card-body p {
            font-size: 18px;
        }

        .kb-plans .plan-box .card .card-footer {
            border-top: none;
        }

        .kb-plans .plan-box .card .card-footer button {
            color: #ffffff;
            border-radius: 0%;
            background-color: #38d438;
        }

        @media (min-width: 768px) {
            html {
                font-size: 16px;
            }
        }

        .container {
            max-width: 960px;
        }

        .pricing-header {
            max-width: 700px;
        }

        .card-deck .card {
            min-width: 220px;
        }

        .success-color, .btn-green {
            background-color: #34BF30;
            color: #fff;
        }

        .b-footer_block_title::before {
            content: "";
            position: absolute;
            bottom: 0;
            display: inline-block;
            width: 30px;
            height: 2px;
            background-color: transparent;
        }

        @media (max-width: 768px) {
            .caption h1 {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
<div class="b-main_menu-wrapper hidden-lg-up">
    <ul class="categories">
        @guest
            <li>
                <a href="{{ url('login') }}"><span class="top">Iniciar sesión</span></a>
            </li>
            <li>
                <a href="{{ url('register') }}"><span class="top">Registro</span></a>
            </li>
        @endguest
        @auth
		 {{ view('layouts.menu_auth') }}
        @endauth
    </ul>
</div>
<div class="b-wrapper">
    <header id="b-header">
        <div class="b-header b-header_main">
            <div class="container">
                <div class="clearfix row">
                    <div class="col-xl-4 col-lg-4 col-mb-4 col-sm-4 col-xs-6">
                        <div class="b-logo text-sm-left text-lg-center text-xl-center">
                            <a href="/" class="d-inline-block"><img src="{{ asset('assets/img/logo-header.png')}}" class="img-fluid d-block" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-mb-4 col-sm-12 col-xs-12 hidden-sm-down hidden-md-down">
                        <!-- ESPACIO DE BOTON INICIO -->
                    </div>
                    <div class="col-xl-4 col-lg-4 col-mb-4 col-sm-8 col-xs-6">
                        <div class="b-header_right">
                            <div class="b-header_links hidden-sm-down">
                                <ul class="pl-0 mb-0 list-unstyled">
                                    <li>
                                        @guest
                                            <a href="{{ url('login') }}" class="btn btn-white d-none-sm d-block-md d-block-lg d-block-xl" style="font-style: unset;"> INICIA SESIÓN </a>
                                        @endguest
                                        @auth
                                        <li>
                                            <a href="{{ url('logout') }}"> </a>
                                        </li>
                                        @endauth
                                    </li>
                                </ul>
                            </div>
                            <div class="b-search_icon"> <!-- hidden-lg-up -->
                                <i class="icon-menu icons b-nav_icon" id="b-nav_icon" style="color: #fff;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="fullwidthbanner-container">
        <div id="b-home_01_slider" style="display:none;" data-version="5.4.1">
            <ul>
                <li style="display:flex;background-image: url({{ asset('homes/assets/images/imagen-slider-02-06-min.jpg') }} ); background-size: cover;">
                    <div class="caption"style="display:flex;">
						<div style="margin:auto;width:100%;">
                            <h1 style="font-weight: 600;"><b> PARA QUE COMPRAR <br> SI PUEDES CAMBIAR </b></h1>
							<p> Aquí podrás subir los productos que <br> no necesitas pero que alguien más si </p>
							<div class="registrate-button" style="font-weight: bold;">
								<a href="{{ url('register') }}" class="btn btn-green"> REGÍSTRATE </a>
							</div>
						</div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    
    <section id="b-products">
        <div class="b-section_title text-center">
            <h4 class="text-uppercase text-azul lato-font" style="margin:0;">
                SE PARTE DE KÁMBIALO
            </h4>
            <h1 style="position: relative; font-weight: lighter;" class="lato-font">
                ¿CÓMO FUNCIONA?
                <span class="b-title_separator"><span></span></span>
            </h1>
            <br><br><br><br><br>
        </div>
        <div class="b-products b-product_grid b-product_grid_four mb-4">
            <div class="container">
                <div class="row clearfix kb-htw">
                    <div class="htw-signup col-md-3 col-lg-3 col-sm-6 ">
                        <img src="{{ asset('assets/img/iconos-01.png')}}">
                        <h6>REGÍSRATE</h6>
                        <p>Regístrate y elige un plan</p>
                    </div>
                    <div class="htw-goesup col-md-3 col-lg-3 col-sm-6">
                        <img src="{{ asset('assets/img/iconos-02.png')}}">
                        <h6>SUBE</h6>
                        <p>Sube tus productosn</p>
                    </div>
                    <div class="htw-like col-md-3 col-lg-3 col-sm-6 ">
                        <img src="{{ asset('assets/img/iconos-03.png')}}">
                        <h6>LIKE</h6>
                        <p>Dale like a productos de tu interés</p>
                    </div>
                    <div class="htw-match col-md-3 col-lg-3 col-sm-6">
                        <img src="{{ asset('assets/img/iconos-04.png')}}">
                        <h6>¡HICISTE MATCH!</h6>
                        <p>Conversar y kambia tus productos</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><br>
    <section id="b-products_cat">
        <div class="b-section_title text-center">
            <h4 class="text-uppercase text-azul lato-font" style="margin:0;">
                LO MÁS KAMBIADO
            </h4>
            <h1 style="position: relative; font-weight: lighter;" class="lato-font">
                CATEGORÍAS DESTACADAS
                <span class="b-title_separator"><span></span></span>
            </h1>
            <br><br><br><br><br>
        </div>
        <div class="b-featured_cat">
            <div class="container">
                <div class="row clearfix">
                @foreach(\App\Category::getCommons(4) as $value)
                    <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-3 col-xs-12">
                        <div class="b-featured_cat_in" style="height: 100%;">
                            <a href="{{ route('showcase.index') }}">
                                <img style="width: 100%;height: 100%;" src="{{ url()->to('assets/img/' . $value->image) }}" class="img-fluid d-block" alt="">
                            </a>
                            <div class="b-cat_mask text-center" style="left: 50%; transform: translateX(-50%);">
                                <a style="font-style:normal;" href="{{ route('showcase.index', ['category' => $value->id]) }}" class="category-link-overlay">{{ $value->name }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>
    <br><br><br><br>
    <section id="b-products_cat">
        <div class="b-section_title text-center">
            <h4 class="text-uppercase text-azul lato-font" style="margin:0;">
                SE KAMBIAN
            </h4>
            <h1 style="position: relative; font-weight: lighter;" class="lato-font">
                ULTIMOS SUBIDOS
                <span class="b-title_separator"><span></span></span>
            </h1>
            <br><br><br><br><br>
        </div>
        <div class="b-featured_cat">
            <div class="container">
                <div class="row clearfix">
                @foreach(\App\Product::getRecents(4) as $value)
                    <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-3 col-xs-12">
                        <div class="b-featured_cat_in" style="height: 100%;">
                            <a href="{{ route('showcase.index') }}">
                                <img style="width: 100%; height: 100%;" src="{{ url()->to(config('constants.publicUrl') . 'images/' . $value->cover_image) }}" class="img-fluid d-block" alt="">
                            </a>
                            <div class="b-cat_mask text-center" style="left: 50%; transform: translateX(-50%);">
                                <a style="font-style:normal;" href="{{ route('showcase.index') }}" class="category-link-overlay">{{ $value->name }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>
    <br><br><br><br>
    <section id="sobre" style="background-color: #f4f4f4;">
        <div class="b-section_title text-center">
            <h4 class="text-uppercase text-azul lato-font" style="margin:0;">
                KÁMBIALO
            </h4>
            <h1 style="position: relative; font-weight: lighter;" class="lato-font">
                PLANES
                <span class="b-title_separator"><span></span></span>
            </h1>
            <br><br><br><br><br>
        </div>
        <div class="b-products b-product_grid b-product_grid_four mb-4">
            <div class="container">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header" style="background-color: transparent; color: #000;">
                            <h3 style="margin: 0;">Plan 1</h3>
                            <small class="text-muted" style="margin:0;">básico</small>
                        </div>
                        <div class="card-body success-color">
                            <h1 class="card-title pricing-card-titler" style="color: #fff;margin:0;">$2.000</h1>
                        </div>
                        <div class="card-footer">
                            <p class="card-title">1 Producto</p>
                            <hr>
                            <p class="card-text">4 mes</p>
                            <a href="{{ route('register') }}" type="button" class="btn btn-green">COMPRAR</a>
                        </div>
                    </div>
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header" style="background-color: transparent; color: #000;">
                            <h3 style="margin: 0;">Plan 2</h3>
                            <small class="text-muted" style="margin:0;">básico</small>
                        </div>
                        <div class="card-body success-color">
                            <h1 class="card-title pricing-card-titler" style="color: #fff;margin:0;">$6.000</h1>
                        </div>
                        <div class="card-footer">
                            <p class="card-title">Hasta 5 Productos</p>
                            <hr>
                            <p class="card-text">4 mes</p>
                            <a href="{{ route('register') }}" type="button" class="btn btn-green">COMPRAR</a>
                        </div>
                    </div>
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header" style="background-color: transparent; color: #000;">
                            <h3 style="margin: 0;">Plan 3</h3>
                            <small class="text-muted" style="margin:0;">básico</small>
                        </div>
                        <div class="card-body success-color">
                            <h1 class="card-title pricing-card-titler" style="color: #fff;margin:0;">$12.000</h1>
                        </div>
                        <div class="card-footer">
                            <p class="card-title">Hasta 15 Productos</p>
                            <hr>
                            <p class="card-text">4 mes</p>
                            <a href="{{ route('register') }}" type="button" class="btn btn-green">COMPRAR</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="b-gallery_logo_outer">
        <div class="b-gallery_logo"
             style="background-image:url({{ asset('assets/img/imagen-comunidad-10.jpg') }}) ; background-size: cover; background-position: center;">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="kb-commission" style="padding: 10% 0;">
                            <h1>¿TIENES UNA COMUNIDAD?</h1>
                            <p>PRONTO PODRÁS GANAR COMISIÓN POR TU COMUNIDAD</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="b-footer_container color-scheme-light hidden -sm-down">
        <div class="container b-main_footer">
            <!-- footer-main -->
            <aside class="row clearfix">
                <div class="b-footer_column col-md-12 col-sm-12">
                    <div class="b-footer_block">
                        <div class="b-footer_block_in">
                            <p class="text-center mb-0"><img src="{{ asset('assets/img/logo-header.png')}}"
                                                             class="d-block m-auto img-fluid" alt="" title=""></p>
                            <ul class="b-social-icons text-center">
                                <li class="b-social_facebook"><a href="#" target="_blank"><i class="fa fa-facebook"></i>Facebook</a>
                                </li>
                                <li class="b-social_twitter"><a href="#" target="_blank"><i class="fa fa-twitter"></i>Twitter</a>
                                </li>
                            </ul>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="b-footer_column col-lg-3 col-md-3 col-sm-6 mb-4">
                    <div class="b-footer_block">
                        <a style="color:white;" href="#">TÉRMINOS Y CONDICIONES</a>
                    </div>
                </div>
                <div class="b-footer_column col-lg-3 col-md-3 col-sm-6 mb-4">
                    <div class="b-footer_block">
                        <a style="color:white;" href="#">CALCULA TU ENVÍO</a>
                    </div>
                </div>
                <div class="b-footer_column col-lg-3 col-md-3 col-sm-6 mb-4">
                    <div class="b-footer_block">
                        <a style="color:white;" href="#">DONACIONES</a>
                    </div>
                </div>
                <div class="b-footer_column col-lg-3 col-md-3 col-sm-6 mb-4">
                    <div class="b-footer_block">
                        <a style="color:white;" href="#">CONTACTO</a>
                    </div>
                </div>
            </aside>
            <!-- footer-main -->
        </div>
        <!-- footer-bar -->
        <!--<div class="b-copyrights_wrapper">
            <div class="container">
                <div class="d-footer_bar">
                    <div class="text-center">
                        <i class="fa fa-copyright"></i> 2018 Created by
                        <a href="#" class="text-white">
                           jThemes Studio
                        </a>
                    </div>
                </div>
            </div>
        </div>-->
        <!-- footer-bar -->
    </footer>
    <a href="javascript:;" id="b-scrollToTop" class="b-scrollToTop">
        <span class="basel-tooltip-label">Scroll To Top</span>Scroll To Top
    </a>
    <div class="b-search_popup">
        <form role="search" method="get" id="searchform" class="searchform  basel-ajax-search" action="#"
              data-thumbnail="1" data-price="1" data-count="3">
            <div>
                <label class="screen-reader-text" for="s"></label>
                <input type="text" placeholder="Search for products" value="" name="s" id="s" autocomplete="off">
                <input type="hidden" name="post_type" id="post_type" value="product">
                <button type="submit" class="b-searchsubmit" id="b-searchsubmit">Search</button>
            </div>
        </form>
        <span class="b-close_search" id="b-close_search">close</span>
    </div>
</div>
<!-- JQUERY:: JQUERY.JS -->
<script src="{{ asset('homes/assets/js/jquery.min.js') }}"></script>

<!-- JQUERY:: BOOTSTRAP.JS -->
<script src="{{ asset('homes/assets/js/tether.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- JQUERY:: OWL.JS -->
<script src="{{ asset('homes/assets/js/plugins/owl/owl.carousel.min.js') }}"></script>

<!-- REVOLUTION JS FILES -->
<script src="{{ asset('homes/assets/js/plugins/revolution/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('homes/assets/js/plugins/revolution/jquery.themepunch.revolution.min.js') }}"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS -->
<script src="{{ asset('homes/assets/js/plugins/revolution/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('homes/assets/js/plugins/revolution/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('homes/assets/js/plugins/revolution/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('homes/assets/js/plugins/revolution/revolution.extension.slideanims.min.js') }}"></script>

<!-- JQUERY:: CUSTOM.JS -->
<script>
    $('#carouselExample').on('slide.bs.carousel', function (e) {
        var $e = $(e.relatedTarget);
        var idx = $e.index();
        var itemsPerSlide = 4;
        var totalItems = $('.carousel-item').length;

        if (idx >= totalItems - (itemsPerSlide - 1)) {
            var it = itemsPerSlide - (totalItems - idx);
            for (var i = 0; i < it; i++) {
                // append slides to end
                if (e.direction == "left") {
                    $('.carousel-item').eq(i).appendTo('.carousel-inner');
                } else {
                    $('.carousel-item').eq(0).appendTo('.carousel-inner');
                }
            }
        }
    });

    $('#carouselExample').carousel({
        interval: 2000
    });

    $(document).ready(function () {
        /* show lightbox when clicking a thumbnail */
        $('a.thumb').click(function (event) {
            event.preventDefault();
            var content = $('.modal-body');
            content.empty();
            var title = $(this).attr("title");
            $('.modal-title').html(title);
            content.html($(this).html());
            $(".modal-profile").modal({show: true});
        });
    });
</script>
<script src="{{ asset('homes/assets/js/custom.js') }}"></script>
</body>
</html>
