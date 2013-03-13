var datepicker = {
	init:function(input){
		var dd = new Date();
        var oThis = this;
		this.month = dd.getMonth()+1;
		this.year = dd.getFullYear();
		this.date = dd.getDate();
		this.arrayfo=[31,28,31,30,31,30,31,31,30,31,30,31];
        this.arrayoo=[31,29,31,30,31,30,31,31,30,31,30,31];
        this.currentarr;
        this.initdate();
        this.tradedata;
        $('.leftpic_btn').click(function(){
            oThis.dimcahnge('pre');
        });
        $('.rightpic_btn').click(function(){
            oThis.dimcahnge('next');
        });
        if(input!=undefined) this.timeinit(input);
        else{
            $('#datepicker').show();
            $('.leftpic_btn').unbind('click').bind('click',function(){
                oThis.dimcahnge('pre','dis');
            });
            $('.rightpic_btn').unbind('click').bind('click',function(){
                oThis.dimcahnge('next','dis');
            });
            this.initdate('dis');
        } 
	},
	timeinit:function(input){
		var oThis = this;
        $('#'+input).focus(function(){
            $('.date_time,.date_control,#datepicker').show();
        });
        $('#ipt_date_time').focus(function(){
            $('#sel_time').show();
        });    
        $('#sel_time').find('a').each(function(){
            $(this).click(function(){
                $('#ipt_date_time').val($(this).find('div').html());
                $('#sel_time').hide();
            });
        });
        $('#ipt_date_hr').val((new Date()).getHours());
                $('.ctl_cont_right').click(function(){
            var tt,qq;
            var re = new RegExp('5');
            var st =[];
            var ss = $('#ipt_date_time').val().toString();
            if(re.test(ss)){
                st = ss.split('.');
                if($('.date_sel_clk').html()==null){
                	alert('请选择日期');
                	return ;
                }
                else if(/^\d+$/.test($('#ipt_date_hr').val()) && parseInt($('#ipt_date_hr').val())<=24 && parseInt($('#ipt_date_hr').val()) >=0) {
                	qq = parseInt($('#ipt_date_hr').val())+parseInt(st[0]);
                	if(qq > 24) qq = qq-24;
                	qq = qq.toString() + ':30';
                }
                else{
                	alert('请输入0-23整数');
                	return ;
                }
            }else{
                if(ss == '大于2') ss = '2';
                qq = parseInt($('#ipt_date_hr').val())+parseInt(ss);
                if(qq > 24) qq = qq-24;
                qq = qq.toString() + ':00';
            }
            var yyr,mmr,ddr;
            yyr = $('#datepic_month').html().split('年');
            mmr = yyr[1].split('月');
            ddr = $('.date_sel_clk').find('div').html();
            if($('.date_sel_clk').hasClass('nt_th')){
                if(parseInt($('.date_sel_clk').find('div').html()) > 24){
                    mmr[0] = parseInt(mmr[0])-1;
                    if(mmr[0] == 0) mmr[0] = 12;
                }else{
                    mmr[0] = parseInt(mmr[0])+1;
                    if(mmr[0] == 13) mmr[0] = 1;
                }
            }
            tt = yyr[0]+'-'+mmr[0]+'-'+ddr+'  '+$('#ipt_date_hr').val()+':00~'+qq;
            $('#'+input).val(tt);
            $('#datepicker').hide();
        });
		$('.ctl_cont_left').click(function(){
            $('#datepicker').hide();
        });      
	},
	initdate:function(dis){
		var thismonthday,lastmonthday,mod,td,firstday,lastestday;
		var oThis = this;
		var isrun = oThis.isrunnian(oThis.year);
		if(isrun)
        	oThis.currentarr = oThis.arrayoo;
        else
        	oThis.currentarr = oThis.arrayfo;
        var yearnow,monthnow,datenow,dd,ddnow;
        dd = new Date();
        yearnow = oThis.year;
        monthnow = oThis.month;
        if(dd.getDate() == oThis.date)
        	datenow = oThis.date;
        else
        	datenow = 1;
        ddnow = new Date(yearnow+'/'+monthnow+'/'+datenow);
        thismonthday = oThis.currentarr[monthnow-1];
        if(monthnow >= 2)
        	lastmonthday = oThis.currentarr[monthnow-2];
        else
        	lastmonthday = 31;//海枯石烂12月都必须是31天呐~
        td = [];
        firstday = (new Date(yearnow+'/'+monthnow+'/1')).getDay();
        lastestday = thismonthday+firstday;
        for(var i=0,d=1,t=1,len=42;i<len;i++){
        	if(i < firstday){
        		td[i] = lastmonthday - (firstday - i -1);
        	}else if(i >= firstday && i < lastestday){
        		td[i] = d;
        		d++;
        	}else{
        		td[i] = t;
        		t++;
        	}
        }
        var str='<tr>';
        for(var i=0,a=0;i<42;i++,a++){
            if(a%7 == 0 && i != 0) str += '</tr><tr>';
            if(a < 7 && td[i] > a && firstday != 0)
                str += '<td class="nt_th1"><a href="javascript:;"><div>'+td[i]+'</div></a></td>';
            else if(a > 7 && td[i] < (a-firstday))
                str += '<td class="nt_th2"><a href="javascript:;"><div>'+td[i]+'</div></a></td>';
            else
                str += '<td class="ye_th"><a href="javascript:;"><div>'+td[i]+'</div></a></td>';
        }
        str += '</tr>';
        var strtit = this.year+'年'+this.month+'月';
        $('#datepic_month').html(strtit);
        $('#datepic_tab tr:gt(0)').remove();
        $('#datepic_tab').append(str);
		// if(dd == undefined) alert("2b,你又出错了!");
        
        var clkCalss = 'date_sel_clk';
        if(dis=='dis'){
            clkCalss = 'date_clk';
            $('#datepic_tab').find('td').click(function(){
                $('#datepic_tab').find('td').removeClass(clkCalss);
                if($(this).hasClass('nt_th1'))
                    oThis.dimcahnge('pre',dis);
                else if($(this).hasClass('nt_th2'))
                    oThis.dimcahnge('next',dis);
                else{
                    $(this).addClass(clkCalss);
                    oThis.initTradeDate('',$(this));
                }
            });  
        }else{
            $('#datepic_tab').find('td').click(function(){
                $('#datepic_tab').find('td').removeClass(clkCalss);
                if($(this).hasClass('nt_th1'))
                    oThis.dimcahnge('pre',dis);
                else if($(this).hasClass('nt_th2'))
                    oThis.dimcahnge('next',dis);
                else{
                    $(this).addClass(clkCalss);
                }
            });  
        }
		
	},
	dimcahnge:function(dim,dis){
		var yandm,yearnow,monthnow;
		var oThis = this;
		yandm = $('#datepic_month').html();
		yearnow = parseInt(yandm.substr(0,4));
		monthnow = parseInt(yandm.substring(5,7));
		if(dim == 'pre'){
			if(monthnow == 1){
				this.month = 12;
				this.year = yearnow - 1;
			}else{
				this.month = monthnow - 1;
			}
		}
		else{
			if(monthnow == 12){
				this.month = 1;
				this.year = yearnow + 1;
			}else{
				this.month = monthnow + 1;
			}
		}
		oThis.initdate(dis);
        oThis.initTradeDate();
	},
    initTradeDate:function(data,div){
        if(data != '' &&data != undefined){
            this.tradedata = data;
        }
        if(this.tradedata == undefined ||this.tradedata == null) 
            return ;
        else
            var datain = this.tradedata;
        var y_m = $('#datepic_month').html();
        var year = y_m.substr(0,4);
        var month = parseInt(y_m.substr(5,2)) == y_m.substr(5,2)?y_m.substr(5,2):y_m.substr(5,1);
        // console.log(year,month);
        if(div == undefined){
            for(var i=0,len=datain.length;i<len;i++){
                var date = new Date(datain[i].date);
                if(date.getFullYear() == parseInt(year) && date.getMonth()+1 == parseInt(month)){
                    $('.ye_th:eq('+(parseInt(date.getDate())-1)+')').addClass('date_meet');
                }
            }
        }else{
            var result = false;
            for(var i=0,len=datain.length;i<len;i++){
                var ss = new Date(datain[i].date);
                var date = new Date(ss.getFullYear()+'/'+(ss.getMonth()+1)+'/'+ss.getDate());
                var seldate = new Date(year+'/'+month+'/'+$(div).text());
                if(date - seldate == 0){
                    $('.ticketin p:eq(0)').html('时间：'+datain[i].time);
                    $('.ticketin p:eq(1)').html('地点：'+datain[i].address);
                    $('.ticketin p:eq(2)').html(datain[i].content);
                    result = true;
                }
            }
            if(!result){
                $('.ticketin p:eq(0)').html('时间：');
                $('.ticketin p:eq(1)').html('地点：');
                $('.ticketin p:eq(2)').html('该日无约见信息'); 
            }
        }
    },
	isrunnian:function(year){
		var runnian;
    	if(year%100 == 0){
            if(year%400 == 0){
                runnian = true;
            }
        }else if(year%4 == 0){
                runnian = true;
        }else{runnian = false;}
        return runnian;
	}
}