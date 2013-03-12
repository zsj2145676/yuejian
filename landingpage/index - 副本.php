<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<?php
	session_start();
	$_SESSION['index']=1;
?>
<head>
    <meta charset="UTF-8">
    <title>约见</title>
    <link rel="stylesheet" type="text/css" href="style.css" charset="UTF-8">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js "></script>
</head>

<body>
	<div id="film">
		<img src="img/landingpage.jpg" />
	</div>
	<div id="inputdiv">
		<form name="targetform" action="../any.php?m=Landing&a=index" method="POST">
			<input id="email" name="email" type="text" value="输入邮箱等待通知..." />
			<a href="javascript:;" onclick="submitin();"><div>走你！</div></a>
		</form>
		<br/>
		<div id="alert" style="display:none;float:left;width:200px;margin-top:0px;">请输入正确的邮箱格式!</div>
	</div>
	<div id="about">
		<a href="landingdetail.php">关于&nbsp;yuejian.me</a>
	</div>
</body>
<script>
	$('#email').focus(function(){
		if($(this).val()=='输入邮箱等待通知...'){
			$(this).val('');
		}
	});
	$('#email').blur(function(){
		if($(this).val()==''){
			$(this).val("输入邮箱等待通知...");
		}
	});
	function submitin(){
		if($('#email').val()!=''){
			var pattern=/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
			if(!pattern.test($('#email').val())){
				$('#alert').show();
				return false;
			}
			document.targetform.submit();
		}
	}
</script>
</html>






