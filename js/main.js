$(document).ready(function(){
	$('#findApartments').click(function(event){
		$('.ajax-loader').show();
		$.ajax({
			url:'/main/ajax',
			type:'post',
			data:  $('#searchForm').serialize(),
			success: function(result){
				$(".searchResult").html(result);

				var destination = $('.searchResult').offset().top;
				//if ($.browser.safari) {
				//	$('body').animate({ scrollTop: destination }, 1100); //1100 - скорость
				//} else {
				$('.ajax-loader').hide();
					$('html').animate({ scrollTop: destination }, 1100);
				//}
			}

		});
		return false;
	});
});