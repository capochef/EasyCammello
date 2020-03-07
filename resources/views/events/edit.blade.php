@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">@lang('events.Edit_event')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-group" action="{{route('events.update', [$event->id])}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="put" />
                        <div class="form-group">
                            <label for="description">@lang('events.Description')</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{$event->description}}">
                        </div>
                        <div class="form-group">
                            <label for="software">@lang('events.Software')</label>
                            <input class="form-control" type="text" name="software" id="software" value="{{$event->software}}">
                        </div>
                        <div class="form-group">
                            <label for="competitor">@lang('events.Competitor')</label>
                            <select class="form-control" name="competitor" id="competitor">
                                @foreach ($competitors as $key => $value)
                                    <option value="{{$key}}" {{$key==$event->competitor_id?'selected':''}}>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="points">@lang('events.Points')</label>
                            <input class="form-control" type="text" name="points" id="points" value="{{$event->points}}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="edit">@lang('events.Edit')</button>
                            <a class="btn btn-info" href="{{route('events.index')}}">@lang('events.Back')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
