@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group">
              <li class="list-group-item">
                <span class="badge">14</span>
                Words
              </li>
              <li class="list-group-item">
                <span class="badge">14</span>
                Authors
              </li>
            </ul>
        </div>
        <div class="col-md-9">
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
    </div>
</div>
@endsection
