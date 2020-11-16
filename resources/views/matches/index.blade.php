@extends('layouts.app')

@section('content')
<style>
table td{
    padding: 0 !important;
    padding-top: 1.1rem!important;
    padding-bottom: 1rem!important;
}
</style>
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
                                <td align="right" width="35%">
									<img style="max-height:80px;" src="{{
										url()->to(config('constants.publicUrl') . 'images/' . $match->user1->products()->whereIn(
										'id', array_column($match->user2->favorites()->get()->toArray(), 'product_id')
									)->first()->cover_image)}}"/></td>
								<td align="center"><img style="max-height:80px;" src="{{url()->to('assets/img/icon-k.png') }}" /></td>
                                <td aling="left" width="35%">
									<img style="max-height:80px;" src="{{
										url()->to(config('constants.publicUrl') . 'images/' . $match->user2->products()->whereIn(
										'id', array_column($match->user1->favorites()->get()->toArray(), 'product_id')
									)->first()->cover_image)}}"/>
								</td>

                                <td style="vertical-align: inherit;">
                                    <a href="{{ route('match.show', $match->id) }}" class="btn btn-sm btn-primary">
                                        Ver
                                    </a>
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
