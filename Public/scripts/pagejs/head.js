var headjs = {
    init:function(){
        //pagedom begin
        $('#searchbar_ipt').focus(function(){
            $(this).val('');
        });
        $('#searchbar_ipt').blur(function(){
            if($(this).val()==''){
                $(this).val("请输入您感兴趣的关键字");
            }
        });
        $('#searchbar_ipt').keydown(function(){
            if(event.keyCode == 13 && $(this).val() != ''){
                window.location.href="index.php?name="+$(this).val();
            }
        });
        
        
        $('#point').click(function(){
            $('html, body').animate({ scrollTop : 0}, 300);
            return false;
        });
        $(window).scroll(function(){
            if($(window).scrollTop()>0){
                $('#point').fadeIn(300);
                $('#footer').fadeIn(300);
            }else{
                $('#point').fadeOut(300);   
                $('#footer').fadeOut(300);
            }
            if($('#include').css('top') == "276px"){
                if($(window).scrollTop()>=219){
                    $('.fir_typ span').css('background-position','-192px 0px');
                    $('.fir_typ').css('background','rgba(0,0,0,0)');  
                }else{
                    $('.fir_typ span').css('background-position','-192px -27px');
                    $('.fir_typ').css('background','#F5F6F4');
                }
            }
            if($('#minnavbar').css('display') == 'block'){
                $('#minnavbar').hide();
                $('.fir_typ span').css('background-position','-192px 0px');
                $('.fir_typ').css('background','rgba(0,0,0,0)');
            }
        });
        $('.fir_typ').click(function(){
            if($('#include').css('top') == "57px"){
                if($('#minnavbar').css('display') == 'block'){
                    $('#minnavbar').hide();
                    $('.fir_typ span').css('background-position','-192px 0px');
                    $('.fir_typ').css('background','rgba(0,0,0,0)');
                }else if($(window).scrollTop()<180){
                    $('#include').animate({top:"276px"},'fast');
                    $('.fir_typ span').css('background-position','-192px -27px');
                    $('.fir_typ').css('background','#F5F6F4');
                }else{
                    $('#minnavbar').show();
                    $('.fir_typ span').css('background-position','-192px -27px');
                    $('.fir_typ').css('background','#F5F6F4');
                }
            }else{
                if($('#minnavbar').css('display') == 'block'){
                    $('#minnavbar').hide();
                    $('.fir_typ span').css('background-position','-192px 0px');
                    $('.fir_typ').css('background','rgba(0,0,0,0)');
                }else if($(window).scrollTop()<219){
                    $('#include').animate({top:"57px"},'fast');
                    $('.fir_typ span').css('background-position','-192px 0px');
                    $('.fir_typ').css('background','rgba(0,0,0,0)');
                }else{
                    $('#minnavbar').show();
                    $('.fir_typ span').css('background-position','-192px -27px');
                    $('.fir_typ').css('background','#F5F6F4');
                }
            }
        });
        $('#navbar').find('li').mouseover(function(){
            $(this).find('.nav_img').show();
        });
        $('#navbar').find('li').mouseout(function(){
            $(this).find('.nav_img').hide();
        });
        $('.sec_typ').click(function(){
            if($('.rightpane').css('margin-left') == '-348px'){   
                setTimeout($('#sec_typ_cont').fadeIn(300),500);               
                setTimeout($('.rightpane').animate({marginLeft:'0px'},200),500);
                $('.minpane').css('visibility','visible');
                $('.sec_typ').css('background','#F5F6F4');
                $('.sec_typ').find('span').css('background-position','-191px -78px');
            }else{
                $('.minpane').css('visibility','hidden');
                setTimeout($('.rightpane').animate({marginLeft:'-348px'},300),500);               
                setTimeout($('#sec_typ_cont').fadeOut(300),500);
                $('.sec_typ').css('background','rgba(0,0,0,0)');
                $('.sec_typ').find('span').css('background-position','-191px -53px');
            }
        });
        $('#mypage').click(function(){
            if(yj_base.group == 'guest'){
                window.location.href ='index.php?m=Index&a=customer&uid='+yj_base.uid;
            }else if(yj_base.group == 'seller'){
                window.location.href ='index.php?m=Index&a=detail&uid='+yj_base.uid;
            }
        });
        //pagedom end 
    }
}
headjs.init();
