var yj_sidebar = {
	init:function(uid){
		var oThis = this;
		this.uid = uid;
		// this.ss = setInterval('oThis.ajaxUserSMS()',20000);
	},
	ajaxUserSMS:function(){
		var oThis = this;
		$.ajax({
			type    : "POST",
                  url     : "/",
                  async : false,
                  data : {uid:oThis.uid},
                  success : function(data) {
                  	data = eval('('+data+')');
                  	if(data.dislog == 0){
                  		$('#dialog').hide();
                  	}else{
                  		$('#dialog').show();
                  		$('#dialog').find('span').html(data.dislog);
                  	}
                  	if(data.dislog == 0){
                  		$('#message').hide();
                  	}else{
                  		$('#message').show();
                  		$('#message').find('span').html(data.message);
                  	}
                  },
                  error : function(xmlHttp, textStatus) {
                      yj_base.alertBackground();
                  }
		});
	}
}




















