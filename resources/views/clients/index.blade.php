@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Clients
                    <a href="{{route('clients.create')}}" style="float:right;font-size:18px;">+</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach ($clients as $key => $value)
                            <tr>
                                <td>{{$value->id}}</td>
                                <td>{{$value->name}}</td>
                                <td>
                                    <a href="{{route('clients.edit', [$value->id])}}">edit</a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" onclick="
                                        $.ajax({
                                            url: '{{route('clients.destroy', [$value->id]).'?_token='.csrf_token()}}',
                                            type: 'DELETE',
                                            success: function(result) {
                                                location.reload();
                                            }
                                        })
                                    ">delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
