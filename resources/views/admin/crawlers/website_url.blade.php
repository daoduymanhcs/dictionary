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
            @if(Session::has('status'))
            <div class="alert alert-success" role="alert">{{Session('status')}}</div>
            @endif
            <form method="post" action="{{ route('fetch_website') }}">
                 {{ csrf_field() }}
              <div class="form-group">
                <label for="textUrl">Links</label>
                <textarea class="form-control" id="textUrl" rows="5" value="" name="urls">{{ isset($urls) ? $urls : '' }}</textarea>
              </div>
              <div class="form-group">
                <label for="regex">Regex</label>
                <input type="text" class="form-control" id="regex" placeholder="" name="regex" value="{{ isset($regex) ? $regex : '' }}">
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="checkbox" value=1> Complete
                </label>
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <div class="form-group">
              <label for="regex">Suggestion</label>
              <textarea class="form-control" id="textUrl" rows="7" value="" name="">
                <tr.*?>.*?<td.*?>(.+?)</td>.*?<td.*?>(.+?)</td>.*?</tr>
                <strong>(.+?)</strong>(.+?)</p>
                <h[0-9]>(.+?)</h[0-9]>(.+?)</p>
                <b>(.+?)</b>(.+?)</p>
                <dt>(.+?)</dt>(.+?)</dd>
                <p>(.+?)[:=-](.+?)</p>
              </textarea>
            </div>
        </div>
    </div>
    @if(isset($results))
    <div class="panel panel-default">
      <div class="panel-heading">Result</div>
      <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Word</th>
              <th>Meaning</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($results as $word => $meaning)
              <tr>
                <th scope="row"></th>
                <td>{{$word}}</td>
                <td>{{$meaning}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endif
@endsection
