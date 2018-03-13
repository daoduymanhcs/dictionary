@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Total {{$datas->total()}}</div>

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
                  <tr>
                    <th scope="row"></th>
                    <td>{{ucfirst($data->word_name)}}</td>
                    <td>{{$data->meaning_meaning}}</td>
                    <td>
                        <span type="button" class="btn btn-info">Info</span>
                        <span type="button" class="btn btn-warning" onclick="myFunction()">Warning</span>
                        <span type="button" class="btn btn-danger">Danger</span>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="text-center">{{ $datas->links() }}</div>
        </div>
    </div>
@endsection

@section('script')
<script>
function myFunction() {
    alert('hello');
}
</script>
@endsection
