<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('css/swipe.css') }}" rel="stylesheet">

    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Inicio</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Registro</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="container">
            <div class="stack">
                <div class="final-message">No more kitten :'(</div>
                <ul>
                    <li>
                        <div id="card10" class="card js-swiping-card">
                            <div class="card-illustration js-lazyload" data-original="https://placekitten.com/g/300/200"></div>
                        </div>
                    </li>
                    <li>
                        <div id="card9" class="card js-swiping-card">
                            <div class="card-illustration js-lazyload" data-original="https://placekitten.com/g/400/200"></div>
                        </div>
                    </li>
                    <li>
                        <div id="car8" class="card js-swiping-card">
                            <div class="card-illustration js-lazyload" data-original="https://placekitten.com/g/450/200"></div>
                        </div>
                    </li>
                    <li>
                        <div id="card7" class="card js-swiping-card">
                            <div class="card-illustration js-lazyload" data-original="https://placekitten.com/g/800/200"></div>
                        </div>
                    </li>
                    <li>
                        <div id="card6" class="card js-swiping-card">
                            <div class="card-illustration js-lazyload" data-original="https://placekitten.com/g/100/200"></div>
                        </div>
                    </li>
                    <li>
                        <div id="card5" class="card js-swiping-card">
                            <div class="card-illustration js-lazyload" data-original="https://placekitten.com/g/400/200"></div>
                        </div>
                    </li>
                    <li>
                        <div id="card4" class="card js-swiping-card">
                            <div class="card-illustration js-lazyload" data-original="https://placekitten.com/g/150/200"></div>
                        </div>
                    </li>
                    <li>
                        <div id="card3" class="card js-swiping-card">
                            <div class="card-illustration js-lazyload" data-original="http://www.escaledigitale.com/im/team/anita@2x.png"></div>
                        </div>
                    </li>
                    <li>
                        <div id="card2" class="card js-swiping-card">
                            <div class="card-illustration js-lazyload" data-original="https://placekitten.com/g/600/200"></div>
                        </div>
                    </li>
                    <li>
                        <div id="card1" class="card js-swiping-card">
                            <div class="card-illustration js-lazyload" data-original="https://placekitten.com/g/400/200"></div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="btn-controls text-center">
                <button type="button" class="btn btn-danger js-left-trigger">
                    Ugly kitten
                </button>
                <button type="button" class="btn btn-primary js-right-trigger">
                    Atomic kitten
                </button>
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
            var $topCard = $('.js-swiping-card').last();
            swipeEnded(event, 'right', $topCard);
        });
    </script>
</body>

</html>