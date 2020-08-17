@extends('layouts.app')

@section('content')

<style>
    .mdc-fab:not(.mdc-fab--extended) {
        border-radius: 50%;
    }

    .app-fab--absolute {
        position: fixed;
        bottom: 1rem;
        right: 1rem;
        background-color: var(--mdc-theme-primary, #6200ee);
    }

    .mdc-fab {
        box-shadow: 0px 3px 5px -1px rgba(0, 0, 0, 0.2), 0px 6px 10px 0px rgba(0, 0, 0, 0.14), 0px 1px 18px 0px rgba(0, 0, 0, .12);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
        width: 56px;
        height: 56px;
        padding: 0;
        border: none;
        fill: currentColor;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -moz-appearance: none;
        -webkit-appearance: none;
        overflow: hidden;
        transition: box-shadow 280ms cubic-bezier(0.4, 0, 0.2, 1), opacity 15ms linear 30ms, transform 270ms 0ms cubic-bezier(0, 0, 0.2, 1);
        background-color: #018786;
        color: #fff;
        color: var(--mdc-theme-on-secondary, #fff);
    }

    @media(min-width: 1024px) {
        .app-fab--absolute {
            bottom: 1.5rem;
            right: 1.5rem;
        }
    }

    .float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 40px;
        background-color: #0C9;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        box-shadow: 2px 2px 3px #999;
    }

    .my-float {
        margin-top: 22px;
    }
</style>

<a href="{{ route('product.create') }}" class="float">
    <i class="fa fa-plus my-float"></i>
</a>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Productos</div>

                <div class="panel-body">

                    <form action="" method="get">
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <select name="category" id="" class="form-control">
                                    <option value>Seleccionar Categoria</option>
                                    @foreach(App\Category::all() as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == request('category') ? 'selected' : '' }}>
                                        {{$category->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-9">
                                <input type="text" placeholder="Buscador" name="search" value="{{ request('search') }}" class="form-control">
                            </div>
                        </div>
                    </form>


                    @can('create')

                    <a href="{{ route('product.create') }}" class="mdc-fab app-fab--absolute" aria-label="F+">
                        <span class="mdc-fab__icon material-icons">+</span>
                    </a>
                    @endcan

                    <table class="table table-striped">
                        @foreach($products as $product)
                        <tbody>
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>Favoritos: {{ count($product->favorites()->get()) }}</td>

                                <td>
                                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-primary">
                                        Ver
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary">
                                        Editar
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection