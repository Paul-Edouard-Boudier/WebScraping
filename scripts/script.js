$(document).ready(function() {
	$('.navbar-link').on('click', function(e) {
		e.preventDefault();
		console.log($(this).attr('data-link'));
		// $("#file-loader").load("templates/"+$(this).attr('data-link')+".php", function(data) {
		// 	// console.log(data);
		// });
		jQuery.ajax({
			url: "functions/scraping.php",
			data: $(this).attr('data-link')+'='+$(this).attr('data-link'),
			type: "POST",
			success:function(data){$("#file-loader").html(data);}
		});
	})

 // $('.popup').on('click', function() {
 // 	// var popup = $(this);
 // 	// var popup = $('#myPopup');
 // 	// console.log(popup span:last-child);
 // 	var popup = $(this).children().last();
 // 	console.log(popup);
 //  popup.toggle("show");
 // })
	$('.popup').hover(function() {
	 	var popup = $(this).children().last();
	 	console.log(popup);
	  popup.toggle("show");
	}, function() {
		var popup = $(this).children().last();
	 	console.log(popup);
	  popup.toggle("show");
	});

 	$('[data-league]').on('click', function(){
 		$('[data-leagues]>div.active').removeClass('active');
 		var league = $(this).attr('data-league');
 		$(this).addClass('active');
 		if (league == 'eu') {
 			$('.eu').show();
 			$('.na, .lck, .lpl').hide();
 		} else if (league == 'na') {
 			$('.na').show();
 			$('.eu, .lck, .lpl').hide();
 		} else if (league == 'lck'){
 			$('.lck').show();
 			$('.eu, .na, .lpl').hide();
 		} else {
 			$('.lpl').show();
 			$('.eu, .na, .lck').hide();
 		}
 	});	
});