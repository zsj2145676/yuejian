var activityjs = {
	init:function(){
	    
		$('.teacher_bar div').each(function(){
	        $(this).mouseover(function(){
	        	$('.yue_teacher .yue_detail').removeClass("s");
	        	var s_class= $(this).attr("class");
	            $("#yue_"+s_class).addClass("s");
	        });
	    });
	}
};
activityjs.init();



















