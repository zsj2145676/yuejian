<?PHP  
// 
function send_sms($phone,$msg){
$flag = 0; 
$content = iconv("UTF-8","gb2312",$msg);
$argv = array( 
         'sn'=>'SDK-BBX-010-15654', 
		 'pwd'=>'3@de5a@4', 
		 'mobile'=>$phone, 
                 'content'=>$content
		 ); 		 
//构造要post的字符串 
foreach ($argv as $key=>$value) { 
          if ($flag!=0) { 
                         $params .= "&"; 
                         $flag = 1; 
          } 
         $params.= $key."="; $params.= urlencode($value); 
         $flag = 1; 
          } 
         $length = strlen($params); 
                 //创建socket连接 
         $fp = fsockopen("sdk2.entinfo.cn",80,$errno,$errstr,10) or exit($errstr."--->".$errno); 
         //构造post请求的头 
         $header = "POST /z_send.aspx HTTP/1.1\r\n"; 
         $header .= "Host:sdk2.entinfo.cn\r\n"; 
         $header .= "Referer:/mobile/sendpost.php\r\n"; 
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