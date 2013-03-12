var req_ext={
    ajaxQuerySiteNotice:function(page,success,error){
        $.ajax({
            type    : "GET",
            url     : "/yuejian/h.php?m=Message",
            async : false,
            data : {page:page},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxQueryDetailSNT:function(id,success,error){
        $.ajax({
            type    : "GET",
            url     : "/yuejian/h.php?m=Message&a=detail",
            async : false,
            data : {id:id},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxDeleteDetailSNT:function(id,success,error){
        $.ajax({
            type    : "POST",
            url     : "/yuejian/h.php?m=Message&a=delete",
            async : false,
            data : {id:id},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxDeleteListSNT:function(ids,success,error){
        $.ajax({
            type    : "POST",
            url     : "/yuejian/h.php?m=Message&a=deleteAll",
            async : false,
            data : {ids:ids},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp, textStatus);
            }
        });
    },
    ajaxQueryYuejian:function(page,success,error){
        $.ajax({
            type    : "POST",
            url     : "/yuejian/h.php?m=Notice",
            async : false,
            data : {page:page},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp,textStatus);
            }
        });
    },
    ajaxQueryYJComment:function(page,success,error){
        $.ajax({
            type    : "POST",
            url     : "/yuejian/h.php?m=Meet&a=meet",
            async : false,
            data : {page:page},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp,textStatus);
            }
        });
    },
    ajaxSubmitYJComment:function(id,value,success,error){
        $.ajax({
            type    : "POST",
            url     : "/yuejian/h.php?m=Meet&a=comment",
            async : false,
            data : {id:id,value:value},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp,textStatus);
            }
        });
    },
    ajaxQueryBaseInfo:function(success,error){
        $.ajax({
            type    : "POST",
            url     : "/yuejian/h.php?m=User&a=get",
            async : false,
            data : {},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp,textStatus);
            }
        });
    },
    submitBaseInfo:function(name,phone,bankno,bank,bankname,success,error){
        $.ajax({
            type    : "GET",
            url     : "/yuejian/h.php?m=User&a=setinfo",
            async : false,
            data : {name:name,phone:phone,bankno:bankno,bank:bank,bankname:bankname},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp,textStatus);
            }
        });
    },
    submitModifyPass:function(newpwd,oldpwd,success,error){
        $.ajax({
            type    : "POST",
            url     : "/yuejian/a.php?m=Account&a=setpwd",
            async : false,
            data : {newpwd:newpwd,oldpwd:oldpwd},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp,textStatus);
            }
        });
    },
    ajaxQueryHeadImg:function(uid,success,error){
        $.ajax({
            type    : "GET",
            url     : "/yuejian/a.php?m=Seller&a=info",
            async : false,
            data : {uid:uid},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp,textStatus);
            }
        });
    },
    ajaxQueryCareUser:function(count,success,error){
        $.ajax({
            type    : "POST",
            url     : "/yuejian/h.php?m=Meet&a=history",
            async : false,
            data : {count:count},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp,textStatus);
            }
        });
    },
    ajaxResizeImg:function(src,x,y,w,h,success,error){
        $.ajax({
            type    : "POST",
            url     : "/yuejian/h.php?m=Upload&a=crop",
            async : false,
            data : {src:src,x:x,y:y,w:w,h:h},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(xmlHttp,textStatus);
            }
        });
    }
}



















