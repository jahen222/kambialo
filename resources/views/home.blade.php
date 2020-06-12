@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                  Buscar por Categorías
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Seleccione una categoría</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="{{route('search.category')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                          <?php foreach ($categories as $category): ?>
                            <input type="radio" name="search" value="{{$category->id}}">
                            <label for="search">{{$category->name}}</label><br>
                          <?php endforeach; ?>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                          <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <div class="card-body" style="padding: 0px;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <?php if (count($products)>0): ?>
                      <div class="slideshow-container">
                        <?php foreach ($products as $product): ?>
                          <div class="mySlides">
                            <a href="{{ route('product.show', $product->id) }}">
                              <img src="/images/{{$product->image}}" style="width:100%">
                              <div class="text">{{$product->name}}</div>
                            </a>
                          </div>
                        <?php endforeach; ?>
                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                      </div>
                      <img src="/images/fake_footer.png" style="width:100%">
                    <?php else: ?>
                      <div class="card-body">
                        @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                        @endif

                        No hay productos.
                      </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

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
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
  }
</script>
@endsection
