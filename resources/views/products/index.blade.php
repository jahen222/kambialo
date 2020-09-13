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

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Productos</div>
                <div class="panel-body">

                    
                    <a href="{{ route('product.create') }}" class="float">
                        <i class="fa fa-plus my-float"></i>
                    </a>
                    

                    <table class="table table-striped">
                        @foreach($products as $product)
                        <tbody>
                            <tr>
                                <td><img style="max-height:50px;" src="{{url()->to('images/' . $product->cover_image)}}" /></td>
                                <td style="vertical-align: middle;">{{ $product->name }}</td>
                                <td style="vertical-align: middle;">Favoritos: {{ count($product->favorites()->get()) }}</td>
                                <td style="vertical-align: middle;">
                                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-primary">
                                        Ver
                                    </a>
                                </td>
                                <td style="vertical-align: middle;">
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary">
                                        Actualizar
                                    </a>
                                </td>
                                <td style="vertical-align: middle;">
                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-sm btn-danger" style="margin:0;">
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
