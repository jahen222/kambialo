@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="{{ asset('css/swipe.css') }}" rel="stylesheet">


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
                  <?php foreach ($categories as $category) : ?>
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

          <?php if (count($products) > 0) : ?>
            <div class="slideshow-container">
              <?php foreach ($products as $product) : ?>
                <div class="mySlides">
                  <a href="{{ route('product.show', $product->id) }}">
                    <img src="/images/{{$product->cover_image}}" style="width:100%">
                    <div class="text">{{$product->name}}</div>
                  </a>
                </div>
              <?php endforeach; ?>
              <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
              <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <img src="/images/fake_footer.png" style="width:100%">
          <?php else : ?>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script>

<script>
  $('.js-lazyload').lazyload({
    effect: 'fadeIn',
    threshold: 50,
  });

  //Globals
  var $topCard,
    //deltaThreshold is the swipe distance from the initial place of the card
    deltaThreshold = 100,
    deltaX = 0;

  function swipeEnded(event, direction, $card) {
    var directionFactor,
      transform;
    //If the event has a type, then it is triggered from a button and has a given direction
    if (event.type === 'click') {
      directionFactor = direction === 'right' ? -1 : 1;
    }
    //If the event has a deltaX, then it is triggered from a gesture and has a calculated direction
    else if (event.deltaX) {
      directionFactor = event.deltaX >= 0 ? -1 : 1;
    }

    //If the threshold is reached or a trigger clicked, the card is thrown on a side and then disappear
    if (event.deltaX && deltaX > deltaThreshold || event.deltaX && deltaX < -1 * deltaThreshold || direction) {
      transform = 'translate(' + directionFactor * -100 + 'vw, 0) rotate(' + directionFactor * -5 + 'deg)';
      $card
        .delay(100)
        .queue(function() {
          $(this).css('transform', transform).dequeue();
        })
        .delay(300)
        .queue(function() {
          $(this).addClass('done').remove();
        });

      //Do something
      console.log('Swipe done. \nCard:', $card, '\nDirection:', directionFactor);

    }
    //If the threshold isn't reached, the card goes back to its initial place
    else {
      transform = 'translate(0, 0) rotate(0)';
      $card.css({
        'transform': transform,
      });
    }
  }

  function swipeLeft(event, $card) {
    var transform;
    deltaX = event.deltaX;
    transform = 'translate(' + deltaX * 0.8 + 'px, 0) rotate(5deg)';
    //translate the card on swipe
    $card.css({
      'transform': transform,
    });
  }

  function swipeRight(event, $card) {
    var transform;
    deltaX = event.deltaX;
    transform = 'translate(' + deltaX * 0.8 + 'px, 0) rotate(-5deg)';
    //translate the card on swipe
    $card.css({
      'transform': transform,
    });
  }

  //Events
  $('.js-swiping-card').each(function(index, element) {
    var $card = $(element),
      //Add hammer events on element
      hammertime = new Hammer(element);

    //Mobile gesture
    hammertime.on('panleft swipeleft', function(event) {
      swipeLeft(event, $card);
    });
    hammertime.on('panright swiperight', function(event) {
      swipeRight(event, $card);
    });
    hammertime.on('panend', function(event) {
      swipeEnded(event, false, $card);
    });
  });

  //Btn controls
  $('.js-left-trigger').on('click', function(event) {
    var $topCard = $('.js-swiping-card').last();
    swipeEnded(event, 'left', $topCard);
  });
  $('.js-right-trigger').on('click', function(event) {
    console.log('sapo');
    var $topCard = $('.js-swiping-card').last();
    swipeEnded(event, 'right', $topCard);
  });
</script>

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