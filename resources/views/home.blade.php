@extends('layouts.app')

@push('after-scripts')
    @if($chart)
    {!! $chart->script() !!}
    @endif
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Classifica</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! $chart->container() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
