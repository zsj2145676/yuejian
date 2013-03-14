var detailjs = {
    init:function(){
        //pagedom begin
        $('#detailright').find('textarea').autoResize();
        $('.buydim').each(function(){
            $(this).mouseover(function(){
                $(this).find('.up_pic').css('background-position','0px -340px');
                $(this).find('.down_pic').css('background-position','-37px -340px');
            });
            $(this).mouseout(function(){
                $(this).find('.up_pic').css('background-position','0px -309px');
                $(this).find('.down_pic').css('background-position','-37px -309px');
            });
        });
        $('.upbuy').click(function(){
            yj_userinfo.queryTrade('down','');
        });
        $('.downbuy').click(function(){
            yj_userinfo.queryTrade('plus','');
        });
        $('.contantinfo,.cont_play').mouseover(function(){
            $(this).find('.modify').show();
        });
        $('.contantinfo,.cont_play').mouseout(function(){
            $(this).find('.modify').hide();
        });
        $('#infomodify').click(function(){
            var ifmodify = false;
            $('.contantinfo').find('input').each(function(){
                if($(this).hasClass('contdisable')){
                    $(this).removeAttr('disabled');
                    $(this).removeClass('contdisable');
                }else{
                    $(this).attr('disabled','disabled');
                    $(this).addClass('contdisable');
                    ifmodify = true;
                }
            });
            if(ifmodify){
                yj_userinfo.modifyBaseInfo();
            }
        });
        $('#edui1_toolbarbox').load(function(){
            $(this).addClass('hide');
        });
        $('#edui1').load(function(){
            $(this).css('border','none');
        });

        $('#playmodify').click(function(){
            if($('#edui1_toolbarbox').hasClass('hide')){
                $('#edui1_toolbarbox').removeClass('hide');
                $('#edui1').css('border','1px solid #CCC');
                yj_userinfo.editor_a.enable();
            }else{
                $('#edui1_toolbarbox').addClass('hide');
                $('#edui1').css('border','none');
                yj_userinfo.editor_a.disable();
                // console.log($(document.getElementById('baidu_editor_0').contentWindow.document.body).html());
                yj_userinfo.modifyInformation();
            }
        });
        $('.moreinfo_cl').click(function(){
            yj_userinfo.queryCommit();
        });
        $('#cmit_pn').click(function(){
            yj_userinfo.commitNew($('.bl_bl').find('textarea:eq(0)'),'pn');
        });
        $('#cmit_dn').click(function(){
            yj_userinfo.commitNew($('.dn_commit').find('textarea:eq(0)'),'dn');
        });
        $('#detailleft').mouseover(function(){
            $('.head_modify').show();
        });
        $('#detailleft').mouseout(function(){
            $('.head_modify').hide();
        });
        //pagedom end
    }
};
detailjs.init();

function tabchange(obj){
    $('.cont_tab').find('li').each(function(){
        $(this).removeClass('tab_cur');
    });
    $(obj).parent().addClass('tab_cur');
    $('.cont_cont').find('.__cont').each(function(){
        $(this).css('display','none')
    });
    $('.'+$(obj).parent().attr('atab')).css('display','inline-block')
}