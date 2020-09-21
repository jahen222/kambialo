@extends('layouts.app')

@section('content')
  <card-component v-bind:category="'{{ request('category') }}'" v-bind:url="'{{ url()->to('product') }}'"></card-component>
@endsection
@section('scripts')
<!-- vue -->
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@endsection