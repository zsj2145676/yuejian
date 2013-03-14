var activityjs = {
	init: function() {

		$('.teacher_bar div').each(function() {
			$(this).mouseover(function() {
				$('.yue_teacher .yue_detail').removeClass("s");
				var s_class = $(this).attr("class");
				$("#yue_" + s_class).addClass("s");
				$("#" + s_class).css("color","#CDF0FF");
			});
			$(this).mouseout(function(){
				var s_class = $(this).attr("class");
				$("#" + s_class).css("color","#70838A");
			});
		});

		$('#link_info').on('click', function(event) {
			$('#banner_if').show();
			$('#banner_photo').hide();
			$('#banner_video').hide();
			$('#banner_info1').css("color","#FFFFFF");
			$('#banner_info2').css("color","#5990FF");
			$('#banner_info3').css("color","#5990FF");
		});
		$('#link_photo').on('click', function(event) {
			$('#banner_if').hide();
			$('#banner_photo').show();
			$('#banner_video').hide();
			$('#banner_info1').css("color","#5990FF");
			$('#banner_info2').css("color","#FFFFFF");
			$('#banner_info3').css("color","#5990FF");
		});
		$('#link_video').on('click', function(event) {
			$('#banner_if').hide();
			$('#banner_photo').hide();
			$('#banner_video').show();
			$('#banner_info1').css("color","#5990FF");
			$('#banner_info2').css("color","#5990FF");
			$('#banner_info3').css("color","#FFFFFF");
		});
		$(".fancybox").fancybox();
		$(".video").fancybox();

	}
};
activityjs.init();