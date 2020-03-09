@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    @lang('bets.Bets')
                    <a href="{{route('bets.create')}}" style="float:right;font-size:18px;">+</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{session('type')}}" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($bets->count())
                        <table class="table">
                            <tr>
                                <th>@lang('bets.ID')</th>
                                <th>@lang('bets.User')</th>
                                <th>@lang('bets.Competitor')</th>
                                <th>@lang('bets.Client')</th>
                                <th>@lang('bets.Value')</th>
                                @can('isAdmin')
                                    <th></th>
                                    <th></th>
                                @endcan
                            </tr>
                            @foreach ($bets as $key => $value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->user->name}}</td>
                                    <td>{{$value->competitor->name ?? ''}}</td>
                                    <td>{{$value->competitor->client->name ?? ''}}</td>
                                    <td>{{$value->value}}</td>
                                    @can ('isAdmin')
                                        <td>
                                            <a href="{{route('bets.edit', [$value->id])}}">@lang('bets.edit')</a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="
                                            $.ajax({
                                                url: '{{route('bets.destroy', [$value->id]).'?_token='.csrf_token()}}',
                                                type: 'DELETE',
                                                success: function(result) {
                                                    location.reload();
                                                }
                                            })
                                            ">@lang('bets.delete')</a>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
