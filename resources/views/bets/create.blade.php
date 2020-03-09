@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">@lang('bets.Create_bet')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{session('type')}}" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-group" action="{{route('bets.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="competitor">@lang('bets.Competitor')</label>
                            <select class="form-control @error('competitor') is-invalid @enderror" name="competitor" id="competitor">
                                @foreach ($competitors as $key => $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                            @error('competitor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="value">@lang('bets.Value')</label>
                            <input class="form-control @error('value') is-invalid @enderror" type="text" name="value" id="value" value="{{old('value') ?? ''}}">
                            @error('value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="create">@lang('bets.Create')</button>
                            <a class="btn btn-info" href="{{route('bets.index')}}">@lang('bets.Back')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
