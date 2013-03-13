<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>约见</title>
		<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
		<style type="text/css">
		body{text-align: center;padding-top:100px;font-family: "SimHei"}
		h2{color: #D0C1BE;font-size: 20px;margin-top:50px;font-weight: normal;}
		#second{color: #EC7374;}
		a{text-decoration:none;color: #EC7374;}
		a:hover{text-decoration: underline;}
		</style>
		<script type="text/javascript">
			
			var i=1;
			function jump(){
				if(i!=4){
					var str = 4-i;
					document.getElementById('second').innerHTML = str.toString();	
					i++;			
				}
				else{
					window.location.href="index.php";
				}
			}
			setInterval('jump()',1000);
			setTimeout('javascript:window.location.href="index.php";',4000);
		</script>
	</head>
	<body onload="">
		<img src="../images/404.jpg">	
		<h2><span id="second">4</span>秒后返回<a href="index.php">首页<a></h2>
	</body>
</html>