@extends('layouts.app')

@section('content')

<style>
.app-fab--absolute {
  position: fixed;
  bottom: 1rem;
  right: 1rem;
}

@media(min-width: 1024px) {
   .app-fab--absolute {
    bottom: 1.5rem;
    right: 1.5rem;
  }
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Productos</div>

                <div class="panel-body">

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

                                @can('show')
                                <td>
                                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-primary">
                                        Ver
                                    </a>
                                </td>
                                @endcan

                                @can('edit')
                                <td>
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary">
                                        Editar
                                    </a>
                                </td>
                                @endcan

                                @can('destroy')
                                <td>
                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                                @endcan

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
