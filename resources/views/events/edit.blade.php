@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit event</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-group" action="{{route('events.update', [$event->id])}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="put" />
                        <input class="form-control" type="text" name="description" value="{{$event->description}}">
                        <input class="form-control" type="text" name="software" value="{{$event->software}}">
                        <select class="form-control" name="competitor">
                            @foreach ($competitors as $key => $value)
                                <option value="{{$key}}" {{$key==$event->competitor_id?'selected':''}}>{{$value}}</option>
                            @endforeach
                        </select>
                        <input class="form-control" type="text" name="points" value="{{$event->points}}">
                        <button class="btn btn-primary" type="submit" name="edit">Edit</button>
                        <a class="btn btn-info" href="{{route('events.index')}}">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
