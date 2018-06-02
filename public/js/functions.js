// FUNCTION TO CREATE NOTIFICATION
	function createNotification (message) {
		$('._head').append("<div class='notification'>"+message+"</div>");

		setTimeout(function(){$(document).find('.notification').addClass('showNotification');},10);

		$(document).on('click','.notification',function(){
			$(this).removeClass('showNotification');

			setTimeout(function(){$(this).remove();},400);
		});

		setTimeout(function(){
			$(document).find('.notification').removeClass('showNotification');

			setTimeout(function(){$(document).find('.notification').remove();},400);
		},4000);
	}