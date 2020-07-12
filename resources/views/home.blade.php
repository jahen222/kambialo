@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="{{ asset('css/swipe.css') }}" rel="stylesheet">

<div class="container">
  <div class="stack">
    <div class="final-message">No hay mas productos...</div>
    <ul>
      <?php

      use App\User;

      $productIds = [];
      $favorites = User::find(auth()->user()->id)->favorites()->select('product_id');
      foreach ($favorites->get() as $favorite) {
        array_push($productIds, $favorite->product_id);
      }
      ?>

      <?php foreach ($products as $product) : ?>
        @if (auth()->user()->id != $product->user->id && !in_array($product->id, $productIds))
        <li>
          <a href="{{ route('product.show', $product->id) }}">
            <div class="card js-swiping-card">
              <input id="id" type="hidden" value="{{$product->id}}">
              <div class="card-illustration js-lazyload" data-original="/images/{{$product->cover_image}}"></div>
            </div>
          </a>
        </li>
        @endif
      <?php endforeach; ?>
    </ul>
  </div>
  <div class="btn-controls text-center">
    <button type="button" class="btn btn-danger js-left-trigger">
      A volar!
    </button>
    <button type="button" class="btn btn-primary js-right-trigger">
      Favoritos!
    </button>
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
      console.log('Swipe done. \nCard:', $card, '\nDirection:', directionFactor, '\nid:', $card[0].firstElementChild.value);

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
    var $topCard = $('.js-swiping-card').last();
    var product_id = $topCard[0].firstElementChild.value;
    $.ajax({
      url: "{{route('favorite.store')}}",
      type: "POST",
      data: {
        "_token": "{{ csrf_token() }}",
        product: product_id,
      },
      success: function(response) {
        swipeEnded(event, 'right', $topCard);
      },
    });
  });
</script>
@endsection