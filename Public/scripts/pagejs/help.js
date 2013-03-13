var helpjs = {
	init:function(){
	    
		$('.service_bar li').each(function(){
	        $(this).click(function(){
	        	$('.service_bar li').removeClass("s");
	        	var s_class= $(this).attr("class");
	            $(this).addClass("s");
	            $(".service_body div").removeClass("s");
	            $("."+s_class+"_body").addClass("s");
	            if(s_class == "suggest"){
	                $(".service_bar_foot").removeClass("w");
	                $(".service_foot").removeClass("w");
	                $(".entry_button").show();
	            }else{
	                $(".service_bar_foot").addClass("w");
	                $(".service_foot").addClass("w");
	                $(".entry_button").hide();
	            }
	        });
	    });

	    $(".entry_button").mousedown(function(){
	        $(this).addClass("on");
	    }).mouseup(function(){
	        $(this).removeClass("on");
	    });
	}
};
helpjs.init();



















