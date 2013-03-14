var extpagejs = {
    init:function(){
        //pagedom begin
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
        $('.ext_left').find('a').click(function(){
            $('.extitem').each(function(){$(this).removeClass('ext_a_cur')});
            $(this).parent().addClass('ext_a_cur');
        });
        $('.ext_cont_mu').find('a').click(function(){
            $('.ext_cont_mu').find('div').each(function(){$(this).removeClass('ext_mail_cur')});
            $(this).parent().find('div').addClass('ext_mail_cur');
        });

        
        $('.select_subpro').find('a').click(function(){
            if($(this).hasClass('act'))
                $(this).removeClass('act');
            else
                $(this).addClass('act');
        });
        $('.select_welfare_span').click(function(){
            $('.select_welfare_span').each(function(){$(this).removeClass('select_welfare_do');});
            $(this).addClass('select_welfare_do');              
            if($('.select_welfare_span:first').hasClass('select_welfare_do')){
                $('.select_subpro').css('visibility','visible');
            }else{
                $('.select_subpro').css('visibility','hidden');
            }
        });
        $('.ext_options').mouseover(function(){
            $('#infomodify').show();
        });
        $('.ext_options').mouseout(function(){
            $('#infomodify').hide();
        });
        $('.select_div').click(function(){
            $('.select_div_sel').removeClass('select_div_sel_cur');
            $(this).find('.select_div_sel').addClass('select_div_sel_cur');
        });
        $('#mail_list').click(function(){
            $('.ext_mail_site2').removeClass('ext_mail_div_cur');
            $('.ext_mail_site').addClass('ext_mail_div_cur');
        });
        $('.ext_options input').each(function(){
            $(this).focus(function(){
                $('.mod_alert:eq(0)').hide();
            });
        });
        $('.ext_password input').each(function(){
            $(this).focus(function(){
                $('.mod_alert:eq(1)').hide();
            });
        });
        $('.uploadbtn').click(function(){
            $('#fileToUpload').click();
        });
        $('.modifyhead').click(function(){
            $('#flog').show();
            $('#headimgmodify').show();
            yj_ext.queryHeadImg();
        });
        $('#closemodifyhead').click(function(){
            $('#flog').hide();
            $('#headimgmodify').hide();
        });
        
    }
};
extpagejs.init();
function openintro(str){
if(str == '1'){
   $('.welfare_intro').html('帮助年轻人实现梦想！'); 
}else if(str == '2'){
    $('.welfare_intro').html('雷励青年公益发展中心，于上海杨浦区民政局正式注册的公益组织。致力于青少年发展的教育型公益机构，也是雷励国际在亚洲的第六个独立社区。通过开展环保建设、社区工作、野外探索等类型的项目，在服务当地社区及环境的同时，青年人得以增长自己的技能，提高自信心、领导力及社会责任感，加强多种文化之间的理解和交流，并加强对世界各地环境保护及社区发展的关注，开启全球化视野。');
}else if(str == '3'){
    $('.welfare_intro').html('西儿基金名指：“西方归来祖国儿女，回报中国西部贫困儿童”，即怀着以“Share（西儿）”为名的“双西双儿”理念，借助海外成功学子的力量，帮助中国的贫困儿童。实际受益的学校有包括陕西省汉中市西乡县沙河镇沙河中学在内的地处陕西、甘肃、四川的10余所西部贫困学校。');
}else if(str == '4'){
    $('.welfare_intro').html('帮助重症患者重获健康！');
}else{
    $('.welfare_intro').html(' ');
}  
}
function m_tabchange(str){
$('.ext_mail_div').each(function(){$(this).removeClass('ext_mail_div_cur')});
$('.'+str).addClass('ext_mail_div_cur');
}
function tabchange(str,str2){
if(str!=null){
    $('.ext_cont').each(function(){$(this).removeClass('ext_div_cur')});
    $('.'+str).addClass('ext_div_cur');
}else{
    $('.ext_cont').each(function(){$(this).removeClass('ext_div_cur')});
    $('.'+str2).addClass('ext_div_cur');
}
}
function updateCoords(c){
    extpagejs.imgs = c;
}






