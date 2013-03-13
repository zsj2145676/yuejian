var log_regjs = {
    init:function(){
        //pagedom start
//        $('#openlogin').click(function(){
//            $('#flog').show();
//            $('#logindiv').show();  
//        });
        $('#closelogin').click(function(){
            $('#flog').hide();
            $('#logindiv').hide();  
        });
        $('#openregister').click(function(){
            $('#flog').show();
            $('#registerdiv').show();
        });
        $('#closeregister').click(function(){
            $('#flog').hide();
            $('#registerdiv').hide();
        });
        $('.agree_btn').click(function(){
            if(!$(this).hasClass('clicked')){
                $(this).find('div').css('background-position','-530px -129px');
                $(this).addClass('clicked');
            }else{
                $(this).find('div').css('background-position','-530px -96px');
                $(this).removeClass('clicked');
            }
        });
        $('.registertype').find('a').each(function(){
            $(this).click(function(){
                if($(this).hasClass('a_cur'))
                    $(this).removeClass('a_cur');
                else{
                    $(this).addClass('a_cur');
                }
            });
        });
        $('.forgetpass').click(function(){
            if($(this).find('a').html() == '忘记密码？'){
                $('#log_password').slideUp();
                $('.sbmtlogin').addClass('sbfindpass');
                $(this).find('a').html('又想起来了！');
                $('.sbmtlogin').unbind('click').bind('click',function(){
                    var username = $('#username').val();
                    yj_login.forgetPassword(username);
                });
            }else{
                $('#log_password').slideDown();
                $('.sbmtlogin').removeClass('sbfindpass');
                $(this).find('a').html('忘记密码？');
                $('.sbmtlogin').unbind('click').bind('click',function(){
                    yj_login.queryUser();
                });
            }
        });
        $('.sbmtlogin').bind('click',function(){
            yj_login.queryUser();
        });
        //pagedom end
    }
};
log_regjs.init();
