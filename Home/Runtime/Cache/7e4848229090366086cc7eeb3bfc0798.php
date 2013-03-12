<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
    	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>在这里，约见你</title>
    	<link rel="stylesheet" type="text/css" href="__CSS__/base.css" media="screen"/>
        <link href="__BS__/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="__BS__/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link rel="icon" href="__IMG__/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="__IMG__/favicon.ico" type="image/x-icon" />
        <script type="text/javascript" src="__JS__/lib/jquery-1.9.1.min.js"></script>
        <script src="__JS__/lib/modernizr-transitions.js"></script>
        <script src="__JS__/lib/jquery.masonry.min.js"></script>
        <script src="__JS__/function/base.js" type="text/javascript"></script>
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements --><!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
      <!--[if lte IE 6]>
      <!-- bsie css 补丁文件 -->
      <link rel="stylesheet" type="text/css" href="__BS__/iehack/bootstrap-ie6.min.css">

      <!-- bsie 额外的 css 补丁文件 -->
      <link rel="stylesheet" type="text/css" href="__BS__/iehack/ie.css">
      <![endif]-->
    </head>
	<body>
        <div class="bardiv hide" id="point"><a href="javascript:void(0);" title="回到顶部"></a></div>
        <div id="include" style="top:276px;">
        <div id="numbersel">
        	<div class="numberseltit">约见:</div>
        </div>
        <div class="mainline"></div>
        <div id="main">  
           <div id="container" class="transitions-enabled centered clearfix" style="">
           </div>
       	</div>
       	</div>
    <div id="footer">
        <a href="/yuejian/index.php?m=Index&a=sell" target="_blank"><div></div></a>
    </div>
    <!--<div id="flog" class="log"></div>-->
    <div id="bflog" class="log"></div>
    <script type="text/javascript">
    var user,group;
    user = "<?php echo ($uid); ?>";
    group = "<?php echo ($group); ?>";
    if(group == ''){
        $('#footer,#messagebar').remove();
    }else{
        var ii = parseInt(group);
        switch(ii){
            case 0:
                $('#footer,#messagebar').remove();
                break;
            case 1: //管理员登陆
                yj_base.uid = user;
                yj_base.group = 'admin';
                break;
            case 2: //买家登陆
                yj_base.uid = user;
                yj_base.group = 'guest';
                // yj_sidebar.init(user);
                $('#footer').remove();
                break;
            case 3: //卖家登陆
                yj_base.uid = user;
                yj_base.group = 'seller';
                // yj_sidebar.init(user);
                break;
            default:
                $('#footer,#messagebar').remove();
                break;
        }
    }
</script>
<script src="__JS__/function/log_reg.js" type="text/javascript"></script>
<script src="__JS__/function/req_log_reg.js" type="text/javascript"></script>
<div id="headlogo">
    <div id="logotop"><div class="logoright"></div></div>
    <div id="loginbar">
<!--        <div class="searchbar">
            <input type="text" id="searchbar_ipt" value="请输入您感兴趣的关键字"/>
        </div>-->
    
    <div class="form-search" style="float: left;">
    <div class="input-append" >
        <input type="text" id="searchbar_ipt" class="span2 search-query" value="请输入您感兴趣的关键字">
        <button type="button" class="btn"><i class="icon-search"></i></button>
    </div>
    </div>
        <div class="login_register">
        	<ul><?php echo ($navdiv); ?></ul>
        </div>
        <div class="typebar goindex" style="margin-left: 10px;">
            <a href="index.php">
                <span style="background-position: -191px -102px;"></span>
                首页
            </a>
        </div>
        <div class="typebar fir_typ" style="background:#F5F6F4;">
    		<a href="javascript:void(0);">
            	<span style="background-position: -192px -27px;"></span>
                分类
            </a>
    		</div>
        <div class="typebar sec_typ">
            <a href="javascript:void(0);">
                <span></span>扩展
            </a>
        </div>
        
        <div id="sec_typ_cont">
            <div class="red leftpane">{
            </div>
            <div class="minpane">
                <ul>
                    <li><a href="index.php?m=Index&a=extpage&type=1">邮件</a>
                    </li>
                    <li><a href="index.php?m=Index&a=extpage&type=2">设置</a>
                    </li>
                    <li><a href="index.php?m=Index&a=extpage&type=3">关于约见</a>
                    </li>
                </ul>
            </div>  
            <div class="red rightpane">
            }
            </div>
        </div>
    </div>
