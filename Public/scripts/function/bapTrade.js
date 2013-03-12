var yj_baptrade = {
	init:function(){
        $('.closebuyalert').click(function(){
            $('.buyalert').hide();
            $('#flog').hide();
        });
        $('.sbmtcont').click(function(){
            var ss = $(this).closest('.buyalert');
            var index = ss.attr('index');
            if(yj_baptrade.mainCheck(index)){
            	ss.hide();
           		ss.next().show();
            }
        });
        $('.sbmtcomp').click(function(){
            $(this).closest('.buyalert').hide();
            $('#flog').hide();
        });
        $('.sendsms').click(function(){
        	yj_baptrade.sendSms();
        });
        $('.sbmtfaild').bind('click',function(){
        	$('.buyalert').hide();
        	if(yj_baptrade.queryBapResult()){
        		alert('已经付款，竞拍成功！')
        	}
        });
        $('.sbmtsuccess').bind('click',function(){
        	if(yj_baptrade.queryBapResult()){
        		$('.buyalert').hide();
        		if(oThis.ifcheckphone()){
        			$('.buyalert:eq(0)').show();
        			$('.buyalert:eq(0)').find('.sbmtcont').hide();
        			$('.buyalert:eq(0)').find('.quickbapbtn').show().unbind('click').bind('click',function(){
        				$('.buyalert:eq(3)').show();
        			});
        		}else{
        			$('.buyalert:eq(3)').show();
        		}
        	}else{
        		$('.buyalert').hide();
        		$('.buyalert:eq(3)').find('.payment').html('付款失败');
    			$('.buyalert:eq(3)').show().find('p').html('付款未成功，竞拍失败。');
        	}
        });
	},
	mainCheck:function(index){
		var oThis = this;
		switch(parseInt(index)){
			case 0:
				if(yj_base.testMailorPhone($('#mobilephone').val())!='phone'){
					$('.buyalert:eq(0)').find('.buyalert_alert').html('请输入正确的手机号码');
					return false;
				}else if(!oThis.querySms($('#modifycode').val())){
					return false;
				}
				return true;
				break;
			case 1:
				var money = $('#alertmoney').val();
				if(money!= parseInt(money)){
					$('.buyalert:eq(1)').find('.buyalert_alert').html('请输入整数价格');
					return false;
				}else if(parseInt(money)< parseInt($('.nowpr .price').html())){
					$('.buyalert:eq(1)').find('.buyalert_alert').html('您的出价低于底价，不能参与竞拍');
					return false;
				}
				money = parseInt(money);
				//===============付款竞拍================
				var tradeid = $('#buyclk').attr('tradeid');
				oThis.tradeid = tradeid;
				$.ajax({
		            type    : "POST",
		            url     : "/Third/chinabank/Send.php?",
		            async : false,
		            data : {tradeid:tradeid,money:money,uid:yj_base.uid,decription:""},
		            success : function(data) {
		            	var payWindow = window.open("","","status,height=600,width=900");
		            	payWindow.focus();
		            	payWindow.document.write(data);
		            	payWindow.document.close();
		            	oThis.BapResult = null;
		            	oThis.BapResult = setInterval('queryBapResult()',5000);
		            },
		            error : function(xmlHttp, textStatus) {
		                $('.buyalert:eq(2)').find('p').html('服务器出错，请联系客服人员');
		                return false;
		            }
		        });
				return true;
				break;
			default:
				return false;
		}
	},
	quickCheck:function(){

	},
	quickBap:function(tradeid,money,price){
		var oThis = this;
		if(tradeid == null){
			alert('此项交易已经结束或不存在！');
			return false;
		}
		if(yj_base.uid == null || yj_base.uid == undefined){
			alert('请先登录');
			return false;
		}
		if(money!= parseInt(money)){
			alert('请输入整数价格');
			return false;
		}else if(parseInt(money)< price){
			alert('您的出价低于底价，不能参与竞拍');
			return false;
		}
		money = parseInt(money);
		$.ajax({
            type    : "POST",
            url     : "/Third/chinabank/Send.php?",
            async : false,
            data : {tradeid:tradeid,money:money,uid:yj_base.uid,decription:""},
            success : function(data) {
            	var payWindow = window.open("","","status,height=500,width=800");
            	payWindow.focus();
            	console.log(data);	
            	payWindow.document.write(data);
            	payWindow.document.close();
            	$('#flog').show();
            	$('.buyalert:eq(2)').show();
            	oThis.BapResult = null;
		        oThis.BapResult = setInterval('queryBapResult()',5000);
            },
            error : function(xmlHttp, textStatus) {
                yj_base.alertBackground();
                return false;
            }
        });
	},
	queryBapResult:function(){
		var success = false;
		var oThis = this;
		$.ajax({
            type    : "POST",
            url     : "/yuejian/h.php?m=Trade&a=payed",
            async : false,
            data : {tradeid:oThis.tradeid},
            success : function(data) {
                if(data == 1){
                	success = true;
             	}
            },
            error : function(xmlHttp, textStatus) {
                yj_base.alertBackground();
            }
        });
        return success;
	},
	sendSms:function(){
		if(yj_base.testMailorPhone($('#mobilephone').val())!='phone'){
			$('.buyalert:eq(0)').find('.buyalert_alert').html('请输入正确的手机号码');
			return false;
		}else{
			$('.buyalert:eq(0)').find('.buyalert_alert').html('短信正在发送中...请稍等');
		}
		if(!yj_check.check($('#mobilephone').val())){
			return false;
		}else{
			$('.buyalert:eq(0)').find('.buyalert_alert').html('短信已经发送');
			return true;
		}
		
	},
	querySms:function(code){
		var success = false;
		var code = $('#modifycode').val();
		$.ajax({
            type    : "POST",
            url     : "/yuejian/h.php?m=Verify&a=checksms",
            async : false,
            data : {code:code},
            success : function(data) {
                if(data == 1){
                	success = true;
             	}
            },
            error : function(xmlHttp, textStatus) {
                yj_base.alertBackground();
            }
        });
        return success;
	},
	//******竞拍******//
	bap:function(){
		if($('.leavetime').html() == '竞拍已经结束') return ;
		this.bapman = yj_base.uid;
		var check = 1;
		if(this.bapman == undefined){
			alert('请登录后再竞拍');
			return ;
		}
        var tradeid = $('#buyclk').attr('tradeid');
        if(this.ifcheckTrade(tradeid) == 3){
			alert('您已经拍过这次约见了~');
			return ;
		}  
		if(yj_base.getUrlString('uid') == yj_base.uid){
			alert('请不要拍自己的时间。');
			return ;
		}
		$('#flog').show();
		if(!this.ifcheckphone(this.bapman)){
			check = 0;
		}
		$('.buyalert:eq('+check+')').show();
	},
	ifcheckphone:function(){
		var success = false;
		$.ajax({
            type    : "POST",
            url     : "/yuejian/h.php?m=Verify&a=checkphone",
            async : false,
            data : {},
            success : function(data) {
                if(data == 1) success =  true;
            },
            error : function(xmlHttp, textStatus) {
                yj_base.alertBackground();
            }
        });
        return success;
	},
	ifcheckTrade:function(tradeid){//验证重复拍
		var datab = 1;
		$.ajax({
            type    : "POST",
            url     : "/yuejian/h.php?m=Trade&a=checkbid",
            async : false,
            data : {tradeid:tradeid},
            success : function(data) {
				datab = data; 
            },
            error : function(xmlHttp, textStatus) {
            	yj_base.alertBackground();
            }
        });
		return datab;
	}
};
yj_baptrade.init();
function queryBapResult(){
	console.log("called");
	var success = false;
	$.ajax({
        type    : "POST",
        url     : "/yuejian/h.php?m=Trade&a=payed",
        async : false,
        data : {tradeid:yj_baptrade.tradeid},
        success : function(data) {
            if(data == 1){
            	success = true;
         	}
        },
        error : function(xmlHttp, textStatus) {
            yj_base.alertBackground();
        }
    });
    if(success){
    	yj_baptrade.BapResult = null;
    	$('.buyalert').hide();
    	if(oThis.ifcheckphone()){
			$('.buyalert:eq(0)').show();
			$('.buyalert:eq(0)').find('.sbmtcont').hide();
			$('.buyalert:eq(0)').find('.quickbapbtn').show().unbind('click').bind('click',function(){
				$('.buyalert:eq(3)').show();
			});
		}else{
			$('.buyalert:eq(3)').show();
		}
    }
}


