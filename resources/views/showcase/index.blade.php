@extends('layouts.app')

@section('content')
<card-component v-bind:category="'{{ request('category') }}'" v-bind:url="'{{ url()->to('product') }}'"></card-component>
@endsection
@section('scripts')
<!-- vue -->
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script>
  /*Echo.private('App.User.1')
    .listen((notification) => {
      console.log(notification);
    });*/
    
</script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('97c2397e96499bcf7440', {
    cluster: 'us3'
  });

  var channel = pusher.subscribe('App.User.1');
  channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
    alert(JSON.stringify(data));
  });
</script>
@endsection