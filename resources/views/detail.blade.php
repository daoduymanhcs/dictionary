@extends('admin.layouts.app')
@section('css')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />
@endsection
@section('content')
	<div class="container">
		<div class="row">
		  <div class="col-md-6 col-md-offset-2">
		  	<div class="introduction">
		  		<h1>{{$word}} là gì:</h1>
		  		<p>{{$word}} nghĩa là gì? Ở đây bạn tìm thấy {{count($datas)}} ý nghĩa của từ {{$word}}.</p>
		  	</div>
		  	@foreach ($datas as $data)
			  	<div class="detail">
			  		<div class="detail-header">
			  			<div class="pull-right">
			  				{{$data->meaning_like}} <i class="far fa-thumbs-up fa-2x"></i>
			  				{{$data->meaning_dislike}} <i class="far fa-thumbs-down fa-2x"></i>
			  			</div>
						<h2><a href="{{$data->core_name}}">{{ucfirst($data->word_name)}}</a></h2>
			  		</div>
			  		<p>{{$data->meaning_meaning}}</p>
			  		@if(!empty($data->author_name))
			  			<p class="author"><b>Nguồn</b>: <i>{{$data->author_name}}</i></p>
			  		@endif
			  	</div>
			@endforeach
		  </div>
		</div>
	</div>
@endsection