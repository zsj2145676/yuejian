var yj_search = {
	init:function(){
		var oThis = this;
		this.page = 1;
        this.total_page = 1;
		this.searchTrade();
		this.initTrade();
		$(window).scroll(function(){
			if($(document).scrollTop()>=$(document).height()-$(window).height()){
				// alert("到底了！");
				if(oThis.page <= oThis.total_page){
					oThis.page++;
					oThis.initTrade();
				}	
			}
		});
	},
	initTrade:function(){
		var oThis = this;
		$.ajax({
			type    : "GET",
            url     : "/a.php?m=Search",
            async : false,
            data : {type:oThis.type,key:oThis.name,page:oThis.page},
            success : function(data) {
            	//data = eval('('+data+')');
            	oThis.total_page = data.total_page;
            	oThis.appendItem(data.result);
            },
            error : function(xmlHttp, textStatus) {
                yj_base.alertBackground();
            }
		});
	},
	searchTrade:function(){
		var name,type;
		var oThis = this;
		var typestr = yj_base.typestr;
		name = decodeURI(yj_base.getUrlString('name'));
		type = yj_base.getUrlString('type');
		if(type != null){
			oThis.type = type;
			oThis.name = '';
			$('.numberseltit').html(typestr[type]);
			$('#navbar').find('li:contains('+typestr[type]+')').find('.nav_img').show();
			$('#navbar').find('li:contains('+typestr[type]+')').unbind('mouseout').unbind('mouseover');
			return ;
		}else if(name != null){
			oThis.type = '';
			oThis.name = name;
			return ;
		}else{
			oThis.type = '';
			oThis.name = '';
			return ;
		}
	},
	appendItem:function(data){
		if(data == null) return ;
		var str = '';
		for(var i =0,len=data.length;i<len;i++){
            if(data[i].tradeid != null){
                str += '<div class="box col" uid="'+data[i].seller+'" tradeid="'+data[i].tradeid+'">'
                    +'<div class="yjbtn hide"><a href="javascript:void(0);" ><div class="commitbtn"></div></a></div>'
                    +'<a href="index.php?m=Index&a=detail&uid='+data[i].seller+'" ><img src="'+data[i].avatar+'" class="img"/></a>'
                    +'<div class="headimginfo">'
                        +'<p><span class="headimgtitle">'+data[i].name+':“'+data[i].description+'”</span></p>'
                        +'<div class="headmginfo_p"><p><span class="headimgprice1">约见价</span>&nbsp;<span class="red">￥'+data[i].price+'</span></p>'
                        +'<p class="detail"><a href="index.php?m=Index&a=detail&uid='+data[i].seller+'" >【查看详情】</a></p></div>'
                        +'<div class="commit cmt_tit">'
                            +'<div class="commit_tit">'
                                +'<p><span>'+data[i].total_cmt+'</span>人参与评价</p>'
                                +'<a href="javascript:;"><div></div></a>'
                            +'</div>'
                        +'</div>'
                        +'<div class="commit cmt_del">  '
                            +'<ul>'
                                +'<li><a href="javascript:;" title="帅" onclick="indexjs.cmmitPerson(this);">'
                                    +'<div class="commit_item commit_1">'
                                        +'<div class="commit_bg">'
                                        +'</div>'
                                        +'<p>'+data[i].shuai+'</p>'
                                    +'</div>'
                                +'</a></li>'
                                +'<li><div class="dotYline"></div></li>'
                                +'<li><a href="javascript:;" title="萌" onclick="indexjs.cmmitPerson(this);">'
                                    +'<div class="commit_item commit_2">'
                                        +'<div class="commit_bg">'
                                        +'</div>'
                                        +'<p>'+data[i].meng+'</p>'
                                    +'</div>'
                                +'</a></li>'
                                +'<li><div class="dotYline"></div></li>'
                                +'<li><a href="javascript:;" title="牛" onclick="indexjs.cmmitPerson(this);">'
                                    +'<div class="commit_item commit_3">'
                                        +'<div class="commit_bg">'
                                        +'</div>'
                                        +'<p>'+data[i].niu+'</p>'
                                    +'</div>'
                                +'</a></li>'
                            +'</ul>'
                        +'</div>'
                        +'<div class="write convo clearfix"><a href=# title="" class="img"><img class="default_cmt_head" src="/Public/images/default_buddy_icon.jpg"></a>'
                            +'<form action="" method="POST">'
                                +'<textarea placeholder="快速出价" class="GridComment ani-affected " autocomplete="off" ></textarea>'
                            +'<ul class="ac-choices" style="display: none; z-index: 42; opacity: 0; "></ul>'
                            +'<a href="#" onclick="return false;" class="grid_comment_button"></a></form>'
                        +'</div>'
                    +'</div>'
                +'</div>';
            }else{
                str += '<div class="box col" uid="'+data[i].seller+'" tradeid="'+data[i].tradeid+'">'
                    // +'<div class="btn hide"><a href="javascript:void(0);" ><div class="commitbtn"></div></a></div>'
                    +'<a href="index.php?m=Index&a=detail&uid='+data[i].seller+'" ><img src="'+data[i].avatar+'" class="img"/></a>'
                    +'<div class="headimginfo">'
                        +'<p><span class="headimgtitle">'+data[i].name+':“'+data[i].description+'”</span></p>'
                        +'<div class="headmginfo_p"><p><span class="headimgprice1">暂无约见信息</span>&nbsp;<span class="red"></span></p>'
                        +'<p class="detail"><a href="index.php?m=Index&a=detail&uid='+data[i].seller+'" ></a></p></div>'
                        +'<div class="commit cmt_tit">'
                            +'<div class="commit_tit">'
                                +'<p><span>'+data[i].total_cmt+'</span>人参与评价</p>'
                                +'<a href="javascript:;"><div></div></a>'
                            +'</div>'
                        +'</div>'
                        +'<div class="commit cmt_del">  '
                            +'<ul>'
                                +'<li><a href="javascript:;" title="帅" onclick="indexjs.cmmitPerson(this);">'
                                    +'<div class="commit_item commit_1">'
                                        +'<div class="commit_bg">'
                                        +'</div>'
                                        +'<p>'+data[i].shuai+'</p>'
                                    +'</div>'
                                +'</a></li>'
                                +'<li><div class="dotYline"></div></li>'
                                +'<li><a href="javascript:;" title="萌" onclick="indexjs.cmmitPerson(this);">'
                                    +'<div class="commit_item commit_2">'
                                        +'<div class="commit_bg">'
                                        +'</div>'
                                        +'<p>'+data[i].meng+'</p>'
                                    +'</div>'
                                +'</a></li>'
                                +'<li><div class="dotYline"></div></li>'
                                +'<li><a href="javascript:;" title="牛" onclick="indexjs.cmmitPerson(this);">'
                                    +'<div class="commit_item commit_3">'
                                        +'<div class="commit_bg">'
                                        +'</div>'
                                        +'<p>'+data[i].niu+'</p>'
                                    +'</div>'
                                +'</a></li>'
                            +'</ul>'
                        +'</div>'
                        +'<div class="write convo clearfix"><a href=# title="" class="img"><img class="default_cmt_head" src="/Public/images/default_buddy_icon.jpg"></a>'
                            +'<form action="" method="POST">'
                                +'<textarea placeholder="快速出价" class="GridComment ani-affected " autocomplete="off" ></textarea>'
                            +'<ul class="ac-choices" style="display: none; z-index: 42; opacity: 0; "></ul>'
                            +'<a href="#" onclick="return false;" class="grid_comment_button"></a></form>'
                        +'</div>'
                    +'</div>'
                +'</div>';
            }
			
		}
		$('#container').append(str).imagesLoaded(function(){this.masonry("reload")});
		indexjs.initAgain();
	}
}




















