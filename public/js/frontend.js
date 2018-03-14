$(document).ready(function(){
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
});

function updateMeaningLike($id) {
	$newLikeNumber = parseInt($('#like_'+ $id).text()) + 1;
	$('#like_'+ $id).text($newLikeNumber);
	$.ajax({
	  url: '/update-meaning-like',
	  type: 'post',
	  data: { meaning_id: $id},
	  dataType: 'JSON',
	  success: function(response){
	    console.log(response);
	    if(response.status) {
	      $( "#" + response.id).hide();
	    }
	  }
	});
}

function updateMeaningDislike($id) {
	$newLikeNumber = parseInt($('#dislike_'+ $id).text()) + 1;
	$('#dislike_'+ $id).text($newLikeNumber);
	$.ajax({
	  url: '/update-meaning-like',
	  type: 'post',
	  data: { meaning_id: $id},
	  dataType: 'JSON',
	  success: function(response){
	    console.log(response);
	    if(response.status) {
	      $( "#" + response.id).hide();
	    }
	  }
	});
}