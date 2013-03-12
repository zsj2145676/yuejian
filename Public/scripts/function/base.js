var yj_base = {
	init:function(){
		//only define 
		this.typestr = {
			'3385FF':'科技',
			'00B3FF':'金融',
			'A2E024':'教育',
			'B6C70A':'传媒',
			'FF8E24':'娱乐',
			'FF38A8':'美女',
			'E3007F':'艺术',
			'A736FF':'体育'
		};
	},
    alertBackground:function(){
        alert('服务器错误，请联系后台程序猿！');
    },
    testMailorPhone:function(str){
		var mail,phone;
		mail = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
		phone = /^1[358]\d{9}$/;
		if(str.search(mail)!= -1){
			return "mail";
		}
		else if(str.match(phone)){
			return "phone";
		}
		else{
			return false;
		}
	},
	testBankID:function(str){
		var bank = /^\d{19}$/;
		if(str.match(bank)){
			return true;
		}else{
			return false;
		}
	},
	testPassword:function(str){
		var password = /^\w{6,32}$/;
		if(str.match(password)){
			return true;
		}else{
			return false;
		}

	},
	getUrlString:function(name){
	    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	    var r = window.location.search.substr(1).match(reg);
	    if (r != null) {
	    	return r[2]; 
	    }
	    return null;
    },
    searchArray:function(arr,string){
    	for(var i=0,len=arr.length;i<len;i++){
    		if(string == arr[i]){
    			return true;
    		}
    	}
    	return false;
    }
};
yj_base.init();




















