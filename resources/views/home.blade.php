@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <div class="search-box">
            <form class="form-inline" method="post" action="/admin/search" >
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" id="" name="word">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Total {{$datas->total()}}</div>

            <div class="panel-body">
                @foreach($datas as $data)
                <p class=""><strong>{{ucfirst($data->word_name)}}</strong> : {{$data->meaning_meaning}}</p>
                @endforeach
                <div class="text-center">{{ $datas->links() }}</div>
            </div>
        </div>
    </div>
@endsection
