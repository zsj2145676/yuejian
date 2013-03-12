<?PHP  
// 
function submit_post($host, $url, $argv){
	//构造要post的字符串 
	$flag = 0;
	$params = '';
	foreach ($argv as $key=>$value) { 
		 $params.='&'.$key."="; $params.= urlencode($value); 
	} 
	$length = strlen($params); 
	// var_dump($params);
	//创建socket连接 
	$fp = fsockopen($host,80,$errno,$errstr,10) or exit($errstr."--->".$errno); 
	//构造post请求的头 
	$header = "POST $url HTTP/1.1\r\n"; 
	$header .= "Host:$host\r\n"; 
	// $header .= "Referer:/mobile/sendpost.php\r\n"; 
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
	$header .= "Content-Length: ".$length."\r\n"; 
	$header .= "Connection: Close\r\n\r\n"; 
	//添加post的字符串 
	$header .= $params."\r\n"; 
	//发送post的数据 
	fputs($fp,$header); 
	$inheader = 1; 
	while (!feof($fp)) { 
		$line = fgets($fp,1024); //去除请求包的头只显示页面的返回数据 
		// var_dump($line);
		if ($inheader && ($line == "\n" || $line == "\r\n")) { 
			 $inheader = 0; 
		} 
		if ($inheader == 0) { 
			// echo $line; 
		} 
	} 
	if($line==1)
	{
	}else
	{
	}
	fclose($fp); 
	return $line;
}
?>