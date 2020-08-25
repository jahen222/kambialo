@extends('layouts.app')

@section('content')
  <card-component v-bind:cards="[{text: 'test1'}]"></card-component>
@endsection