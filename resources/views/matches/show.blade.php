@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="well">
        <h1>{{ $usermatch->name }}</h1>
        <br><br>
        <p class="blog-product-meta">Email: {{ $usermatch->email }} </p>
      </div>
    </div>
  </div>
</div>
@endsection