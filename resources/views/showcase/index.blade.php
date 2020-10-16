@extends('layouts.app')

@section('content')
<card-component v-bind:category="'{{ request('category') }}'" v-bind:url="'{{ url()->to('product') }}'"></card-component>
<div class="nav-bottom">
  <div><i class="material-icons">home</i></div>
  <div><i class="material-icons">message</i></div>
  <div><i class="material-icons">add_circle</i></div>
  <div class="dropdown show">
    <a style="color:white;" href="#" onclick="resetNotification()" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="material-icons">notifications</i>
      @if($user = auth()->user())
        <span style="{{ count($user->unreadNotifications) ?: 'display:none;' }}" class="notification" id="notification-number">{{ count($user->unreadNotifications) }}</span>
      @endif
    </a>
    @if($user = auth()->user())
    <div class="dropdown-menu" id="notification-list" aria-labelledby="dropdownMenuLink">
      @foreach($user->notifications as $notification)
      <a onclick="markAsRead(this)" data-id="{{ $notification->id }}" class="dropdown-item {{ !$notification->read_at ? 'active' : ''}}" href="{{ $notification->data['url'] }}">{{ $notification->data['message'] }}</a>
      @endforeach
    </div>
    @endif
  </div>
  <div><i class="material-icons">person</i></div>
</div>
@endsection
@section('scripts')
<!-- vue -->
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@if($user = auth()->user())
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var notificationEle = $('#notification-number');
    var notificationListEle = $('#notification-list');
    var notificationN = 0;

    function resetNotification() {
      notificationN = 0;
      notificationEle.hide();
    }

    function markAsRead(noti) {
      $(noti).removeClass('active');
      $.ajax({
        url: '{{ route("notification.markAsRead")}}',
        data: {id: $(noti).data('id')}
      });
    }

    var pusher = new Pusher('97c2397e96499bcf7440', {
      cluster: 'us3',
      authEndpoint: 'http://localhost/kambialo/public/broadcasting/auth',
    });

    var channel = pusher.subscribe('private-users.{{ $user->id}}');
    channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
      console.log(data);
      notificationN++;
      notificationEle.html(notificationN);
      notificationEle.show();
      notificationListEle.prepend('<a onclick="markAsRead(this)" data-id="' + data.id + '" class="dropdown-item active" href="' + data.url + '">' + data.message + '</a>');
    });
  </script>
@endif
@endsection