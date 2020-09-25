@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 card">
           <h1>Producto </h1>
           <br/>

           <form action="{{route('product.update', [$product->id]) }}" id="product-form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
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
                        <input type="file" class="custom-file-input" name="cover_image" id="customFile" lang="es">
                        <label class="custom-file-label" for="customFile">Cover Imagen</label>
                    </div>
                    <img style="max-width: 100%;" src="{{ url()->to('images/' . $product->cover_image) }}" alt="">
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
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image1" name="images[0]" lang="es">
                        <label class="custom-file-label" for="image1">Imagen1</label>
                    </div>
                    @if(isset($product->images[0]) && $image = $product->images[0]->image)
                        <img style="max-width: 100%;" src="{{ url()->to('images/' . $image) }}" alt="">
                    @endif
                </div>
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image2" name="images[1]" lang="es">
                        <label class="custom-file-label" for="image2">Imagen2</label>
                    </div>
                    @if(isset($product->images[1]) && $image = $product->images[1]->image)
                        <img style="max-width: 100%;" src="{{ url()->to('images/' . $image) }}" alt="">
                    @endif
                </div>
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image3" name="images[2]" lang="es">
                        <label class="custom-file-label" for="image3">Imagen3</label>
                    </div>
                    @if(isset($product->images[2]) && $image = $product->images[2]->image)
                        <img style="max-width: 100%;" src="{{ url()->to('images/' . $image) }}" alt="">
                    @endif
                </div>
                <div class="form-group">
                    <label for="tag">Tags</label> <br>
                    <select class="custom-select js-basic-multiple" id="tags" name="tags[]" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
              
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
{{-- @include('inc.footer') --}}
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
      <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Procesando...</h4>
        </div>
    </div>
  </div>
</div>

@endsection
