@extends('admin.layouts.app')
@section('css')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />
@endsection
@section('content')
	<div class="container">
		<div class="row">
		  <div class="col-md-6 col-md-offset-2">
		  	<div class="introduction">
		  		<h1>Tratunhanh.com</h1>
		  		<p>Tratunhanh.com luôn cập nhật thuật ngữ mới nhất, xu hướng nhất. Bạn có thể giúp đỡ cộng đồng bằng cách thêm từ và ý nghĩa mới. </p>
		  		<p>Từ điển cung cấp {{$datas->total()}} ý nghĩa.</p>
		  	</div>
		  	@foreach ($datas as $data)
			  	<div class="detail">
			  		<div class="detail-header">
			  			<div class="pull-right">
			  				<span id="like_{{$data->id}}">{{$data->meaning_like}}</span> <i class="far fa-thumbs-up fa-2x" onclick="updateMeaningLike({{$data->id}})"></i>
			  				<span id="dislike_{{$data->id}}">{{$data->meaning_dislike}}</span> <i class="far fa-thumbs-down fa-2x" onclick="updateMeaningDislike({{$data->id}})"></i>
			  			</div>
						<h2><a href="{{$data->core_name}}">{{ucfirst($data->word_name)}}</a></h2>
			  		</div>
			  		<p>{{$data->meaning_meaning}}</p>
			  		@if(!empty($data->author_name))
			  			<p class="author"><b>Nguồn</b>: <i>{{$data->author_name}}</i></p>
			  		@endif
			  	</div>
			@endforeach
			<!-- <div class="text-center">{{ $datas->links() }}</div> -->
			<nav aria-label="...">
			  <ul class="pager">
			    <li class="previous {{$datas->previousPageUrl() ? '' : 'disabled'}}"><a href="{{$datas->previousPageUrl()}}"><span aria-hidden="true">&larr;</span> Trang trước</a></li>
			    <li class="next {{$datas->nextPageUrl() ? '' : 'disabled'}}"><a href="{{$datas->nextPageUrl()}}">Trang sau <span aria-hidden="true">&rarr;</span></a></li>
			  </ul>
			</nav>
		  </div>
		</div>
	</div>
@endsection

@section('script')
<script src="{{ asset('js/frontend.js') }}"></script>
@endsection