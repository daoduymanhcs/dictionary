@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">URL</div>
        <div class="panel-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('fetch_website') }}">
                 {{ csrf_field() }}
              <div class="form-group">
                <label for="textUrl">Links</label>
                <textarea class="form-control" id="textUrl" rows="5" value="" name="urls">{{ isset($urls) ? $urls : '' }}</textarea>
              </div>
              <div class="form-group">
                <label for="regex">regex</label>
                <input type="text" class="form-control" id="regex" placeholder="" name="regex" value="{{ isset($regex) ? $regex : '' }}">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
@endsection
