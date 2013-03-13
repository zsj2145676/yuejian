var yj_bidding = {
	bid:function(money,tradeid){
		if(yj_base.uid == undefined){
			alert("请登录后再参与竞拍~");
			return ;
		}
		if(money == '' || parseInt(money) != money){
			alert("竞拍价错误！请输入整数竞拍价！");
			return ;
		}
		if(this.queryTrade(tradeid)){
			alert("请不要重复竞拍。");
			return ;
		}
		this.bidding(money,tradeid);
	},
	queryTrade:function(tradeid){//是否已经拍过
		$.ajax({
			type    : "POST",
            url     : "/",
            async : false,
            data : {tradeid:tradeid,uid:yj_base.uid},
            success : function(data) {
            	if(data.data == 0){
            		return false;
            	}else{
            		return true;
            	}
            },
            error : function(xmlHttp, textStatus) {
                yj_base.alertBackground();
            }
		});
	},
	bidding:function(money,tradeid){
		console.log(money,tradeid);
		window.open("paypage.php?money="+money+"&tradeid="+tradeid);
	}
}




















