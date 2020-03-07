@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create client</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-group" action="{{route('clients.store')}}" method="post">
                        @csrf
                        <input class="form-control" type="text" name="name" value="">
                        <button class="btn btn-primary" type="submit" name="create">Create</button>
                        <a class="btn btn-info" href="{{route('clients.index')}}">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
