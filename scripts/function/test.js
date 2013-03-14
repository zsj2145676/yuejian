var test = {
    alertBackground:function(){
        alert('服务器错误，请联系后台程序猿！');
    },
    userControl:function(group){
    	console.log(group);
	   	// switch(group){
	    //     case 0:
	    //         $('#footer,#messagebar').hide();
	    //         break;
	    //     case 1: //管理员登陆
	    //         break;
	    //     case 2: //买家登陆
	    //         $('#footer').hide();
	    //         break;
	    //     case 3: //卖家登陆
	    //         break;
	    // }
    },
    testMailorPhone:function(str){
		var mail,phone;
		mail = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
		phone = /^1[3|4|5|8][0-9]\d{4,8}$/;	
		if(mail.match(str)){
			return "mail";
		else if(phone.match(str))
			return "phone";
		else
			return false;
		}
	}，
	test:function(){
		alert(123);
	}
}




















