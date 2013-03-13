var yj_check = {
	check:function(str){
		this.resultB = false;
		var result = yj_base.testMailorPhone(str);
		if(result == 'phone'){
			this.checkPhone(str);
		}else if(result == 'mail'){
			this.checkEmail(str);
		}else{
			return false; //输入格式出错
		}
		return this.resultB;
	},
	checkPhone:function(phone){
		var oThis = this;
		$.ajax({
            type    : "POST",
            url     : "/h.php?m=Verify&a=smscode",
            async : false,
            data : {phone:phone},
            success : function(data) {
                if(data == 1){
                	oThis.resultB = true;
                }
            },
            error : function(xmlHttp, textStatus) {
                yj_base.alertBackground();
            }
        });
	},
	checkEmail:function(mail){
		var oThis = this;
		$.ajax({
            type    : "POST",
            url     : "/h.php?m=Verify&a=emailcode",
            async : false,
            data : {phone:phone},
            success : function(data) {
                if(data == 1){
                	oThis.resultB = true;
                }
            },
            error : function(xmlHttp, textStatus) {
                yj_base.alertBackground();
            }
        });
	}
}



















