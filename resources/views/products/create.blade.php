@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
           <h1>Producto Nuevo </h1>
           <br/>

           <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="category">Categoría del producto</label>
                    <?php
                        $categories = App\Category::all();
                     ?>
                    <select class="form-group" id="category" name="category" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nombre del producto</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="description">Descripción del producto</label>
                    <textarea class="form-control" name="description" id="article-ckeditor" cols="30" rows="10" required></textarea>
                </div>
                <div class="form-group">
                    <label for="cover_image">Imagen</label>
                    <input type="file" id="image" name="image">
                </div>

                <button type="submit" class="btn btn-success">Crear</button>
            </form>
        </div>
    </div>
{{-- @include('inc.footer') --}}
</div>
@endsection
