var blockTexts = {
	'我是学生': ['留学','创业','找工作','读研','GPA','快乐'],
	'我在职场': ['升职','跳槽','留学','读研','创业','赚钱','快乐'],
	'我在创业': ['好产品','赚钱','快乐','找工作','读研','留学']
};
function clkUlBlocks(e){
	var nodeE = e.target;
	if(nodeE.tagName == 'I'){nodeE = nodeE.parentNode}
	if(nodeE.tagName != 'LI'){return}else{nodeE = $(nodeE)}
	if(nodeE.hasClass('moreblock')){
		nodeE.hide().parent().find('li.liblock').show();
	}else{
		var nodeI = nodeE.find('i.imarkCK');
		if(nodeI.length){nodeI.remove()}else{nodeE.append('<i class="imarkCK"></i>')}
	}
}
function createBlocks(str_titl){
	var blockMore = $('#init_dlg_flzs .blocks .moreblock').hide();
	var blockOld = blockMore.parent().find('li.liblock');
	var blockTexta = blockTexts[str_titl];
	var blockHLis = [];
	if(!blockTexta){return}
	blockOld.remove();
	$(blockTexta).each(function(i, item){
		var strTmp = '<li class="liblock color' +(Math.round(Math.random()*3)+1)+ '"';
		strTmp += (i>=7? ' style="display:none;"':'')+ '>' +item+ '</li>';
		blockHLis.push(strTmp);
	});
	blockMore.before(blockHLis.join('\r\n'));
	if(blockHLis.length > 7){blockMore.show()}
}
function clkUlclsTitl(e){
	var nodeE = e.target;
	if(nodeE.tagName != 'LI'){return}else{nodeE = $(nodeE)}
	if(nodeE.hasClass('curr')){return}
	nodeE.parent().find('li.titl_li').removeClass('curr');
	createBlocks(nodeE.addClass('curr').text());
}
function clkFootBtnOk(){
    var today = new Date();
    var month = today.getMonth()+1;
    var todayString = today.getFullYear()+'/'+month+'/'+today.getDate();
    if($.cookie('selection_date') == undefined) {
        $.cookie('selection_date',todayString , { expires: 30 });
    }else{
        if($.cookie('selection_date').indexOf(todayString)==-1 ){
            $.cookie('selection_date', todayString, { expires: 30 });
            $.cookie('selection_times', 0, { expires: 30 });
        }
    }
    if($.cookie('selection_times')>=30){
        alert('今天选择次数过多！');
        return;
    }
    
    
    var init_dlg = $('#init_dlg_flzs');
    var init_gz = $('#init_gz');
    var curTitl = init_dlg.find('ul.cls_titl li.titl_li.curr').text();
    var arrCtxt = [];
    init_dlg.find('ul.blocks li.liblock').each(function(){
            if($(this).find('i.imarkCK').length){arrCtxt.push($(this).text())}
    });
    //alert('在“' +curTitl+ '”分类下，选中了 ' +arrCtxt.length+ ' 项：\r\n\r\n' +arrCtxt.join(','));
    var arrCtxtString = arrCtxt.toString();
    var curTitlShort = curTitl.substring(2);
    //异步提交统计数据
    $.ajax({
        type    : "POST",
        url     : "/yuejian/l.php?m=Index&a=updateStatisticsForLandingpage",
        data : {parent_name:curTitlShort,statistics:arrCtxtString},
        success : function(data) {
            if(data.status == 1) {
                if($.cookie('selection_times') == undefined) {
                    $.cookie('selection_times', 1, { expires: 30 });
                }else{
                    var times = parseInt($.cookie('selection_times'))+1;
                    $.cookie('selection_times', times, { expires: 30 });
                }

            }else{
                alert('服务器异常，请联系客服！');
            }
        },
        error : function(xmlHttp, textStatus) {
            alert('服务器异常，请联系客服！');
        }
    });


    if(arrCtxt.length){
            init_dlg.hide();
    init_gz.fadeIn();
    }	
}


$(function(){
	var init_dlg = $('#init_dlg_flzs');
	init_dlg.find('ul.blocks').click(clkUlBlocks);
	createBlocks(init_dlg.find('ul.cls_titl li.titl_li').click(clkUlclsTitl).first().addClass('curr').text());
	init_dlg.find('.foot_box .foot_btns').mousedown(function(){$(this).addClass('ms_down')}).mouseup(function(){$(this).removeClass('ms_down')}).mouseout(function(){$(this).removeClass('ms_down')}).click(clkFootBtnOk);
});

function gz_done(){
	$('#init_gz').fadeOut();
}

$(function(){
	$('#hero .slide-content .slide-item .slide-info .sl-info div a p').first().toggle(function(e){
		var oPos = $(this).offset();
		e.preventDefault();
		oPos.top += 50; oPos.left -= 30;
		$('#init_dlg_flzs').css(oPos).show();
	}, function(){
		$('#init_dlg_flzs').hide();
	});
});