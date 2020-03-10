@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    @lang('competitors.Competitors')
                    <a href="{{route('competitors.create')}}" style="float:right;font-size:18px;">+</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{session('type')}}" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($competitors->count())
                        <table class="table">
                            <tr>
                                <th>@lang('competitors.ID')</th>
                                <th>@lang('competitors.Name')</th>
                                <th>@lang('competitors.Client')</th>
                                <th>@lang('competitors.Category')</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($competitors as $key => $value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->client->name}}</td>
                                    <td>{{$value->category}}</td>
                                    <td>
                                        <a href="{{route('competitors.edit', [$value->id])}}">@lang('competitors.edit')</a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="
                                            $.ajax({
                                                url: '{{route('competitors.destroy', [$value->id]).'?_token='.csrf_token()}}',
                                                type: 'DELETE',
                                                success: function(result) {
                                                    location.reload();
                                                }
                                            })
                                        ">@lang('competitors.delete')</a>
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
