var indexjs = {
	//pagedom begin
	init:function(){
		var oThis = this;
		this.$container = $('#container');
		this.$container.imagesLoaded(function(){
		   oThis.$container.masonry({
			itemSelector : '.box',
			columnWidth: 10,
			isAnimated: !Modernizr.csstransitions,
			isFitWidth: true
		  });
		});
	    this.initAgain();
	    this.guideNewUser();
	},
	initAgain:function(){
		var oThis = this;
	    $('.box').each(function(){
			$(this).mouseover(function(){
				$(this).find('.yjbtn').removeClass('hide');	
			});	
			$(this).mouseout(function(){
				$(this).find('.yjbtn').addClass('hide');
			});
		});
		$('.GridComment').focus(function(){
			$(this).addClass('comment-with-avatar');
			$(this).closest('.write').find('.img').addClass('comment-avatar-show');
		});
		$('.GridComment').blur(function(){
			$(this).removeClass('comment-with-avatar');
			$(this).closest('.write').find('.img').removeClass('comment-avatar-show');
		});
		$('.yjbtn').click(function(){
			$('.write').hide();
			$(this).parent().find('.write').show();
			oThis.$container.masonry({
				itemSelector : '.box',
				columnWidth: 10,
				isFitWidth: true,
				isResizable: true
			});
	        $(this).parent().find('.GridComment').focus();
		});
		$('.cmt_tit').each(function(){
	        $(this).find('a').click(function(){
	            $('.box').find('.cmt_del').hide();
	            $('.box').find('.cmt_tit').css('display','inline-block');
	            $(this).closest('.box').find('.cmt_tit').hide();
	            $(this).closest('.box').find('.cmt_del').css('display','inline-block');
	            oThis.$container.masonry({
	                itemSelector : '.box',
	                columnWidth: 10,
	                isFitWidth: true,
	                isResizable: true
	            });
	        });
	    });
	    $('.guide_btn').click(function(){
	        $(this).closest('.guide').hide();
	        if(!$(this).closest('.guide').hasClass('guidein5')){
	            $(this).closest('.guide').next().show();
	        }else{
	            $('#bflog').hide();
	        }
	    });
	    $('.guide_close').click(function(){
	       $(this).closest('.guide').hide();
	       $('#bflog').hide(); 
	    });
		$('.write').find('textarea').keydown(function(){
			var tradeid = $(this).closest('.box').attr('tradeid');
			var money = $(this).val();
			if(event.keyCode == 13){
				yj_bidding.bid(money,tradeid);
			}
		});
		$('.grid_comment_button').click(function(){
			var tradeid = $(this).closest('.box').attr('tradeid');
			var money = $(this).closest('form').find('textarea').val();
			var price = $(this).closest('.box').find('.red').html();
			console.log(price);
			price = parseInt(price.substring(1,price.length-1));
			// yj_bidding.bid(money,tradeid);
			yj_baptrade.quickBap(tradeid,money,price);
		});
	    //pagedom end
	},
	cmmitPerson:function(str){
		if(yj_base.uid == undefined){
			alert('请登录后再做评价~');
			return ;
		}
		var charter,uid;
		charter = $(str).attr('title');
		if(charter = "帅"){
			charter = "shuai";
		}else if(charter = "萌"){
			charter = "meng";
		}else{
			charter = "niu";
		}
		uid = $(str).closest('.box').attr('uid');
		this.ajaxCmmit(charter,uid,function(data){
			data = parseInt(data);
			if(data == 1){
				var ss = $(str).find('p').html();
				$(str).find('p').html((parseInt(ss)+1).toString());
				var aa = $(str).closest('.box').find('.commit_tit').find('p').find('span').html();
				$(str).closest('.box').find('.commit_tit').find('p').find('span').html((parseInt(aa)+1).toString());
			}else if(data == 2){
				alert("您已经评价过此人了~去评价别人吧~");
			}else{

			}
		});
	},
	ajaxCmmit:function(charter,uid,success){
		$.ajax({
			type    : "POST",
            url     : "/yuejian/h.php?m=Relation&a=approve",
            async : false,
            data : {type:charter,target:uid},
            success : function(data) {
             success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                yj_base.alertBackground();
            }
		});
	},
	guideNewUser:function(){
		this.ajaxGuide(function(data){
			if(data == 1){
				$('#bflog').show();
	    		$('.guidein1').show();
			}else{
				return ;
			}
		},function(){
			yj_base.alertBackground();
		});
	},
	ajaxGuide:function(success,error){
	$.ajax({
			type    : "POST",
            url     : "/yuejian/a.php?m=Account&a=firstLogin",
            async : false,
            data : {},
            success : function(data) {
             success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                yj_base.alertBackground();
                return false;
            }
		});
	}
};
indexjs.init();



















