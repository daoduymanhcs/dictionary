$(document).ready(function(){
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
});

function updateMeaningLike($id) {
	$.ajax({
	  url: '/update-meaning-like',
	  type: 'post',
	  data: { meaning_id: $id},
	  dataType: 'JSON',
	  success: function(response){
	    console.log(response);
	    if(response.status) {
			$newLikeNumber = parseInt($('#like_'+ $id).text()) + 1;
			$('#like_'+ $id).text($newLikeNumber);
	    }
	  }
	});
}

function updateMeaningDislike($id) {
	$.ajax({
	  url: '/update-meaning-dislike',
	  type: 'post',
	  data: { meaning_id: $id},
	  dataType: 'JSON',
	  success: function(response){
	    console.log(response);
	    if(response.status) {
			$newLikeNumber = parseInt($('#dislike_'+ $id).text()) + 1;
			$('#dislike_'+ $id).text($newLikeNumber);
	    }
	  }
	});
}