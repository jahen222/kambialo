@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="well">
        <h1>{{ $product->name }}</h1>
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-body" style="padding: 0px;">
                <div class="slideshow-container">
                  <div class="mySlides" style="display: block">
                    <img style="width:100%" src="/images/{{$product->cover_image}}" alt="{{$product->cover_image}}" style="width:100%">
                  </div>
                  <?php if ($product->image1) : ?>
                    <div class="mySlides">
                      <img style="width:100%" src="/images/{{$product->image1}}" alt="{{$product->image1}}" style="width:100%">
                    </div>
                  <?php endif; ?>
                  <?php if ($product->image2) : ?>
                    <div class="mySlides">
                      <img style="width:100%" src="/images/{{$product->image2}}" alt="{{$product->image2}}" style="width:100%">
                    </div>
                  <?php endif; ?>
                  <?php if ($product->image3) : ?>
                    <div class="mySlides">
                      <img style="width:100%" src="/images/{{$product->image3}}" alt="{{$product->image3}}" style="width:100%">
                    </div>
                  <?php endif; ?>
                  <?php if ($product->image4) : ?>
                    <div class="mySlides">
                      <img style="width:100%" src="/images/{{$product->image4}}" alt="{{$product->image4}}" style="width:100%">
                    </div>
                  <?php endif; ?>
                  <?php if ($product->image5) : ?>
                    <div class="mySlides">
                      <img style="width:100%" src="/images/{{$product->image5}}" alt="{{$product->image5}}" style="width:100%">
                    </div>
                  <?php endif; ?>
                  <?php if ($product->image6) : ?>
                    <div class="mySlides">
                      <img style="width:100%" src="/images/{{$product->image6}}" alt="{{$product->image6}}" style="width:100%">
                    </div>
                  <?php endif; ?>
                  <?php if ($product->image7) : ?>
                    <div class="mySlides">
                      <img style="width:100%" src="/images/{{$product->image7}}" alt="{{$product->image7}}" style="width:100%">
                    </div>
                  <?php endif; ?>
                  <?php if ($product->image8) : ?>
                    <div class="mySlides">
                      <img style="width:100%" src="/images/{{$product->image8}}" alt="{{$product->image8}}" style="width:100%">
                    </div>
                  <?php endif; ?>
                  <?php if ($product->image9) : ?>
                    <div class="mySlides">
                      <img style="width:100%" src="/images/{{$product->image9}}" alt="{{$product->image9}}" style="width:100%">
                    </div>
                  <?php endif; ?>
                  <?php if ($product->image10) : ?>
                    <div class="mySlides">
                      <img style="width:100%" src="/images/{{$product->image10}}" alt="{{$product->image10}}" style="width:100%">
                    </div>
                  <?php endif; ?>
                  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                  <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br><br>
        <p class="blog-product-meta">Categoría: {{ $product->category->name }} </p>
        <p class="blog-product-meta">Propietario: {{ $product->user->email }} </p>
        <p class="blog-product-meta">Publicado: {{ $product->created_at }} </p>
        <p>{!! $product->description !!}</p>
      </div>
    </div>
    @if(!Auth::guest())
    @if ($product->user_id === Auth::user()->id)
    <div class="col-md-4">
      <div class="well">
        <h1>Opciones</h1>
        <hr>
        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary">Editar Producto</a>
        <form action="{{route('product.destroy', $product->id)}}" method="POST" class="pull-right">
          <input type="hidden" name="_method" value="DELETE">
          {{ csrf_field() }}
          <button type="submit" class="btn btn-danger">Eliminar Producto</button>
        </form>
        <form action="{{route('favorite.store')}}" method="POST" class="pull-right">
          {{ csrf_field() }}
          <input type="hidden" name="product" value="{{ $product->id }}">
          <button type="submit" class="btn btn-success">A#adir a Favoritos</button>
        </form>
      </div>
    </div>
    <div id="result"></div>
    @endif
    @endif
  </div>
</div>

<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script type="application/javascript">
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
    dots[slideIndex - 1].className += " active";
  }
</script>
@endsection