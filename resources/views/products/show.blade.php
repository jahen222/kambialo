
@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
   <li><a href="{{route('products.index')}}">Productos</a></li>
   <li class="active">{{$product->name}}</li>
</ol>
<div class="container">
   <div class="row">
       <div class="col-md-8">
          <div class="well">
               <h1>{{ $product->name }}</h1>
               <img style="width:100%" src="/images/{{$product->image}}" alt="{{$product->image}}">
               <br><br>
               <p class="blog-product-meta">Categoría: {{ $product->category->name }} </p>
               <p class="blog-product-meta">Propietario: {{ $product->user->email }} </p>
               <p class="blog-product-meta">Publicado: {{ $product->created_at }} </p>
               <p>{!! $product->description !!}</p>
          </div>
       </div>
       @if(!Auth::guest())
           @if ($product->user_id === Auth::user()->id)
           <div class="col-md-4">
               <div class="well">
                   <h1>Opciones</h1>
                   <hr>
                   <a href="{{ route('product.edit', $product->id)}}" class="btn btn-primary">Editar Producto</a>
                   <form action="{{route('product.destroy', $product->id)}}" method="POST" class="pull-right">
                       <input type="hidden" name="_method" value="DELETE">
                       {{ csrf_field() }}
                       <button type="submit" class="btn btn-danger">Eliminar Producto</button>
                   </form>
               </div>
           </div>
           @endif
       @endif
   </div>
</div>
@endsection
