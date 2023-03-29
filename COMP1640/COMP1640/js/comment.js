$(document).ready(function(){
	// When user clicks on submit comment to add comment under post
	$(document).on('click', '#submit_comment', function(e) {
		e.preventDefault();
		var commentContent = $('#commentContent').val();
		var url = $('#comment_form').attr('action');
		// Stop executing if not value is entered
		if (commentContent === "" ) return;
		$.ajax({
			url: url,
			type: "POST",
			data: {
				commentContent: commentContent,
				commentPosted: 1
			},
			success: function(data){
				var response = JSON.parse(data);
				if (data === "error") {
					alert('There was an error adding comment. Please try again');
				} else {
					$('#comments-wrapper').prepend(response.comment)
					$('#comments_count').text(response.comments_count); 
					$('#comment_text').val('');
					location.reload();
				}
			}
		});
	});
});