@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Total {{$datas->total()}} <a class="pull-right" href="{{Route('validate')}}"><i class="fas fa-sync"></i></a></div>
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
                @if(!empty($ids))
                  <tr id="">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                      <div class="btn-group btn-group-justified btn-group-modify" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-success" onclick="updatePageMeaningStatus(Array({{$ids}}))"><i class="fas fa-check"></i></button>
                        </div>
                        <div class="btn-group" role="group">
                          <button type="button" class="btn btn-danger" onclick=""><i class="far fa-trash-alt"></i></button>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endif
              </tbody>
            </table>
            <div class="text-center">{{ $datas->links() }}</div>
        </div>
    </div>
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
