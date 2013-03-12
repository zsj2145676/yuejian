var yj_ext = {
    init:function(){
        if(yj_base.getUrlString('reset') == 1){
            $('.ext_password').find('ul:eq(0)').remove();
            tabchange(null,'ext_password');
            $('.extitem').each(function(){$(this).removeClass('ext_a_cur').hide();});
            $('.extitem:eq(2)').addClass('ext_a_cur').show();  
        }else if(yj_base.uid == undefined || yj_base.uid == null){
            window.location.href = "index.php";
        }else{
            this.uid = yj_base.uid;
            this.sntcpage = 1
            this.total_sntcpage = 1;
            this.yjpage = 1;
            this.total_yjpage = 1;
            this.cmtpage = 1;
            this.total_cmtpage = 1;
            this.listSiteNotice(1);
            this.queryYuejian(1);
            this.queryYJComment(1);
            this.queryBaseInfo();
            this.queryCareUser(11);
        }
    },
    //********邮件*********//
    //站内通知
    listSiteNotice:function(page){
        var oThis = this;
        if(page == 'pre'){
            if(this.sntcpage>1)
                page = this.sntcpage--;
            else
                return ;
        }else if(page == 'next'){
            if(this.sntcpage<this.total_sntcpage)
                page = this.sntcpage++;
            else
                return ;
        }
        req_ext.ajaxQuerySiteNotice(page,function(data){
            //data = eval('('+data+')');
            console.log(data);
            if(data.total_page != 0){
                oThis.total_sntcpage = data.total_page;
                var str='';
                for(var i=0,len=data.message.length;i<len;i++){
                    if(data.message[i].from == ''){
                        str += '<li class="'+data.message[i].state+'" mailid='+data.message[i].id+'><a class="checkbox" href="javascript:;"></a>&nbsp;&nbsp;<a class="main_name" href="javascript:;">'+data.message[i].name+'</a>&nbsp;&nbsp;&nbsp;'+data.message[i].header+'&nbsp;&nbsp;'
                        +data.message[i].createtime+'&nbsp;&nbsp;&nbsp;&nbsp;【<a href="javascript:;" onclick="yj_ext.detailSiteNotice('+'\''+data.message[i].id+'\''+');">查看</a>】</li>';
                    }else{
                        str += '<li class="'+data.message[i].state+'" mailid='+data.message[i].id+'><a class="checkbox" href="javascript:;"></a>&nbsp;&nbsp;<a class="main_name" href="detail.php?&uid='+data.message[i].from+'">'+data.message[i].name+'</a>&nbsp;&nbsp;&nbsp;'+data.message[i].header+'&nbsp;&nbsp;'
                        +data.message[i].createtime+'&nbsp;&nbsp;&nbsp;&nbsp;【<a href="javascript:;" onclick="yj_ext.detailSiteNotice('+'\''+data.message[i].id+'\''+');">查看</a>】</li>';
                    }
                }
                $('.ext_mail_site').find('ul:eq(0)').find('li:gt(0)').remove();
                $('.ext_mail_site').find('ul:eq(0)').append(str);
                $('.yuejian_page:eq(0)').html((oThis.sntcpage+'/'+data.total_page));
            }
            $('.ext_mail_site').find('a').click(function(){
                if($(this).hasClass('main_check')){
                    if($(this).hasClass('act'))
                        $('.ext_mail_site').find('a').each(function(){$(this).removeClass('act')});
                    else
                        $('.ext_mail_site').find('a').each(function(){$(this).addClass('act')});
                }
                else if($(this).hasClass('act'))
                    $(this).removeClass('act');
                else
                    $(this).addClass('act');
            });
        },function(){
            yj_base.alertBackground();
        });
    },
    detailSiteNotice:function(mailid){
        req_ext.ajaxQueryDetailSNT(mailid,function(data){
            data = eval('('+data+')');
            if(data != null){
                $('.ext_mail_site').removeClass('ext_mail_div_cur');
                $('.ext_mail_site2').addClass('ext_mail_div_cur');
                $('#mail_del').attr('mailid',data.id);
                $('.site2_content').find('p:eq(0)').find('span').html(data.name);
                $('.site2_content').find('p:eq(1)').find('span').html(data.createtime);
                $('.site2_content').find('p:eq(2)').find('span').html(data.subject);
                $('.site2_content_cont').html(data.content);
            }
        },function(){
            yj_base.alertBackground();
        });
    },
    deleteSiteNotice:function(hrea){
        var mailid = $(hrea).attr('mailid');
        req_ext.ajaxDeleteDetailSNT(mailid,function(data){
            if(data == 1){
                alert('删除成功');
                $('.ext_mail_site2').removeClass('ext_mail_div_cur');
                $('.ext_mail_site').addClass('ext_mail_div_cur');
            }else{
                alert('删除失败');
                $('.ext_mail_site2').removeClass('ext_mail_div_cur');
                $('.ext_mail_site').addClass('ext_mail_div_cur');
            }
        },function(){
            yj_base.alertBackground();
        });
    },
    deleteNoticeList:function(){
        var list = [];
        var oThis = this;
        $('.checkbox').each(function(){
            if($(this).hasClass('act')){
                var ss = $(this).closest('li').attr('mailid');
                if(ss != undefined && ss != null){
                    list.push(ss);
                }   
            }
        });
        if(list.length == 0) return ;
        else{
            req_ext.ajaxDeleteListSNT(list,function(data){
                if(data == 1){
                    alert('删除成功');
                    oThis.sntcpage = 1;
                    oThis.total_sntcpage = 1;
                    oThis.listSiteNotice(1);
                }else{
                    alert('删除失败');
                }
            },function(){});
        }
    },
    //约见通知
    queryYuejian:function(page){
        var oThis = this;
        if(page == 'pre'){
            if(this.yjpage>1)
                page = this.yjpage--;
            else
                return ;
        }else if(page == 'next'){
            if(this.yjpage<this.total_yjpage)
                page = this.yjpage++;
            else
                return ;
        }
        req_ext.ajaxQueryYuejian(this.yjpage,function(data){
            //data = eval('('+data+')');
            if(data.total_page>=1){
                $('.ext_mail_meet_alert').hide();
                $('.ext_mail_meet_in').show();
                oThis.total_yjpage = data.total_page;
                var notice = data.notice;
                $('.ext_mail_meet').find('p:eq(0)').find('span').html(notice.sellername);
                $('.ext_mail_meet').find('p:eq(1)').find('span:eq(0)').html(notice.date);
                $('.ext_mail_meet').find('p:eq(1)').find('span:eq(1)').html(notice.buyer_count);
                $('.mid_meet_cont_left').find('img').attr('src',notice.buyer.avatar);
                $('.meet_name_man span').html(notice.buyer.name);
                $('.mid_meet_cont_right').find('p:eq(0)').find('span').html(notice.sellername);
                $('.meet_word p').html(notice.message);
                $('.meet_price span:eq(1)').html(notice.price);
                $('.meet_side p:eq(1)').html(notice.createtime);
                $('.yuejian_page:eq(1)').html((oThis.yjpage+'/'+oThis.total_yjpage));
            }else{
                $('.ext_mail_meet_alert').show();
                $('.ext_mail_meet_in').hide();
            }
        },function(){
            yj_base.alertBackground();
        });
    },
    //约见评价
    queryYJComment:function(page){
        var oThis = this;
        if(page == 'pre'){
            if(this.cmtpage>1)
                page = this.cmtpage--;
            else
                return ;
        }else if(page == 'next'){
            if(this.cmtpage<this.total_cmtpage)
                page = this.cmtpage++;
            else
                return ;
        }
        req_ext.ajaxQueryYJComment(page,function(data){
            //data = eval('('+data+')');
            if(data.total_page > 0){
                $('.ext_mail_comment_alert').hide();
                $('.ext_mail_comment_in').show();
                oThis.total_cmtpage = data.total_page;
                var meet = data.meet;
                $('.comment_cont').find('p:eq(0)').find('span').html(meet.buyer.name);
                $('.comment_cont').find('p:eq(1)').find('span').html(meet.seller.name);
                $('.yuejian_page:eq(2)').html((oThis.cmtpage+'/'+oThis.total_cmtpage));
                $('.ext_comment_btn').attr('yjcmtid',meet.id);
            }else{
                $('.ext_mail_comment_alert').show();
                $('.ext_mail_comment_in').hide();
            }
        },function(){
            yj_base.alertBackground();
        });
    },
    submitYJComment:function(){
        var ss = $('.select_div_sel_cur').attr('select');
        var id = $('.ext_comment_btn').attr('yjcmtid');
        console.log(ss,id);
        req_ext.ajaxSubmitYJComment(id,ss,function(data){
            console.log(data);
            if(data == 1){
                alert('评价成功');
            }else{
                alert('评价失败');
            }
        },function(){
            yj_base.alertBackground();
        });
    },
    //********账号设置*********//
    //基础信息
    queryBaseInfo:function(){
        req_ext.ajaxQueryBaseInfo(function(data){
            //data = eval('('+data+')');
            if(data != null){
                $('.modifyhead').attr('src',data.avatar); 
                $('#username').val(data.name);
                $('#phone').val(data.phone);
                $('#bankid').val(data.bankno);
                $('#bankname').val(data.bank);
                $('#bankuser').val(data.bankname);
            }
        },function(){
            yj_base.alertBackground();
        });
    },
    submitBaseInfo:function(){
        var username = $('#username').val();
        var phone = $('#phone').val();
        var bankid = $('#bankid').val();
        var bankname = $('#bankname').val();
        var bankuser = $('#bankuser').val();
        if(username == ''){
            $('.mod_alert:eq(0)').html('姓名不可为空').show();
            return ;
        }
        if(phone != '' &&(!(yj_base.testMailorPhone(phone) == 'phone'))){
            $('.mod_alert:eq(0)').html('请输入正确的手机号码').show();
            return ;
        }
        if(bankid != '' && (!yj_base.testBankID(bankid))){
            $('.mod_alert:eq(0)').html('请输入正确的银行卡号').show();
            return ;
        }
        if(username == ''){
            $('.mod_alert:eq(0)').html('姓名不可为空').show();
            return ;
        }
        if(bankid != '' || bankname != '' || bankuser!= ''){
            if(bankid == ''|| bankname == '' || bankuser == ''){
                $('.mod_alert:eq(0)').html('请补全银行信息').show();
                return;
            }
        }
        req_ext.submitBaseInfo(username,phone,bankid,bankname,bankuser,function(data){
            if(data == 1){
                alert('修改成功');
            }else{
                alert('修改失败');
            }
        },function(){
            yj_base.alertBackground();
        });
    },
    //头像查询
    queryHeadImg:function(){
        var oThis = this;
        oThis.jcrop_api;
        var jcrop_api;
        req_ext.ajaxQueryHeadImg(yj_base.uid,function(data){
            //data = eval('('+data+')');
            if(data != null){
                $('.headimg_big').find('img').attr('src',data.avatar);
                $('.headimg_small').find('img').attr('src',data.avatar.replace("large","small"));
                var jcrop_api;
                $('#cropbox').Jcrop({
                    aspectRatio: 1, //选中区域宽高比为1，即选中区域为正方形 
                    bgColor:"#FFFFFF", //裁剪时背景颜色设为灰色 
                    bgOpacity:0.6, //透明度设为0.6
                    allowResize:true, //不允许改变选中区域的大小 
                    setSelect:[0,0,110,110], //初始化选中区域 
                    minSize:[110,110],
                    onSelect:updateCoords,
                    },
                    function(){
                        console.log(123);
                        // var bounds = this.getBounds();
                        // boundx = bounds[0];
                        // boundy = bounds[1];
                        jcrop_api = this;
                        oThis.jcrop_api = this;
                    }
                ); 
            }
        },function(){
            yj_base.alertBackground();
        });
    },//上传
    uploadImg:function(input){
        var oThis = this;
        $("#loading").show();
        $.ajaxFileUpload({
            url:'/yuejian/h.php?m=Upload&a=avatar',
            secureuri:false,
            fileElementId:'fileToUpload',
            dataType: 'json',
            success: function (data, status){
                $("#loading").hide();
                data = eval('('+data+')');
                if(data != null){
                    $('.headimg_big').find('img').attr('src',data.large);
                    var img = new Image();
                    img.src = $('.headimg_big').find('img').attr('src');
                    console.log(img);
                    // oThis.jcrop_api.destroy();
                    // if(img.complete){
                    //     console.log(img.offsetWidth,img.height);
                    //     // $('.headimg_big div').remove();
                    //     $('#cropbox').css('display','block');
                    //     $('#cropbox').css('width','201');
                    //     $('#cropbox').css('height',img.height);
                    //     $('#cropbox').Jcrop({
                    //         aspectRatio: 1, //选中区域宽高比为1，即选中区域为正方形 
                    //         bgColor:"#FFFFFF", //裁剪时背景颜色设为灰色 
                    //         bgOpacity:0.6, //透明度设为0.6
                    //         allowResize:true, //不允许改变选中区域的大小 
                    //         setSelect:[0,0,110,110], //初始化选中区域 
                    //         minSize:[110,110],
                    //         onSelect:updateCoords,
                    //         boxWidth:201,
                    //         boxHeihgt:300,
                    //         },
                    //         function(){
                    //             var bounds = this.getBounds();
                    //             boundx = bounds[0];
                    //             boundy = bounds[1];
                    //             oThis.jcrop_api = this;
                    //     });
                    // }
                }
            },
            error: function (data, status, e){
                $("#loading").hide();
                alert('上传的图片不符合要求，请重新上传');
            }
        });
        console.log(oThis.jcrop_api);
        
    },//裁剪
    resizeImg:function(){
        var c = extpagejs.imgs;
        var src = $('#cropbox').attr('src');
        req_ext.ajaxResizeImg(src,c.x,c.y,c.w,c.h,function(data){
            console.log(data);
            data = eval('('+data+')');
            if(data != null){
                $('.headimg_small').find('img').attr('src',data.small.replace(".",""));
                $('.modifyhead').attr('src',data.small.replace(".",""));
                alert("保存成功");
            }else{
                alert("小头像保存失败");
            }
        },function(){
            yj_base.alertBackground();
        });
    },
    //********密码修改*********//
    //修改密码  重置密码
    submitModifyPass:function(){
        var newpassword = $('#newpassword').val();
        var senewpassword = $('#senewpassword').val();
        var oldpassword = '';
        if(yj_base.getUrlString('reset') != 1){
            oldpassword = $('#oldpassword').val();
        }
        console.log(yj_base.testPassword(newpassword));
        return ;
        if(newpassword != '' && newpassword != senewpassword){
            $('.mod_alert:eq(1)').html('新密码两次输入不相同').show();
            return ;
        }
        req_ext.submitModifyPass(newpassword,oldpassword,function(data){
            if(data == 1){
                alert('修改成功');
            }else{
                $('.mod_alert:eq(1)').html('修改失败，请验证您的原密码是否正确').show();
            }
        },function(){
            yj_base.alertBackground();
        });
    },
    //********见过的人*********//
    queryCareUser:function(page){
        var oThis = this;
        //page 控制返回量，空的就是返回全部
        req_ext.ajaxQueryCareUser(page,function(data){
            //data = eval('('+data+')');
            if(data !=null){
                oThis.domCare(data.meets);
            }
        },function(){});
    },
    domCare:function(data){
        var str ='';
        for(var i=0,len = data.length;i<len;i++){
            if(data[i]!=null)
                str +='<li><div>'
                      +'<a href="index.php?m=Index&a=detail&uid='+data[i].uid+'"><img src="'+data[i].avatar+'"/></a><br />'
                      +'<a href="index.php?m=Index&a=detail&uid='+data[i].uid+'">'+data[i].name+'</a>'
                      +'</div></li>';
        }
        $('.carelistin ul').html(str);
    }
};
yj_ext.init();