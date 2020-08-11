<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage</title>

    <!-- Fonts -->
    <link href="{{ asset('assets/css/font.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.scss') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/18f61f0b58.js" crossorigin="anonymous"></script>

</head>

<body>
  <section id="home">
    <div class="container-fluid">
      <div class="row">
        <div class="kb-bannerimage col-md-12 col-lg-12 col-sm-12 col-xs-12" style="background-image:url({{ asset('assets/img/imagen-slider-02-06.jpg') }})">
            <div class="banner-header">
              <img src="{{ asset('assets/img/logo-header.png') }}">
              <div class="header-right">
                <a href="{{ url('login') }}" type="button" class="btn btn-white d-none-sm d-block-md d-block-lg d-block-xl"> INICIA SESIÓN </a>
                <a href="#menu"><i class="fa fa-bars"></i></a>
              </div>
            </div>
            <div class="banner-description text-center" style="color: #fff;">
              <h2> PARA QUE COMPRAR </h2> 
              <h2> SI PUEDES KAMBIAR </h2>
              <p> Aquí podrás subir los productos que <br> no necesitas pero que alguien más si </p>
              <div class="registrate-button">
                <a href="{{ url('register') }}" type="button" class="btn btn-success"> REGÍSTRATE </a>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>

  <section id="parte">
    <div class="container-fluid">
      <div class="row">
        <div class="kb-howtoworks col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="kb-subtitle">
              <p>SE PARTE DE KÁMBIALO</p>
              <h2>¿CÓMO FUNCIONA?</h2>
              <hr>
            </div>
            <div class="kb-htw row">
              <div class="htw-signup col-md-3 col-lg-3 col-sm-6 ">
                <img src="{{ asset('assets/img/iconos-01.png') }}">
                <h6>REGÍSRATE</h6>
                <p>Regístrate y elige un plan</p>
              </div>
              <div class="htw-goesup col-md-3 col-lg-3 col-sm-6">
                <img src="{{ asset('assets/img/iconos-02.png') }}">
                <h6>SUBE</h6>
                <p>Sube tus productosn</p>
              </div>
              <div class="htw-like col-md-3 col-lg-3 col-sm-6 ">
                <img src="{{ asset('assets/img/iconos-03.png') }}">
                <h6>LIKE</h6>
                <p>Dale like a productos de tu interés</p>
              </div>
              <div class="htw-match col-md-3 col-lg-3 col-sm-6">
                <img src="{{ asset('assets/img/iconos-04.png') }}">
                <h6>¡HICISTE MATCH!</h6>
                <p>Conversar y kambia tus productos</p>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>

  <section id="kambialo">
    <div class="container-fluid">
      <div class="row">
         <div class="kb-categories col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="kb-subtitle">
              <p>LO MÁS KAMBIADO</p>
              <h2>CATEGORÍAS DESTACADAS</h2>
              <hr>
            </div>
            <div class="product-categories row">
              <div class="p-category col-md-3 col-lg-3 col-sm-3 col-xs-3">
                <figure>
                  <img class="img-fluid" src="{{ asset('assets/img/watch.jpg') }}">
                  <div class="ct-btn">
                    <button type="button" class="btn">Relojes</button>
                  </div>
                </figure>
              </div>
              <div class="p-category col-md-3 col-lg-3 col-sm-3 col-xs-3 pc-second">
                <figure>
                  <img class="img-fluid" src="{{ asset('assets/img/shoes.jpg') }}">
                  <div class="ct-btn">
                    <button type="button" class="btn">Zapatos</button>
                  </div>
                </figure>
                <figure>
                  <img class="img-fluid" src="{{ asset('assets/img/shoes.jpg') }}">
                  <div class="ct-btn">
                    <button type="button" class="btn">Ropa</button>
                  </div>
                </figure>
              </div>
              <div class="p-category col-md-6 col-lg-6 col-sm-6 col-xs-6">
                <figure>
                  <img class="img-fluid" src="{{ asset('assets/img/bag.jpg') }}">
                  <div class="ct-btn">
                    <button type="button" class="btn">Bolsos</button>
                  </div>
                </figure>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>

  <section id="kambia">
    <div class="container-fluid">
      <div class="row">
        <div class="kb-uploads col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="kb-subtitle">
              <p>SE KAMBIAN</p>
              <h2>ÚLTIMOS SUBIDOS</h2>
              <hr>
            </div>
           <div class="my-5 text-center">
            <div class="row d-flex align-items-center">
                <div class="col-1 d-flex align-items-center justify-content-center arrow-left">
                    <a href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <div class="carousel-nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <path d="m88.6,121.3c0.8,0.8 1.8,1.2 2.9,1.2s2.1-0.4 2.9-1.2c1.6-1.6 1.6-4.2 0-5.8l-51-51 51-51c1.6-1.6 1.6-4.2 0-5.8s-4.2-1.6-5.8,0l-54,53.9c-1.6,1.6-1.6,4.2 0,5.8l54,53.9z"></path>
                          </svg>
                        </div>
                    </a>
                </div>
                <div class="col-10">
    
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item">
                                <div class="row carousel-item-row">
                                    <div style="background-image:url({{ asset('assets/img/ultimos-subidos-07.jpg') }});" class="col-12 col-md d-flex align-items-center justify-content-center m-2 i-item">
                                    </div>
                                    <div style="background-image:url({{ asset('assets/img/ultimos-subidos-07.jpg') }});" class="col-12 col-md d-flex align-items-center justify-content-center m-2 i-item">
                                    </div>
                                    <div style="background-image:url({{ asset('assets/img/ultimos-subidos-07.jpg') }});" class="col-12 col-md d-flex align-items-center justify-content-center m-2 i-item">
                                    </div>
                                    <div style="background-image:url({{ asset('assets/img/ultimos-subidos-07.jpg') }});" class="col-12 col-md d-flex align-items-center justify-content-center m-2 i-item">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item active">
                                <div class="row carousel-item-row">
                                  <div style="background-image:url({{ asset('assets/img/ultimos-subidos-07.jpg') }});" class="col-12 col-md d-flex align-items-center justify-content-center m-2 i-item">
                                  </div>
                                  <div style="background-image:url({{ asset('assets/img/ultimos-subidos-07.jpg') }});" class="col-12 col-md d-flex align-items-center justify-content-center m-2 i-item">
                                  </div>
                                  <div style="background-image:url({{ asset('assets/img/ultimos-subidos-07.jpg') }});" class="col-12 col-md d-flex align-items-center justify-content-center m-2 i-item">
                                  </div>
                                  <div style="background-image:url({{ asset('assets/img/ultimos-subidos-07.jpg') }});" class="col-12 col-md d-flex align-items-center justify-content-center m-2 i-item">
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>
                <div class="col-1 d-flex align-items-center justify-content-center -mr-2">
                    <a href="#carouselExampleIndicators" data-slide="next">
                        <div class="carousel-nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink">
        <path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"></path>
        </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
          </div>
      </div>
    </div>
  </section>

  <section id="sobre">
    <div class="container-fluid">
      <div class="row">
        <div class="kb-plans col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="kb-subtitle">
              <p>KÁMBIALO</p>
              <h2>PLANES</h2>
              <hr>
            </div>
            <div class="row plan-box">

              <div class="card-deck mb-3 text-center">
                <div class="card mb-4 shadow-sm">
                  <div class="card-header" style="background-color: #f3f3f3; color: #000;">
                    <h3>Plan 1</h3>
                    <p>básico</p>
                  </div>
                  <div class="card-body success-color">
                    <h1 class="card-title pricing-card-titler" style="color: #fff;">$2.000</h1>
                  </div>
                  <div class="card-footer">
                    <p class="card-title">1 Producto</p><hr>
                    <p class="card-text">1 mes</p>
                    <button type="button" class="btn">COMPRAR</button>
                  </div>
                </div>
                <div class="card mb-4 shadow-sm">
                  <div class="card-header" style="background-color: #f3f3f3; color: #000;">
                    <h3>Plan 2</h3>
                    <p>básico</p>
                  </div>
                  <div class="card-body success-color">
                    <h1 class="card-title pricing-card-titler" style="color: #fff;">$6.000</h1>
                  </div>
                  <div class="card-footer">
                    <p class="card-title">Hasta 5 Productos</p><hr>
                    <p class="card-text">1 mes</p>
                    <button type="button" class="btn">COMPRAR</button>
                  </div>
                </div>
                <div class="card mb-4 shadow-sm">
                  <div class="card-header" style="background-color: #f3f3f3; color: #000;">
                    <h3>Plan 3</h3>
                    <p>básico</p>
                  </div>
                  <div class="card-body success-color">
                    <h1 class="card-title pricing-card-titler" style="color: #fff;">$12.000</h1>
                  </div>
                  <div class="card-footer">
                    <p class="card-title">Hasta 15 Productos</p><hr>
                    <p class="card-text">1 mes</p>
                    <button type="button" class="btn">COMPRAR</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>

  <section id="comunidad" style="background-image:url({{ asset('assets/img/imagen-comunidad-10.jpg') }})">
    <div class="container">
      <div class="row">
        <div class="kb-commission">
            <h3>¿TIENES UNA COMUNIDAD?</h3>
            <p>PRONTO PODRÁS GANAR COMISIÓN POR TU COMUNIDAD</p>
          </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container-fluid">
      <div class="row">
        <div class="kb-footer">
            <img src="{{ asset('assets/img/logo-footer.png') }}">
            <div class="footer-icons">
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
            <div class="footer-menu">
              <a href="#"><p>TÉRMINOS Y CONDICIONES</p></a>
              <a href="#"><p>CALCULA TU ENVÍO</p></a>
              <a href="#"><p>DONACIONES</p></a>
              <a href="#"><p>CONTACTO</p></a>
            </div>
          </div>
      </div>
    </div>
  </section>


<!--<script src="{{ asset('assets/img/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js') }}"></script>-->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

</body>
</html>