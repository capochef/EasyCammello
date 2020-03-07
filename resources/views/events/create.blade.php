@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">@lang('events.Create_event')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-group" action="{{route('events.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="description">@lang('events.Description')</label>
                            <input class="form-control" type="text" name="description" id="description" value="">
                        </div>
                        <div class="form-group">
                            <label for="software">@lang('events.Software')</label>
                            <input class="form-control" type="text" name="software" id="software" value="">
                        </div>
                        <div class="form-group">
                            <label for="competitor">@lang('events.Competitor')</label>
                            <select class="form-control" name="competitor" id="competitor">
                                @foreach ($competitors as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="points">@lang('events.Points')</label>
                            <input class="form-control" type="text" name="points" id="points" value="">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="create">@lang('events.Create')</button>
                            <a class="btn btn-info" href="{{route('events.index')}}">@lang('events.Back')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
