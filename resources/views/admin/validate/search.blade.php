@extends('layouts.app')

@section('content')
    <div class="search-box">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form class="form-inline" method="post" action="/admin/search" >
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" class="form-control" name="word" value="{{ old('word') }}">
            </div>
            <button type="submit" class="btn btn-default">Search</button>
        </form>
    </div>
    @if(isset($datas))
    <div class="panel panel-default">
        <div class="panel-heading">Search <a class="pull-right" href="{{Route('validate')}}"><i class="fas fa-sync"></i></a></div>
        <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Word</th>
                  <th>Meaning</th>
                  <th>CRUD</th>
                </tr>
              </thead>
              <tbody>
                @foreach($datas as $data)
                  <tr id="{{$data->id}}">
                    <td>{{$data->id}}</td>
                    <td>{{ucfirst($data->word_name)}}</td>
                    <td>{{$data->meaning_meaning}}</td>
                    <td>
                      <div class="btn-group btn-group-justified btn-group-modify" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-primary"><i class="far fa-edit"></i></button>
                        </div>
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-success" onclick="updateMeaningStatus({{$data->id}})"><i class="fas fa-check"></i></button>
                        </div>
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-danger" onclick="deleteMeaning({{$data->id}})"><i class="far fa-trash-alt"></i></button>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>
    @endif
@endsection

@section('script')
<script>
  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  });
  function deleteMeaning($id) {
      $.ajax({
          url: '/admin/delete-meaning',
          type: 'post',
          data: { meaning_id: $id},
          dataType: 'JSON',
          success: function(response){
            console.log(response.status);
            if(response.status) {
              $( "#" + response.id).hide();
            }
          }
      });
  }

  function updateMeaningStatus($id) {
      $.ajax({
          url: '/admin/update-meaning-status',
          type: 'post',
          data: { meaning_id: $id},
          dataType: 'JSON',
          success: function(response){
            if(response.status) {
              $( "#" + response.id).hide();
            }
          }
      });
  }

  function updatePageMeaningStatus($idArrays) {
      $.ajax({
          url: '/admin/update-page-meaning-status',
          type: 'post',
          data: { id_meaning_array: $idArrays},
          dataType: 'JSON',
          success: function(response){
            if(response.status) {
              console.log(response);
              location.reload();
            }
          }
      });    
  }
</script>
@endsection
