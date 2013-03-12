var req_log_reg={
	ajaxQueryUser:function(username, password, success, error){
        $.ajax({
            type    : "POST",
            url     : "/yuejian/a.php?m=Account&a=login",
            async : false,
            data : {username:username, password:password},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxFindPasswd:function(username,type,success,error){
    	$.ajax({
            type    : "POST",
            url     : "/yuejian/a.php?m=Account&a=findpwd",
            async : false,
            data : {username:username, type:type},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxQueryName:function(username,success,error){
    	$.ajax({
            type    : "POST",
            url     : "/yuejian/a.php?m=Account&a=exist",
            async : false,
            data : {username:username},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxRegister:function(username,password,cat,success,error){
        $.ajax({
            type    : "POST",
            url     : "/yuejian/a.php?m=Account&a=signup",
            async : false,
            data : {username:username, password:password,cat:cat},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    }
}




















