@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <h1>{{ $user->name }}</h1>
                    
                    <br><br>
                    <p class="blog-product-meta">Email: {!! $user->email !!}</p>
                    <p class="blog-product-meta">Comuna: {!! App\Comuna::find($user->comuna_id)->name !!}</p>
                    <p class="blog-product-meta">Subscripcion: {!! App\Subscription::find($user->subscription_id)->name !!}</p>
                    <p class="blog-product-meta">Nombre: {!! $user->firstname !!}</p>
                    <p class="blog-product-meta">Apellido: {!! $user->lastname !!}</p>
                    <p class="blog-product-meta">Telefono: {!! $user->telephone !!}</p>
                </div>
            </div>
            @if(!Auth::guest())
                <div class="col-md-4">
                    <div class="well">
                        <h2>Opciones</h2>
                        <hr>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Editar
                            Usuario</a>
                        <form action="{{route('user.destroy', $user->id)}}" method="POST" class="pull-right">
                            <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">Eliminar usuario</button>
                        </form>
                    </div>
                </div>                    
            @endif
        </div>
    </div>

    <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            console.log(slides);
            var dots = document.getElementsByClassName("dot");
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
