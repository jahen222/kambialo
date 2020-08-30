@extends('layouts.app')

@section('content')
  <card-component v-bind:cards="[{text: 'test1'}]"></card-component>
@endsection
@section('scripts')
<!-- vue -->
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@endsection