</div>
<div id="navbar">
    <ul>
    <li><a href="index.php?type=3385FF"><div class="nav_nav" style="background:#3385FF;"><span>科技</span><div class="nav_img" style="background-position:-23px -489px;"></div></div></a></li>
    <li><a href="index.php?type=00B3FF"><div class="nav_nav" style="background:#00B3FF;"><span>金融</span><div class="nav_img" style="background-position:-75px -489px;"></div></div></a></li>
    <li><a href="index.php?type=FF38A8"><div class="nav_nav" style="background:#FF38A8;"><span>美女</span><div class="nav_img" style="background-position:-124px -489px;"></div></div></a></li>
    <li><a href="index.php?type=E3007F"><div class="nav_nav" style="background:#E3007F;"><span>艺术</span><div class="nav_img" style="background-position:-177px -489px;"></div></div></a></li>
    <li><a href="index.php?type=A2E024"><div class="nav_nav" style="background:#A2E024;"><span>教育</span><div class="nav_img" style="background-position:-227px -489px;"></div></div></a></li>
    <li><a href="index.php?type=FF8E24"><div class="nav_nav" style="background:#FF8E24;"><span>娱乐</span><div class="nav_img" style="background-position:-279px -489px;"></div></div></a></li>
    <li><a href="index.php?type=A736FF"><div class="nav_nav" style="background:#A736FF;"><span>体育</span><div class="nav_img" style="background-position:-328px -489px;"></div></div></a></li>
    <li><a href="index.php?type=B6C70A"><div class="nav_nav" style="background:#B6C70A;"><span>传媒</span><div class="nav_img" style="background-position:-380px -489px;"></div></div></a></li>
    </ul>
    <div id="navfont"></div>
</div>
<div id="minnavbar">
    <ul>
        <li><a href="index.php?type=3385FF"><div style="background:#3385FF;">科技</div></a></li>
        <li><a href="index.php?type=00B3FF"><div style="background:#00B3FF;">金融</div></a></li>
        <li><a href="index.php?type=A2E024"><div style="background:#A2E024;">教育</div></a></li>
        <li><a href="index.php?type=B6C70A"><div style="background:#B6C70A;">传媒</div></a></li>
        <li><a href="index.php?type=FF8E24"><div style="background:#FF8E24;">娱乐</div></a></li>
        <li><a href="index.php?type=FF38A8"><div style="background:#FF38A8;">美女</div></a></li>
        <li><a href="index.php?type=E3007F"><div style="background:#E3007F;">艺术</div></a></li>
        <li><a href="index.php?type=A736FF"><div style="background:#A736FF;">体育</div></a></li>
    </ul>
</div>
<div id="logindiv" class="modal hide fade yjlog_rest_div" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<!--<div class="lgtit">登陆约见</div>-->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><div class="yjclose2"></div></button>
<h3>登陆约见</h3>
</div>
    <div class="quicklogin">
    	<span>使用合作账号登陆</span>
        <ul>
            <li><a href="javascript:void(0)"><div class="weibo"></div></a><p>微博</p></li>
            <li><a href="javascript:void(0)"><div class="renren"></div></a><p>人人</p></li>
            <li><a href="javascript:void(0)"><div class="tencent"></div></a><p>QQ</p></li>
        </ul>
    </div>
    <div id="login" class="log_res_right">
    	<ul style="margin-top:42px;">
            <li>用户名</li>
            <li><div class="login_ipt"><input id="username" type="text" /></div></li>
        </ul>
        <br />
		<ul id="log_password">
            <li>密&nbsp;&nbsp;&nbsp;&nbsp;码</li>
            <li><div class="login_ipt"><input id="password" type="password" /></div></li>
        </ul>
        <br />
        <div class="forgetpass"><a href="javascript:void(0)"/>忘记密码？</a></div>
        <br />
        <a href="javascript:;"><div class="sbmtlogin"></div></a>
        <p class="log_reg_alert" style="margin-left:50px;margin-top:-21px;">用户名或密码输入有误</p>  
    </div>
