@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
           <h1>Producto Nuevo </h1>
           <br/>

           <form action="{{route('product.update', [$product->id]) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="category">Categoría del producto</label>
                    <select class="form-group" id="category" name="category" required>
                        <option value="{{ $product->category->id }}">{{ $product->category->name }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="cover_image">Cover Imagen</label>
                    <input type="file" id="cover_image" name="cover_image">
                </div>
                <div class="form-group">
                    <label for="name">Nombre del producto</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Descripción del producto</label>
                    <textarea class="form-control" name="description" id="article-ckeditor" cols="30" rows="10" required>{{ $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image1">Imagen1</label>
                    <input type="file" id="image1" name="image1">
                </div>
                <div class="form-group">
                    <label for="image2">Imagen2</label>
                    <input type="file" id="image2" name="image2">
                </div>
                <div class="form-group">
                    <label for="image3">Imagen3</label>
                    <input type="file" id="image3" name="image3">
                </div>
                <div class="form-group">
                    <label for="image4">Imagen4</label>
                    <input type="file" id="image4" name="image4">
                </div>
                <div class="form-group">
                    <label for="image5">Imagen5</label>
                    <input type="file" id="image5" name="image5">
                </div>
                <div class="form-group">
                    <label for="image6">Imagen6</label>
                    <input type="file" id="image6" name="image6">
                </div>
                <div class="form-group">
                    <label for="image7">Imagen7</label>
                    <input type="file" id="image7" name="image7">
                </div>
                <div class="form-group">
                    <label for="image8">Imagen8</label>
                    <input type="file" id="image8" name="image8">
                </div>
                <div class="form-group">
                    <label for="image9">Imagen9</label>
                    <input type="file" id="image9" name="image9">
                </div>
                <div class="form-group">
                    <label for="image10">Imagen10</label>
                    <input type="file" id="image10" name="image10">
                </div>
                <div class="form-group">
                    <label for="tag">Tags</label> <br>
                    <select class="form-group" id="tags" name="tags[]" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
              
                <button type="submit" class="btn btn-primary">Editar</button>
            </form>
        </div>
    </div>
{{-- @include('inc.footer') --}}
</div>
@endsection
