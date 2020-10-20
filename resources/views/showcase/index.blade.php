@extends('layouts.app')

@section('content')
<card-component v-bind:category="'{{ request('category') }}'" v-bind:url="'{{ url()->to('product') }}'" v-bind:public="'{{ config('constants.publicUrl') }}'"></card-component>

<div class="nav-bottom">
  <div><a href="{{ url()->to('/') }}"><i class="material-icons">home</i></a></div>
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
  <div><a href="{{ route('product.create') }}"><i class="material-icons">add_circle</i></a></div> 
  <div><a href="{{ route('matches.index') }}"><i class="material-icons">message</i></a></div>
  <div><a href="#"><i class="material-icons">person</i></a></div>
</div>
@endsection
@section('scripts')
<!-- vue -->
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@if($user = auth()->user())
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>
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

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
      cluster: 'us3',
      authEndpoint: 'broadcasting/auth',
    });

    var channel = pusher.subscribe('private-users.{{ auth()->user()->id }}');
    channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
      notificationN++;
      notificationEle.html(notificationN);
      notificationEle.show();
      notificationListEle.prepend('<a onclick="markAsRead(this)" data-id="' + data.id + '" class="dropdown-item active" href="' + data.url + '">' + data.message + '</a>');
    });
  </script>
@endif
@endsection