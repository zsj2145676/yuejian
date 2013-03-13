var yj_welcome = {
    init:function(){
        $('.subbtn').click(function(){
            yj_welcome.check();
        });
        $('#conti').click(function(){
            yj_welcome.checkUsername();
        });
        $('#password').keyup(function(){
            if($(this).val().length < 6){
                $('#alerm_1').css('display','inline-block');
                $('#passworddiv').find('.wel_alert').html('密码长度不能短于6位').show();
            }
        });
        $('#sepassword').keyup(function(){
            if($(this).val() != $('#password').val()){
                $('#alerm_2').css('display','inline-block');
                $('#passworddiv').find('.wel_alert').html('两次密码输入不一致。').show();
            }
        });
        $('#password').focus(function(){
            $('#alerm_1').hide();
            $('#passworddiv').find('.wel_alert').hide();
        });
        $('#sepassword').focus(function(){
            $('#alerm_2').hide();
            $('#passworddiv').find('.wel_alert').hide();
        });
        $('.comp').click(function(){
            yj_welcome.checkPassword();
        }); 
        $('#code').focus(function(){
            $('.alert').hide();
        });
        $('#usernamein').focus(function(){
            $('#alerm_0').hide();
            $('#welcome').find('.wel_alert').hide();
        });
    },
    check:function(){
        var code = $('#code').val();
        var datacome;
        this.checkCode(code,function(data){
            if(data == 'null'){
                $('.alert').html('<p>邀请码错误</p>').show();
            }else{
                data = eval('('+data+')');
                if(data.used == 0){
                    datacome = data;
                }else if(data.used == 1){
                    $('.alert').html('<p>这个邀请码已经使用</p>').show();
                }
            }
        },function(){
            yj_base.alertBackground();
        });
        if(datacome != null){
            $('#wel_code').hide();
            $('#imagediv').show();
            $('#imagediv').find('img').attr('src',datacome.avatar)
            $('#welcome').show();
            if(datacome.name != undefined){
                $('#welcome').find('span:eq(0)').html(datacome.name);
            }else{
                $('#welcome').find('span:eq(0)').remove();
            }
        }
    },
    checkCode:function(code,success,error){
        $.ajax({
            type    : "POST",
            url     : "/a.php?m=Invitation&a=check",
            async : false,
            data : {code:code},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(data);
            }
        });
        return true;
    },
    checkUsername:function(){
        var str = $('#usernamein').val();
        var ss = yj_base.testMailorPhone(str);
        if(ss != 'phone' && ss !='mail'){
            $('#alerm_0').css('display','inline-block');
            $('#welcome').find('.wel_alert').html('请输入手机号码或邮箱作为用户名').show();
        }else{
            $.ajax({
                type    : "POST",
                url     : "/a.php?m=Account&a=exist",
                async : false,
                data : {username:str},
                success : function(data) {
                    if(data == 1){
                        $('#alerm_0').show();
                        $('#welocme').find('.wel_alert').html('用户名已经存在').show();
                    }else{
                        $('#welcome').hide();
                        $('#passworddiv').show();
                    }
                },
                error : function(xmlHttp, textStatus) {
                    yj_base.alertBackground();
                }
            }); 
        }
    },
    checkPassword:function(){
        if($('#sepassword').val() != $('#password').val()){
            $('#passworddiv').find('.wel_alert').html('两次密码输入不一致，请确认一致后再提交。').show();
        }
        else{
            var username = $('#username').val();
            var passwd = $('#password').val();
            var code = $('#code').val();
            this.comtUserInfo(username,passwd,code,function(data){
                if(data == 1){
                    window.location.href = "index.php";
                }else{
                    alert('注册程序性错误，请联系客服人员');
                }
            },function(){
                yj_base.alertBackground();
            });
        }
    },
    comtUserInfo:function(username,passwd,code,success,error){
        $.ajax({
            type    : "POST",
            url     : "/a.php?m=Invitation&a=bind",
            async : false,
            data : {username:username,password:passwd,code:code},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                error && error(data);
            }
        });
        return true;
    }
};
yj_welcome.init();

