<!--    <div class="close"><a href="javascript:void(0)"><div id="closelogin"></div></a></div>-->
</div>
<script>
$('#username,#password').focus(function(){
    $('.log_reg_alert').hide();
});
$('.forgetpass').click(function(){
    $('.log_reg_alert').hide();
});
</script><div id="registerdiv" class="modal hide fade yjlog_rest_div" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<!--	<div class="lgtit">注册约见</div>-->
        <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><div class="yjclose2"></div></button>
<h3>注册约见</h3>
</div>
    <div class="quicklogin quickregister">
    	<span>使用合作账号登陆</span>
        <ul>
        	<li><a href="javascript:void(0)"><div class="weibo"></div></a><p>微博</p></li>
                <li><a href="javascript:void(0)"><div class="renren"></div></a><p>人人</p></li>
            <li><a href="javascript:void(0)"><div class="tencent"></div></a><p>QQ</p></li>
        </ul>
    </div>
    <div id="register" class="log_res_right">
    	<ul style="margin-top:42px;">
            <li>用户名</li>
            <li><input id="reg_username" placeholder="邮箱或手机号" type="text" /></li>
        </ul><br />
        <ul>
            <li>密&nbsp;&nbsp;&nbsp;&nbsp;码</li>
            <li><input id="reg_password" type="password" /></li>
        </ul><br />
        <ul>
            <li>确认密码</li>
            <li><input id="reg_sepassword" type="password" /></li>
        </ul><br />
        <ul>
            <li>兴&nbsp;&nbsp;&nbsp;&nbsp;趣</li>
            <li  style="margin-left:0px;">
                <div class="registertype">
                    <ul>
                        <li style="background:#3385FF" name="3385FF"><a href="javascript:void(0)">科技</a></li>
                        <li style="background:#00B3FF" name="00B3FF"><a href="javascript:void(0)">金融</a></li>
                        <li style="background:#A2E024" name="A2E024"><a href="javascript:void(0)">教育</a></li>
                        <li style="background:#B6C70A" name="B6C70A"><a href="javascript:void(0)">传媒</a></li>
                        <li style="background:#FF8E24" name="FF8E24"><a href="javascript:void(0)">娱乐</a></li>
                        <li style="background:#A736FF" name="A736FF"><a href="javascript:void(0)">体育</a></li>
                        <li style="background:#E3007F" name="E3007F"><a href="javascript:void(0)">艺术</a></li>
                    </ul>
                </div>
            </li>
        </ul><br />
        <div class="agreeto">
            <a class="agree_btn" href="javascript:void(0)"><div></div></a>
            <div><span style="line-height: 26px;">我已同意约见的</span><a href="javascript:void(0)">用户注册声明</a>
            </div>
        </div>
        <a href="javascript:void(0)"><div class="sbmtrigster" onclick="yj_register.registerNew();"></div></a>
        <p class="log_reg_alert" style="margin-top:-5px;margin-left:5px;"></p>  
    </div>
<!--    <div class="close"><a href="javascript:void(0)"><div id="closeregister"></div></a></div>-->
</div>
<script>
$('#reg_username,#reg_password,#reg_sepassword').focus(function(){
    $('.log_reg_alert').hide();
});
$('#reg_username').blur(function(){
    yj_register.queryName();
});
</script><div class="guide guidein1 hide">
    <img src="__IMG__/guide/1.png" />
    <a href="javascript:;"><div class="guide_close"></div></a>
    <a href="javascript:;"><div class="guide_btn guide_continue"></div></a>
</div>
<div class="guide guidein2 hide">
    <img src="__IMG__/guide/b1.png" />
    <a href="javascript:;"><div class="guide_close"></div></a>
    <a href="javascript:;"><div class="guide_btn guide_continue"></div></a>
</div>
<div class="guide guidein3 hide">
    <img src="__IMG__/guide/b2.png" />
    <a href="javascript:;"><div class="guide_close"></div></a>
    <a href="javascript:;"><div class="guide_btn guide_continue"></div></a>
