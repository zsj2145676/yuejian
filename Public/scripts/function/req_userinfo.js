var req_userinfo = {
	ajaxQueryTrade:function(uid,page, success, error){
        $.ajax({
            type    : "GET",
            url     : "/yuejian/a.php?m=Seller&a=trade",
            async : false,
            data : {uid:uid,page:page},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxQueryCommit:function(uid, page, success, error){
        $.ajax({
            type    : "GET",
            url     : "/yuejian/a.php?m=Seller&a=comments",
            async : false,
            data : {uid:uid,page:page},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxModifyUserinfo:function(name,birthday,occupation,school,product,job,success,error){
        $.ajax({
            type    : "GET",
            url     : "/yuejian/h.php?m=User&a=setinfo",
            async : false,
            data : {name:name,birthday:birthday,occupation:occupation,school:school,product:product,job:job},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxQueryUserinfo:function(uid,success,error){
        $.ajax({
            type    : "GET",
            url     : "/yuejian/a.php?m=Seller&a=info",
            async : false,
            data : {uid:uid},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxQueryInformation:function(uid, success, error){
        $.ajax({
            type    : "GET",
            url     : "/yuejian/a.php?m=Seller&a=status",
            async : false,
            data : {uid:uid},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxCommitNew:function(master,content,success,error){
        $.ajax({
            type    : "POST",
            url     : "/yuejian/h.php?m=Comment&a=create",
            async : false,
            data : {master:master,content:content},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxBapTrade:function(tradeid,money,success,error){
        $.ajax({
            type    : "POST",
            url     : "/yuejian/h.php?m=Trade&a=bid",
            async : false,
            data : {tradeid:tradeid,money:money},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxCareIt:function(target,success,error){
        $.ajax({
            type    : "POST",
            url     : "/yuejian/h.php?m=Relation&a=follow",
            async : false,
            data : {target:target},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxTradeAll:function(uid,success,error){
        $.ajax({
            type    : "GET",
            url     : "/yuejian/a.php?m=Seller&a=tradeall",
            async : false,
            data : {uid:uid},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxQueryCareUser:function(uid,count,success,error){
        $.ajax({
            type    : "GET",
            url     : "/yuejian/a.php?m=Seller&a=followers",
            async : false,
            data : {uid:uid,count:count},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxQueryICare:function(count,success,error){
        $.ajax({
            type    : "GET",
            url     : "/yuejian/a.php?m=Buyer&a=friends",
            async : false,
            data : {count:count},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxQueryMyAlert:function(success,error){
        $.ajax({
            type    : "GET",
            url     : "/yuejian/a.php?m=Buyer&a=info",
            async : false,
            data : {},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxModifyMyAlert:function(text,success,error){
        $.ajax({
            type    : "GET",
            url     : "/yuejian/h.php?m=User&a=setDeclaration",
            async : false,
            data : {text:text},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxModifyInformation:function(status,success,error){
        $.ajax({
            type    : "GET",
            url     : "/yuejian/h.php?m=User&a=setStatus",
            async : false,
            data : {status:status},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    }
}