@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Producto Nuevo </h1>
            <br />

            <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="category">Categoría del producto</label>
                    <select class="form-group" id="category" name="category" required>
                        @foreach($categories as $category)
                        @if($category->name != 'Todos')
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="cover_image">Cover Imagen</label>
                    <input type="file" id="cover_image" name="cover_image">
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
                    <label for="tag">Tags</label> <br>
                    <select class="form-group" id="tags" name="tags[]" multiple>
                        @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Crear</button>
            </form>
        </div>
    </div>
    {{-- @include('inc.footer') --}}
</div>
@endsection