@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">@lang('clients.Create_client')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-group" action="{{route('clients.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">@lang('clients.Name')</label>
                            <input class="form-control" type="text" name="name" id="name" value="">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="create">@lang('clients.Create')</button>
                            <a class="btn btn-info" href="{{route('clients.index')}}">@lang('clients.Back')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
