@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">@lang('competitors.Edit_competitor')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-group" action="{{route('competitors.update', [$competitor->id])}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="put" />
                        <div class="form-group">
                            <label for="name">@lang('competitors.Name')</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{$competitor->name}}">
                        </div>
                        <div class="form-group">
                            <label for="category">@lang('competitors.Category')</label>
                            <input class="form-control" type="text" name="category" id="category" value="{{$competitor->category}}">
                        </div>
                        <div class="form-group">
                            <label for="client">@lang('competitors.Client')</label>
                            <select class="form-control" name="client" id="client">
                                @foreach ($clients as $key => $value)
                                    <option value="{{$key}}" {{$key==$competitor->competitor_id?'selected':''}}>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="edit">@lang('competitors.Edit')</button>
                            <a class="btn btn-info" href="{{route('competitors.index')}}">@lang('competitors.Back')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
