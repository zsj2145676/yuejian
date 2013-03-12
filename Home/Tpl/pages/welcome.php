<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
    	<meta http-quiv="Content-Type" charset="utf-8" />
        <title>在这里，约见你</title>
    	<link rel="stylesheet" type="text/css" href="../styles/welcome.css" media="screen"/>
    	<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
        <script type="text/javascript" src="../scripts/lib/jquery-1.9.1.min.js"></script>
        <script src="../scripts/function/base.js" type="text/javascript"></script>
    </head>
	<body>
		<div id="bg">
        <div id="main" class="bacimg">
        	<div id="container">
        		<div id="imagediv">
        			<img src="../images/6.jpg" />
        		</div>
        		<div id="wel_code">
	        		<div class="inputarea bacimg" >
	        			<input type="text" id="code" class="input" placeholder="请在此输入验证码" autocomplete="off"/>
	        			<a href="javascript:;" style="float: right;margin-right: 78px;">
	        				<div class="subbtn bacimg"><p>GO!</p></div>
	        			</a>
	        		</div>
	        		<div class="alert"><p></p></div>
        		</div>
        		<div id="welcome">
        			<p><span>郎咸平</span>&nbsp;先生</p>
        			<p>&nbsp;欢迎您入驻&nbsp;约见.me</p>
                    <div class="inputarea bacimg" id="username">
                        <input type="text" id="usernamein" class="input" placeholder="请设定登录用户名（手机/邮箱）" autocomplete="off"/>
                        <div class="alerm bacimg" id="alerm_0" title="格式错误"></div>   
                    </div>
        			<a href="javascript:;">
        				<div class="btn" id="conti"></div>
        			</a>
                    <p class="wel_alert"></p>
        		</div>
        		<div id="passworddiv">
        			<div class="inputarea bacimg" id="pass">
        				<input type="password" id="password" class="input" placeholder="请设定登录密码" autocomplete="off"/>
        				<div class="alerm bacimg" id="alerm_1" title="不符合密码要求"></div>   
        			</div>
        			<div class="inputarea bacimg" id="sepass" >
        				<input type="password" id="sepassword" class="input" placeholder="请再次输入密码" autocomplete="off"/>
        				<div class="alerm bacimg" id="alerm_2" title="两次输入不一致"></div>
        			</div>
                    <p class="wel_alert">请输入手机号码或邮箱作为用户名</p>
        			<a href="javascript:;" >
        				<div class="btn comp"></div>
        			</a>
                    <p class="wel_alert" style="margin-top: 145px;font-size:1.6em;"></p>
        		</div>
        	</div>
        </div>
        </div>
    </body>
    <script src="../scripts/function/welcome.js" type="text/javascript"></script>
</html>













