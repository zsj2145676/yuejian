var yj_userinfo = {
	init:function(page){
		this.uid = yj_base.getUrlString('uid');
		if(this.uid == null) 
			window.location.href='404.html';
		this.tradepage = 0;
		this.total_tradepage =1;
		this.comitpage = 1;
		this.total_comitpage =1;
		var comit,trade;
		var oThis = this;
		//用户不对的时候去掉修改按钮
		if(yj_base.uid != oThis.uid){
			$('.modify').remove();
			$('.head_modify').remove();
		}
		if(page == "detail"){
			this.tradeOnCat();
			this.queryBaseInfo(oThis.uid);
			this.queryCommit();
			this.queryTrade('plus','init');
			this.queryInformation();
			this.queryCareUser(8);
		}else if(page == "customer"){
			this.queryBaseInfo(oThis.uid);
			this.queryICare(10);
			this.queryMyAlert();
		}
	},
	//******用户基本信息******//
	queryBaseInfo:function(uid){
		var userdata;
		req_userinfo.ajaxQueryUserinfo(uid,function(data){
			//data = eval('('+data+')');
			if(data == null){
				window.location.href = '404.php';
				return ;
			}else{
				userdata = data;
			}
		},function(){});
		$('#de_name').val(userdata.name);
		$('#de_birthday').val(userdata.birthday);
		$('#de_occupation').val(userdata.occupation);
		$('#de_school').val(userdata.school);
		$('#de_product').val(userdata.product);
		$('#de_duty').val(userdata.job);
		$('.headimg').attr('src',userdata.avatar);
		$('#wantto').html(userdata.follower_count);
		$('#avgprice').html(userdata.avg_price);
		if(userdata.video != null){
			var strr = '<embed src="'+userdata.video+'" allowFullScreen="true" quality="high" width="480" height="400" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>';
		}else{
			var strr= '<p>该用户暂无视频信息</p>';
		}
		$('.cont_vadio').html(strr);
		if(userdata.weibo.mof == 1){
			$('#del_per_tit').html('<span></span>'+userdata.weibo.duty);
			var str = '<iframe width="100%" height="800" class="share_self"  frameborder="0" scrolling="no" src="http://show.smyx.net/show.php?width=0&height=800&fansRow=2&ptype=1&speed=0&skin=4&isTitle=1&noborder=1&isWeibo=1&isFans=0&uid='+userdata.weibo.wid+'&verifier=7c978b56&t=sina&s='+userdata.weibo.wid+'&q=girlcss"></iframe>'
		}else{
			$('#del_per_tit').find('span').remove();
			$('#del_per_tit').html('该用户尚未微博认证！');
			var str = '<p>该用户暂无微博认证</p>';
		}
		$('.cont_weibo').html(str);
	},
	modifyBaseInfo:function(){
		var name,birthday,occupation,school,product,duty;
		var oThis = this;
		name = $('#de_name').val();
		birthday = $('#de_birthday').val();
		occupation = $('#de_occupation').val();
		school = $('#de_school').val();
		product = $('#de_product').val();
		duty = $('#de_duty').val();
		req_userinfo.ajaxModifyUserinfo(name,birthday,occupation,school,product,duty,function(data){
			if(data != 1){
				alert("保存数据失败！");
			}
		},function(){yj_base.alertBackground()});
	},
	//******评论******//
	queryCommit:function(){
		var oThis = this;
		req_userinfo.ajaxQueryCommit(oThis.uid,oThis.comitpage,function(data){
			//data = eval('('+data+')');
			if(data.comments != null){
				oThis.total_comitpage = data.total_page;
				oThis.comitpage++;
				oThis.domCommit(data.comments);
			}
		},function(){yj_base.alertBackground();});
	},
	domCommit:function(data){
		var nowid = [];
		var str ='';
		$('.cont_commit li').each(function(){
			nowid.push($(this).find('.show_cmt').attr('id'));
		});
		for(var i=0,len=data.length;i<len;i++){
			if(yj_base.searchArray(nowid,data[i].id)){
				if(nowid == undefined){
					continue;
				}
				continue;
			}
			else{
				str+='<li>'
                    +'<div class="show_cmt" id="'+data[i].id+'">'
                        +'<a href="index.php?m=Index&a=detail&uid='+data[i].author+'"><img src="'+data[i].avatar+'"></a>'
                        +'<div><a href="index.php?m=Index&a=detail&uid='+data[i].author+'">'
                            +data[i].name+'</a>：'+data[i].content
                            +'<span>'+data[i].createtime+'</span>'
                        +'</div>'
                    +'</div>'
                +'</li>';
			}
		}
		$('.cont_commit').find('ul').append(str);
	},
	commitNew:function(textarea,dim){
		var oThis = this;
		if(yj_base.uid == undefined){
			alert('请登录后再评论');
			return ;
		}
		var ss = $(textarea).val();
		if(ss == '') {
			return ;
		}else if(ss.length>140){
			alert('评论请少于140个字。');
			return ;
		}
		var dd = false;
		req_userinfo.ajaxCommitNew(oThis.uid,ss,function(data){
			if(data == 1){
				dd = true;
			}
		},function(){});
		if(dd){
			var cmtdate = new Date();
			var dateStr = cmtdate.getFullYear()+'/'+cmtdate.getMonth()+1+'/'+cmtdate.getDate();
			req_userinfo.ajaxQueryUserinfo(yj_base.uid,function(data){
				//data = eval('('+data+')');
				if(data != null){
					var str ='';
					str +='<li>'
                                +'<div class="show_cmt">'
                                    +'<a href="index.php?m=Index&a=detail&uid='+data.uid+'"><img src="'+data.avatar.replace('large','small')+'"></a>'
                                    +'<div><a href="index.php?m=Index&a=detail&uid='+data.uid+'">'+data.name+'</a>：'+ss
                                		+'<span>'+dateStr+'</span>'
                                    +'</div>'
                                +'</div>'
                            +'</li>';
                    if(dim == 'pn'){
                    	$('.cont_commit').find('ul').prepend(str);
                    	$('.bl_bl').find('textarea').val('');
                    }
                    else if(dim == 'dn'){
                    	$('.cont_commit').find('ul').append(str);
                    	$('.dn_commit').find('textarea').val('');
                    }

				}else{
					alert('请先注册后再评论！');
				}
			},function(){});
		}
	},
	//******动态信息******//========================================================================
	queryInformation:function(){
		uid = this.uid;
		var datacontent;
		req_userinfo.ajaxQueryInformation(uid,function(data){
			//data = eval('('+data+')');
			if(data != null){
				datacontent = data;
			}
			else{
				datacontent = '<p>该用户暂无动态信息</p>';
			}
		},function(){});
		// 自定义的编辑器配置项,此处定义的配置项将覆盖editor_config.js中的同名配置
        var editorOption = {
            //这里可以选择自己需要的工具按钮名称,此处仅选择如下五个
            toolbars:[
            [ 'fortitle','insertimage', /*'insertvideo',*/'link'//百度ueditor视频上传会出错，若需要只需去点本行注释即可
            ]],
            //focus时自动清空初始化时的内容
            autoClearinitialContent:false,
            //关闭字数统计
            wordCount:false,
            //关闭elementPath
            elementPathEnabled:false,
            //关闭右键菜单
            contextMenu:[]
            //更多其他参数，请参考editor_config.js中的配置项
        };
        this.editor_a = new baidu.editor.ui.Editor(editorOption);
        this.editor_a.render( 'myEditor' );
        var oThis = this;
        this.editor_a.addListener("ready",function(){
            $('#edui1_toolbarbox').addClass('hide');
            $('#edui1').css('border','none');
            oThis.editor_a.setContent(datacontent);
            oThis.editor_a.disable();
        });
	},
	modifyInformation:function(){
		uid = this.uid;
		if(yj_base.uid != uid) alert('您没有修改权限或登陆已过期！');
		else{
			var status = $(document.getElementById('baidu_editor_0').contentWindow.document.body).html();
			req_userinfo.ajaxModifyInformation(status,function(data){
				if(data== 1){
					// alert('修改成功');
				}else{
					alert('修改失败，请联系客服人员~');
				}
			},function(){});
		}
	},
	//******交易******//
	queryTrade:function(plus,init){
		var oThis = this;
		if(plus == 'plus'){
			if(oThis.tradepage>=oThis.total_tradepage){
				return;
			}else{
				oThis.tradepage++;
			}
		}else if(plus == 'down'){
			if(oThis.tradepage<=1){
				return;
			}else{
				oThis.tradepage--;
			}
		}
		req_userinfo.ajaxQueryTrade(oThis.uid,oThis.tradepage,function(data){
			//data = eval('('+data+')');
			if(data.total_page > 0){
				oThis.total_tradepage = data.total_page;
				oThis.initTrade(data.trade,plus,init);
			}else{
				$('.contantbuy').html('<center style="margin-top:100px;color:#EC5E60">暂无约见信息</center>');
			}
		},function(){yj_base.alertBackground();});
	},
	initTrade:function(data,plus,init){
		if(yj_userinfo.loop!=null){
			clearInterval(yj_userinfo.loop);
		}
		var oThis = this;
		var smallH = parseInt($('.road').height()/oThis.total_tradepage)+1;
		$('.xiaohuakuai').height(smallH);
		if(init == 'init'){
		}else if(plus == 'plus'){
			$('.xiaohuakuai').animate({'margin-top':'+='+smallH},200);
		}else{
			$('.xiaohuakuai').animate({'margin-top':'-='+smallH},200);
		}
		var month = data.date.substring(0,4)+'/'+data.date.substring(5,7);
		var date = data.date.substring(8,10);
		date = parseInt(date); 
		$('#buyclk').attr('tradeid',data.tradeid);
		$('.price').html(data.price);
		$('.buymonth').html(month);
		$('.buydate').html(date);
		$('.lowpr:eq(1)').html(data.time);
		this.timeTrade(data.deadline);
	},
	timeTrade:function(str){
		var oThis = this;
		var dead = new Date(str);
		var now = new Date();
		this.leftms = parseInt((dead.getTime() - now.getTime())/1000);
		this.loop = setInterval("getTime()",1000);
	},
	tradeOnCat:function(){
		req_userinfo.ajaxTradeAll(this.uid,function(data){
			if(data != null){
				//data = eval('('+data+')');
				datepicker.initTradeDate(data);
			}else{}
		},function(){});
	},
	//********关注*********//
	careIt:function(){
		if(this.uid == yj_base.uid){
			alert('不需要关注自己！');
			return ;
		}
		req_userinfo.ajaxCareIt(this.uid,function(data){
			if(data == 1){
				$('#wantto').html(parseInt($('#wantto').html())+1);
				alert('关注成功！');
			}else if(data == 2){
				alert('已经关注！');
			}else{
				alert('关注失败！');
			}
		},function(){});
	},
	queryCareUser:function(page){
		var oThis = this;
		//page 第一次还是全部
		req_userinfo.ajaxQueryCareUser(oThis.uid,page,function(data){
			//data = eval('('+data+')');
			if(data.followers != null){
				oThis.domCare(data.followers);
			}
		},function(){
			yj_base.alertBackground();
		});
	},
	domCare:function(data){
		var str ='';
		for(var i=0,len = data.length;i<len;i++){
			str +='<li>'
                  +'<a href="index.php?m=Index&a=detail&uid='+data[i].follower+'"><img src="'+data[i].avatar+'"/></a>'
                  +'<a href="index.php?m=Index&a=detail&uid='+data[i].follower+'">'+data[i].name+'</a>'
                  +'</li>';
		}
		$('.want_see ul').html(str);
	},
	queryICare:function(count){
		//这里的count限制数量，如果为''则查询全部
		req_userinfo.ajaxQueryICare(count,function(data){
			//data = eval('('+data+')');
			if(data != undefined){
				var friends = data.friends;
				if(friends != null){
					var str = '';
					for(var i=0,len=friends.length;i<len;i++){
						str +='<li>'
	                         +'<div>'
	                         +'<a href="index.php?m=Index&a=detail&uid='+friends[i].friend+'"><img src="'+friends[i].avatar+'"></a>'
	                         +'<br />'
	                         +'<a href="index.php?m=Index&a=detail&uid='+friends[i].friend+'">'+friends[i].name+'</a>'
	                         +'</div>'
	                         +'</li>';
					}
					$('.carelistin').find('ul').html(str);
				}
			}
		},function(){
			yj_base.alertBackground();
		});
	},
	//******我的个人宣言*******//
	queryMyAlert:function(){
		req_userinfo.ajaxQueryMyAlert(function(data){
			//data = eval('('+data+')');
			if(data!=null){
				$('.keywords').find('textarea').val(data.declaration);
			}
		},function(){
			yj_base.alertBackground();
		});
	},
	modifyMyAlert:function(){
		var ss = $('.keywords').find('textarea').val();
		req_userinfo.ajaxModifyMyAlert(ss,function(data){
			if(data == 1){
			    //alert('修改成功');
			}else{
			    alert('修改失败');
			}
		},function(){
			yj_base.alertBackground();
		});
	}
};

function getTime(){
	var timems = yj_userinfo.leftms;
	if(timems<=0){
		clearInterval(yj_userinfo.loop);
		$('.leavetime').html('竞拍已经结束');
	}else{
		var day = parseInt(timems/(60*60*24));
		var hour = parseInt(timems/(60*60)) - day*24;
		var min = parseInt(timems/60) - day*24*60 - hour*60;
		var sec = timems%60;
		var returnstr = '竞拍剩余时间：'+day+'天'+hour+'小时'+min+'分'+sec+'秒';
		$('.leavetime').html(returnstr);
		yj_userinfo.leftms--;
	}
}













