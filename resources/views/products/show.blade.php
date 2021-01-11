
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="well">
                    <h1>{{ $product->name }}</h1>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body" style="padding: 0px;">
                                    <div class="slideshow-container">
                                        <div class="mySlides">
                                            <img class="img-fluid w-100"
                                                 src="{{ url()->to('images/' . $product->cover_image) }}"
                                                 alt="{{$product->cover_image}}" style="width:100%">
                                        </div>
                                        <?php if (isset($product->images[0])) : ?>
                                        <div class="mySlides">
                                            <img class="img-fluid w-100"
                                                 src="{{ url()->to('images/' . $product->images[0]->image) }}"
                                                 alt="{{$product->images[0]->image}}" style="width:100%">
                                        </div>
                                        <?php endif; ?>
                                        <?php if (isset($product->images[1])) : ?>
                                        <div class="mySlides">
                                            <img class="img-fluid w-100"
                                                 src="{{ url()->to('images/' . $product->images[1]->image) }}"
                                                 alt="{{$product->images[1]->image}}" style="width:100%">
                                        </div>
                                        <?php endif; ?>
                                        <?php if (isset($product->images[2])) : ?>
                                        <div class="mySlides">
                                            <img class="img-fluid w-100"
                                                 src="{{ url()->to('images/' . $product->images[2]->image) }}"
                                                 alt="{{$product->images[2]->image}}" style="width:100%">
                                        </div>
                                        <?php endif; ?>
                                        <a class="prev btn-circle prev-slide" onclick="plusSlides(-1)">&#10094;</a>
                                        <a class="next btn-circle next-slide" onclick="plusSlides(1)">&#10095;</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <p class="blog-product-meta">Descripción: {!! $product->description !!}</p>
                    <p class="blog-product-meta span-group">Categorias de interes:
                        @foreach($product->user->categories as $key => $userCategory)
                            <span>{{ $userCategory->category->name }}</span>
                        @endforeach
                    </p>
                    @if($product->user_id == $user->id) <!-- implementar formulario match -->
                    <p class="blog-product-meta">Categoría: {{ $product->category->name }} </p>
                    <p class="blog-product-meta">Propietario: {{ $product->user->email }} </p>
                    <p class="blog-product-meta">Publicado: {{ $product->created_at }} </p>
                    <p class="blog-product-meta span-group">Tags:
                        @foreach ($product->tags()->get() as $tag)
                            <span>{{ $tag->name }}</span>
                        @endforeach </p>
                    @endif
                </div>
            </div>
            @if(!Auth::guest())
                @if ($product->user_id === Auth::user()->id)
                    <div class="col-md-4">
                        <div class="well">
                            <h2>Opciones</h2>
                            <hr>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary">Editar
                                Producto</a>
                            <form action="{{route('product.destroy', $product->id)}}" method="POST" class="pull-right">
                                <input type="hidden" name="_method" value="DELETE">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger">Eliminar Producto</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="col-md-4">
                        <div class="well">
                            <h2>Opciones</h2>
                            <hr>
                            <form action="{{route('favorite.store')}}" method="POST" class="pull-right">
                                {{ csrf_field() }}
                                <input type="hidden" name="product" value="{{ $product->id }}">

                                @if (auth()->user()->favorites()->where('product_id', $product->id)->first())
                                    <button type="submit" class="btn btn-danger">Quitar de favoritos</button>
                                @else
                                    <button type="submit" class="btn btn-success">Añadir a favoritos</button>
                                @endif
                            </form>
                        </div>
                    </div>
                @endif
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
