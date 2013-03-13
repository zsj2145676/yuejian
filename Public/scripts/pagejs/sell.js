var yj_sell={
    createTrade:function(){
        var uid,time,address,desp,money,charity;
        var oThis = this;
        time = $('#meettime').val();
        desp = $('#description').val();
        money = $('#alertmoney').val();
        address = $('#meetaddress').val();
        charity = 1;
        if(yj_base.uid == undefined){
            return ;
        }else{
            uid = yj_base.uid;
        }
        if(time == ''|| desp == ''|| money == '' || address == ''){
            alert("请补全信息");
            return ;
        }
        oThis.newTrade(time,address,desp,money,charity,function(data){
            if(data == 1){
                oThis.result =  true;
            }
            else{
                alert("发布失败！");
                oThis.result = false;
            }
        });
        return this.result;
    },
    queryTrade:function(){
        var time = $('#meettime').val();
        console.log(this.ajaxTrade(time));
        if(this.ajaxTrade(time) == 1){
            return true;
        }else{
            return false;
        }   
    },
    ajaxTrade:function(time){
        var bool = 0;
        $.ajax({
            type    : "POST",
            url     : "/h.php?m=Trade&a=checktime",
            async : false,
            data : {time:time},
            success : function(data) {
                bool = data;
            },
            error : function(xmlHttp, textStatus) {
                yj_base.alertBackground();
            }
        });
        return bool;
    },
    newTrade:function(time,address,description,money,charity,success){
        $.ajax({
            type    : "POST",
            url     : "/h.php?m=Trade&a=create",
            async : false,
            data : {time:time,address:address,description:description,money:money,charity:charity},
            success : function(data) {
                success && success(data);
            },
            error : function(xmlHttp, textStatus) {
                yj_base.alertBackground();
            }
        });
    },
    queryDim:function(dimnum){
        var oThis = this;
        switch(dimnum){
            case 0:
                var ss = $('#meettime').val();
                var dd = new Date(ss.substring(0,14));
                if(ss == ''){
                    $('.divalert').html('请输入约见时间');
                    $('#datepicker').hide();
                    return true;
                }
                else if(dd < new Date()){
                    $('.divalert').html('您输入的约见时间已经过去了');
                    return true;
                }
                else if($('#description').val() == ''){
                    $('.divalert').html('请输入约见描述');
                    return true;
                }
                else if(oThis.queryTrade()){
                    console.log(123);
                    $('.divalert').html('您发布的约见时间重复了！');
                    return true;
                }
                return false;
                break;
            case 1:
                if($('#alertmoney').val() == ''){
                    $('.divalert').html('请输入约见价格');
                    return true;
                }else if($('#alertmoney').val() != parseInt($('#alertmoney').val())){
                    $('.divalert').html('约见价格请输入不小于零的整数');
                    return true;
                }
                return false;
                break;
            case 2:
                if($('#meetaddress').val == ''){
                    $('.divalert').html('请输入约见地点');
                    return true;
                }
                return false;
                break;
        }
    }
}

var selljs = {
    init:function(){
        //pagedom begin
        if(yj_base.uid == undefined || yj_base.group != 'seller') window.location.href="index.php";
        $('.select_welfare_span').click(function(){
            $('.select_welfare_span').each(function(){$(this).removeClass('select_welfare_do');});
            $(this).addClass('select_welfare_do');              
            if($('.select_welfare_span:first').hasClass('select_welfare_do')){
                $('.select_subpro').css('visibility','visible');
            }else{
                $('.select_subpro').css('visibility','hidden');
            }
        });
        $('.select_subpro').find('.checkbox').click(function(){
            if($(this).hasClass('act'))
                $(this).removeClass('act');
            else
                $(this).addClass('act');
        });
        $('.paper').animate({top : '111px'},800,'swing');
        var dimnum = 0;
        $('.dimdown').bind('click',function(){
            if(yj_sell.queryDim(dimnum))
                return;
            else
                $('.divalert').html('');
            var ss = $('.paperinfo').css('top');
            if(ss.length == 3){
                ss=0;
            }else{
                ss = parseInt(ss.substring(1,4));
            }
            if(ss == 390){
                $('.dimdown').hide();
                $('.dimok').show();
            }
            if(ss <= 390){
                $('.paperinfo').animate({ top : (-ss)-195+'px'}, 500,'swing');
                $('.paperin').animate({ top : (-ss)-195+'px'}, 500,'swing');
                dimnum++;
            }
            rulerchange(dimnum);
        })
        $('.dimup').bind('click',function(){
            var ss = $('.paperinfo').css('top');
            if(ss.length == 3){
                ss=0;
            }else{
                ss = parseInt(ss.substring(1,4));
            }
            if(ss > 390){
                $('.dimok').hide();
                $('.dimdown').show();  
            }
            if(ss != 0){
                $('.paperinfo').animate({ top : (-ss)+195+'px'}, 500,'swing');
                $('.paperin').animate({ top : (-ss)+195+'px'}, 500,'swing');
                dimnum--;
            }
            rulerchange(dimnum);
        })
        $('.dimok').bind('click',function(){
            var ss = yj_sell.createTrade();
            if(ss){
                $('.paper').animate({top : '455px'},300,'swing');
            }
            setTimeout(window.location.href="index.php",300);
        });
        $('#description').focus(function(){
            $('.sellfrexam').css('visibility','visible');
        });
        $('.sellfrexam').find('a').each(function(){
            $(this).click(function(){
                var ss = $(this).html();
                var aa = $('#description').val();
                $('#description').val(aa+' '+ss);
            });
        });
        /***百度地图**/
        var map = new BMap.Map("paper_map");            // 创建Map实例
        var point = new BMap.Point(116.404, 39.915);    // 创建点坐标
        map.centerAndZoom(point,15);                     // 初始化地图,设置中心点坐标和地图级别。
        map.enableScrollWheelZoom();                            //启用滚轮放大缩小  
        map.addControl(new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type:  BMAP_NAVIGATION_CONTROL_ZOOM})); 
        map.setDefaultCursor("url('./Public/images/point.png')");   
        var gc = new BMap.Geocoder();    
        map.addEventListener("click", function(e){        
            var pt = e.point;
            gc.getLocation(pt, function(rs){
                var addComp = rs.addressComponents;
                $('#meetaddress').val(addComp.city + addComp.district + addComp.street + addComp.streetNumber);
            });        
        });
        $('#meetaddress').keydown(function(){
            if(event.keyCode == 13){
                var ss = $(this).val();
                var myGeo = new BMap.Geocoder();
                myGeo.getPoint(ss, function(point){
                  if (point) {
                    map.centerAndZoom(point, 16);
                    map.addOverlay(new BMap.Marker(point));
                  }
                }, "北京市");
            }  
        });
        $('.loc').click(function(){
            var ss = $(this).val();
            var myGeo = new BMap.Geocoder();
            myGeo.getPoint(ss, function(point){
              if (point) {
                map.centerAndZoom(point, 16);
                map.addOverlay(new BMap.Marker(point));
              }
            }, "北京市");
        });
        //***百度地图***//

    }
};
selljs.init();
function rulerchange(dimnum){
    $('.rul_bin').find('ul').find('li').each(function(i){
        if(i == dimnum)
            $(this).addClass('rul_bin_cur');
        else
            $(this).removeClass('rul_bin_cur');
    });
    $('.ruler ul:gt(0)').find('li').each(function(i){
        if(i <= dimnum)
            $(this).addClass('rul_cur');
        else
            $(this).removeClass('rul_cur');
    });
}
function openintro(){

}


















