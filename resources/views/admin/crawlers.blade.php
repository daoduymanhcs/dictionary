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
            <form method="post" action="/admin/crawls">
                {{ csrf_field() }}
              <div class="form-group">
                <label for="exampleInputEmail1">URL</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="URL" name="url">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
