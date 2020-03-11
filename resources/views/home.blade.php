@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Classifica</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <label for="rank"><b>@lang('Cammello')</b></label>
                    <div class="form-group" id="rank">

                    @foreach ($competitors as $competitor)
                        <div class="col-12">
                            <label for="camello_{{$competitor->id}}" style="width:100px;">{{$competitor->name}}-{{$competitor->client->name}}</label>
                            <img class="cammello" id="camello_{{$competitor->id}}" style="padding-left:5%;height:60px" title="{{$competitor->name}}-{{$competitor->client->name}}" src="{{asset('images/running-camel.gif')}}"></img>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-scripts')

<script type="text/javascript">
    $(document).ready(function(){
        @foreach ($competitors as $competitor)
            $('#camello_{{$competitor->id}}').animate({paddingLeft: "+={{$competitor['points']*70}}%"}, 1500);
        @endforeach
    })
</script>
@endpush
