@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="well">
                    <h1>Match con {{ $userMatch->name }}</h1>
                    <br>
                    <p class="blog-product-meta">Email: {{ $userMatch->email }} </p>
                </div>

                <div class="well" style="margin-top: 15px;">
                    <h3>Tus Match con {{ $userMatch->name }}</h3>
                    <div class="col-md-4">
                        <div id="carouselMisMatch" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselMisMatch" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselMisMatch" data-slide-to="1"></li>
                                <li data-target="#carouselMisMatch" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="container">
                                        <img class="d-block img-fluid w-100" src="http://kambialo.local/images/Prince of Persia - Warrior Within_1598730957.jpg" alt="First slide">
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="container">
                                        <img class="d-block img-fluid w-100" src="http://kambialo.local/images/Dawn of war II_1599084413.jpg" alt="First slide">
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="container">
                                        <img class="d-block img-fluid w-100" src="http://kambialo.local/images/Prince of Persia - Warrior Within_1598730957.jpg" alt="First slide">
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselMisMatch" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselMisMatch" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="well" style="margin-top: 20px;">
                    <h3>a {{ $userMatch->name }} le gusto</h3>
                    <div class="col-md-4">
                        <div id="carouselMatchOtros" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselMatchOtros" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselMatchOtros" data-slide-to="1"></li>
                                <li data-target="#carouselMatchOtros" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="container">
                                        <img class="d-block img-fluid w-100" src="http://kambialo.local/images/Prince of Persia - Warrior Within_1598730957.jpg" alt="First slide">
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="container">
                                        <img class="d-block img-fluid w-100" src="http://kambialo.local/images/Dawn of war II_1599084413.jpg" alt="First slide">
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="container">
                                        <img class="d-block img-fluid w-100" src="http://kambialo.local/images/Prince of Persia - Warrior Within_1598730957.jpg" alt="First slide">
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselMatchOtros" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselMatchOtros" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