</div>
<div class="guide guidein4 hide">
    <img src="__IMG__/guide/3.png" />
    <a href="javascript:;"><div class="guide_close"></div></a>
    <a href="javascript:;"><div class="guide_btn guide_continue"></div></a>
</div>
<div class="guide guidein5 hide">
    <img src="__IMG__/guide/4.png" />
    <a href="javascript:;"><div class="guide_close"></div></a>
    <a href="javascript:;"><div class="guide_btn guide_complete"></div></a>
</div><div class="log_rest_div buyalert" index="0">
    <div class="lgtit">信息确认</div>
    <div class="log_res_right buyalertin" >
        <ul style="margin-top:42px;">
            <li>手机号</li>
            <li><div class="login_ipt register_ipt"><p class="phoneimg"></p><input id="mobilephone" type="text" /></div></li>
            <li class="sendsms" style="margin-left: 5px;"><a href="javascript:;">发送认证码</a> </li>
        </ul>
        <br />
        <ul id="log_password">
            <li>认证码</li>
            <li><div class="login_ipt register_ipt"><p class="passimg"></p><input id="modifycode" type="text" /></div></li>
        </ul>
        <br />
        <p class="buyalert_alert"><!--这里放出错信息--></p><a href="javascript:void(0)"><div class="sbmtcont"></div></a><a href="javascript:void(0)"><div class="sbmtcomp quickbapbtn" style="display:none;"></div></a>
    </div>
    <div class="close"><a href="javascript:void(0)"><div class="closebuyalert"></div></a></div>
</div>
<div class="log_rest_div buyalert" index="1">
    <div class="lgtit">提交定金</div>
    <div class="log_res_right buyalertin" >
        <ul style="margin-top:42px;">
            <li>出价</li>
            <li><div class="login_ipt register_ipt"><p class="moneyimg"></p><input id="alertmoney" type="text" /></div></li>
        </ul>
        <br />
        <p class="buyalert_alert"><!--这里放出错信息--></p><a href="javascript:void(0)"><div class="sbmtcont"></div></a>
    </div>
    <div class="close"><a href="javascript:void(0)"><div class="closebuyalert"></div></a></div>
</div>
<div class="log_rest_div buyalert" index="2">
    <div class="lgtit payment">正在付款</div>
    <div class="log_res_right buyalertin" >
            <p>等待您的付款......</p>
        <br />
        <div style="text-align:center;margin:30px auto;width:240px;">
            <a href="javascript:;"><div class="sbmtfaild"></div></a>
            <a href="javascript:;"><div class="sbmtsuccess"></div></a>
        </div>
        <!-- <a href="javascript:void(0)"><div class="sbmtcomp"></div></a> -->
    </div>
    <div class="close"><a href="javascript:void(0)"><div class="closebuyalert"></div></a></div>
</div>
<div class="log_rest_div buyalert" index="3">
    <div class="lgtit payment">完成付款</div>
    <div class="log_res_right buyalertin" >
            <p>恭喜您已经完成竞拍，请等待邮件通知</p>
        <br />
        <a href="javascript:void(0)"><div class="sbmtcomp"></div></a>
    </div>
    <div class="close"><a href="javascript:void(0)"><div class="closebuyalert"></div></a></div>
</div>
    
    
    <script type="text/javascript" src="__JS__/function/bidding.js"></script>
    <script type="text/javascript" src="__JS__/pagejs/index.js"></script>
    <script type="text/javascript" src="__JS__/pagejs/head.js"></script>
    <script type="text/javascript" src="__JS__/pagejs/log_reg.js"></script>
    <script type="text/javascript" src="__JS__/function/sidebar.js"></script>
    <script type="text/javascript" src="__JS__/function/searchTrade.js" ></script>
    <script type="text/javascript" src="__JS__/function/bapTrade.js"></script>
    <script src="__BS__/js/bootstrap.min.js"></script>
    <!--[if lte IE 6]>
    <!-- bsie js 补丁只在IE6中才执行 -->
    <script type="text/javascript" src="__BS__/iehack/bootstrap-ie.js"></script>
    <![endif]-->
    <script>
        yj_search.init();
    </script>

</body>

</html>