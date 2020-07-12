@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Matches</div>

                <div class="panel-body">
                    <table class="table table-striped">
                        @foreach($matches as $match)
                        <tbody>
                            <tr>
                                <td>{{ $match->id }}</td>
                                <td>{{ $match->user_id_1 }}</td>
                                <td>{{ $match->user_id_2 }}</td>

                                @can('show')
                                <td>
                                    <a href="{{ route('match.show', $match->id) }}" class="btn btn-sm btn-primary">
                                        Ver
                                    </a>
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