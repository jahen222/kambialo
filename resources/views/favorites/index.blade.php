@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Favoritos</div>

                <div class="panel-body">
                    <table class="table table-striped">
                        @foreach($favorites as $favorite)
                        <tbody>
                            <tr>
                                <td>{{ $favorite->id }}</td>
                                <td>{{ $favorite->product()->get()[0]->name }}</td>


                                @can('product.show')
                                <td>
                                    <a href="{{ route('product.show', $favorite->product()->get()[0]->id) }}" class="btn btn-sm btn-primary">
                                        Ver
                                    </a>
                                </td>
                                @endcan

                                @can('product.destroy')
                                <td>
                                    <form action="{{route('favorite.store')}}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="product" value="{{ $favorite->product()->get()[0]->id }}">
                                        <button type="submit" class="btn btn-sm btn-danger">Quitar a Favoritos</button>
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
