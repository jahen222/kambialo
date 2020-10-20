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
                                <td align="right" width="40%">
									<img style="max-height:80px;" src="{{
										url()->to(config('constants.publicUrl') . 'images/' . $match->user1->products()->whereIn(
										'id', array_column($match->user2->favorites()->get()->toArray(), 'product_id')
									)->first()->cover_image)}}"/></td>
								<td align="center"><img style="max-height:80px;" src="{{url()->to('assets/img/icon-k.png') }}" /></td>
                                <td aling="left" width="40%">
									<img style="max-height:80px;" src="{{
										url()->to(config('constants.publicUrl') . 'images/' . $match->user2->products()->whereIn(
										'id', array_column($match->user1->favorites()->get()->toArray(), 'product_id')
									)->first()->cover_image)}}"/>
								</td>

                                @can('show')
                                <td style="vertical-align: inherit;">
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
