@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    @lang('events.Events')
                    <a href="{{route('events.create')}}" style="float:right;font-size:18px;">+</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($events->count())
                        <table class="table">
                            <tr>
                                <th>@lang('events.ID')</th>
                                <th>@lang('events.Description')</th>
                                <th>@lang('events.Competitor')</th>
                                <th>@lang('events.Client')</th>
                                <th>@lang('events.Software')</th>
                                <th>@lang('events.Points')</th>
                                <th>@lang('events.Modified_by')</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($events as $key => $value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->description}}</td>
                                    <td>{{$value->competitor->name ?? ''}}</td>
                                    <td>{{$value->competitor->client->name ?? ''}}</td>
                                    <td>{{$value->software}}</td>
                                    <td>{{$value->points}}</td>
                                    <td>{{$value->user->name}}</td>
                                    <td>
                                        <a href="{{route('events.edit', [$value->id])}}">@lang('events.edit')</a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="
                                            $.ajax({
                                                url: '{{route('events.destroy', [$value->id]).'?_token='.csrf_token()}}',
                                                type: 'DELETE',
                                                success: function(result) {
                                                    location.reload();
                                                }
                                            })
                                        ">@lang('events.delete')</a>
                                    </td>
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
