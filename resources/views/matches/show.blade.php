@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="well">
                    <h1>Match con {{ $userMatch->name }}</h1>
                    <br>
                    @if(($match->user_id_1 == $userMatch->id && $match->user_id_1_confirm)
                        || ($match->user_id_2 == $userMatch->id && $match->user_id_2_confirm))
                        <p class="blog-product-meta">Email: {{ $userMatch->email }} </p>
                        <p class="blog-product-meta">Telefono: <a href="https://wa.me/{{ $userMatch->telephone }}" target="_blank">{{ $userMatch->telephone }}</a></p>
                        <p>Mensaje: {{ $match->user_id_1 == $userMatch->id ? $match->user_id_1_message : $match->user_id_2_message }}  </p>
                    @endif
                </div>

                <div class="well" style="margin-top: 15px;">
                    <h3>Tus Match con {{ $userMatch->name }}</h3>
                    <div class="col-md-4">
                        <div class="slideshow-container" id="slide1">
                            @foreach($userMatch->products()->whereIn(
                                'id', array_column(auth()->user()->favorites()->get()->toArray(), 'product_id')
                            )->get() as $key => $value)
                                <div class="mySlides">
                                    <img style="width:100%" src="{{ url()->to(config('constants.publicUrl') . 'images/' . $value->cover_image) }}"
                                         alt="{{$value->cover_image}}" style="width:100%">
                                </div>
                            @endforeach
                            <a class="prev btn-circle prev-slide" onclick="plusSlides(-1, 'slide1')">&#10094;</a>
                            <a class="next btn-circle next-slide" onclick="plusSlides(1, 'slide1')">&#10095;</a>
                        </div>
                    </div>
                </div>

                <div class="well" style="margin-top: 20px;">
                    <h3>a {{ $userMatch->name }} le gusto</h3>
                    <div class="col-md-4">
                        <div class="slideshow-container" id="slide2">
                            @foreach(auth()->user()->products()->whereIn(
                                'id', array_column($userMatch->favorites()->get()->toArray(), 'product_id')
                            )->get() as $key => $value)
                                <div class="mySlides">
                                    <img style="width:100%" src="{{ url()->to(config('constants.publicUrl') . 'images/' . $value->cover_image) }}"
                                         alt="{{$value->cover_image}}" style="width:100%">
                                </div>
                            @endforeach
                            <a class="prev btn-circle prev-slide" onclick="plusSlides(-1, 'slide2')">&#10094;</a>
                            <a class="next btn-circle next-slide" onclick="plusSlides(1, 'slide2')">&#10095;</a>
                        </div>
                    </div>
                </div>

                <div class="well" style="margin-top: 20px;">
                    <h3>Otros productos de {{ $userMatch->name }} </h3>
                    <div class="col-md-4">
                        <div class="slideshow-container" id="slide3">
                            @foreach($userMatch->products()->get() as $key => $value)
                                <div class="mySlides">
                                    <img style="width:100%" src="{{ url()->to(config('constants.publicUrl') . 'images/' . $value->cover_image) }}"
                                         alt="{{$value->cover_image}}" style="width:100%">
                                </div>
                            @endforeach
                            <a class="prev btn-circle prev-slide" onclick="plusSlides(-1, 'slide3')">&#10094;</a>
                            <a class="next btn-circle next-slide" onclick="plusSlides(1, 'slide3')">&#10095;</a>
                        </div>
                    </div>
                </div>

            </div>
            @if(($match->user_id_1 == auth()->user()->id && !$match->user_id_1_confirm)
                || ($match->user_id_2 == auth()->user()->id && !$match->user_id_2_confirm))
            <div class="col-md-4">
                <div class="well">
                    <h2>Opciones</h2>
                    <hr>
                    <form action="{{route('match.confirm', $match->id)}}" method="POST" class="pull-right">
                        {{ csrf_field() }}
                        <div class="alert alert-warning">
                            Al confirmar, sus datos seran compartidos con el usuario
                        </div>
                        <div class="form-group">
                            <small class="form-text text-muted">Mensaje</small>
                            <textarea type="text" name="message" class="form-control" rows="3" style="resize: none; "></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>

    <script>
        var slideIndex = 1;
        showSlides(slideIndex, "slide1");
        showSlides(slideIndex, "slide2");
        showSlides(slideIndex, "slide3");

        function plusSlides(n, id = "") {
            showSlides(slideIndex += n, id);
        }

        function currentSlide(n, id = "") {
            showSlides(slideIndex = n, id);
        }

        function showSlides(n, id = "") {
            var i;
            var slides = document.getElementById(id).getElementsByClassName("mySlides");
            var dots = document.getElementById(id).getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
        }
    </script>
@endsection
