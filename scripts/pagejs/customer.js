var yj_customer ={
    init:function(){
        $('.keywords').find('textarea').focus(function(){
            if($(this).val() == '我的个人宣言:'){
                $(this).val('');
            }
        });
        $('.keywords').find('textarea').blur(function(){
            if($(this).val() == ''){
                $(this).val('我的个人宣言:');
            }
        });
        $('.keywords').find('textarea').keyup(function(){
            if($(this).val() == '我的个人宣言:' || $(this).val() == ''){
                $('.key_modify').hide();
            }else{
                $('.key_modify').show();
            }
        });
        $('#detailleft').mouseover(function(){
            $('.head_modify').show();
        });
        $('#detailleft').mouseout(function(){
            $('.head_modify').hide();
        });
    }
};
yj_customer.init();
