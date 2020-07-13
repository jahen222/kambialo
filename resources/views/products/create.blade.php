@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Producto Nuevo </h1>
            <br />

            <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label for="category ">Categoría del producto</label>   
                            
                        </div>
                        <div class="col-8">
                            <select class="form-control" id="category" name="category" required>
                                <option value>Seleccionar Categoria</option>
                                @foreach($categories as $category)
                                @if($category->name != 'Todos')
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                                @endforeach
                            </select>                            
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" lang="es">
                      <label class="custom-file-label" for="customFile">Cover Imagen</label>
                    </div>
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
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image1" lang="es">
                      <label class="custom-file-label" for="image1">Imagen1</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image2" lang="es">
                      <label class="custom-file-label" for="image2">Imagen2</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image3" lang="es">
                      <label class="custom-file-label" for="image3">Imagen3</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tag">Tags</label> <br>
                    <select class="custom-select js-basic-multiple" id="tags" name="tags[]" multiple>
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