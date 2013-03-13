<?php

function avatar_url($name,$type='large')
{
	$ret = '';
	if($name!=''){
		$prefix = $type.'_';
		$ret = 	AVATAR_PATH.$prefix.$name;
	}
    else{
		if($type=='large'){
			$ret = '/Public/images/head.png';
		}
		else if($type=='normal'){
			$ret = '/Public/images/yuenormal.png';
		}
		else{
			$ret = '/Public/images/yuesmall.png';
		}
	}
	return $ret;
}

/*
 * $length:随机数字符串的长度
 * $type:产生随机数的类型
 * 
 */
function random($length, $type = 0) {
	$chars = !$type ? "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz" : "0123456789ABCDEF";
	$max = strlen($chars) - 1;
	mt_srand((double)microtime() * 1000000);
	for($i = 0; $i < $length; $i++) {
		$string .= $chars[mt_rand(0, $max)];
	}
	return $string;
}
	
function format_date_cn($timestamp){
	return date("Y年n月j日", $timestamp);
}

function format_date($timestamp){
	return date("Y/m/d", $timestamp);
}

function format_time($timestamp,$del = '-'){
	$sformat = "Y$del"."m"."$del"."d H:i:s";
	return date($sformat, $timestamp);
}

function format_time_min($timestamp,$del = '-')
{
	$sformat = "Y$del"."m"."$del"."d H:i";
	return date($sformat, $timestamp);
}

function format_span($seconds){
	$c_sec_per_min = 60;
	$c_sec_per_hour = $c_sec_per_min*60;
	$c_sec_per_day = $c_sec_per_hour*24;
	
	$day = (int)($seconds/$$c_sec_per_day);
	$seconds = $seconds%$c_sec_per_day;
	
	$hour = (int)($seconds/$c_sec_per_hour);
	$seconds = $seconds%$c_sec_per_hour;
	
	$min = (int)($seconds/$c_sec_per_min);
	$ret = "$day"."/"."$hour"."/"."$min";
	return $ret;
}

function current_time()
{
	return  date("Y-m-d H:i:s",time());	
}

function current_date() {
	return date("Y-m-d",time());
}

function current_date_cn(){
	$output = date('Y')."年".date('n')."月".date('j')."日";
	$week = array('星期天', '星期一', '星期二','星期三','星期四','星期五','星期六');
	$output .= ' '.$week[date('w')];
	return $output;
}

function utf8strlen($str){
	return mb_strlen($str, 'utf-8');
}

/**
*截取UTF8字符 
*/
function msubstr($str, $start, $length=NULL) 
{ 
	if (function_exists("mb_substr")) 
	{ 
		return mb_substr($str, $start, $length, "UTF-8"); 
	} 
	preg_match_all("/./u", $str, $ar); 
	
	if(func_num_args() >= 3) { 
		$end = func_get_arg(2); 
		return join("",array_slice($ar[0],$start,$end)); 
	} else { 
		return join("",array_slice($ar[0],$start)); 
	} 
} 

function _mbsubstr($str,$start=0,$len,$other=true) { 
	$j=0;
	$strlen = $len*2;
    for($i=0;$i<$strlen;$i++) 
      if(ord(substr($str,$i,1))>0xa0) $j++; 
    if($j%2!=0) $strlen++; 
    $rstr=substr($str,0,$strlen); 
    if (strlen($str)>$strlen && $other) {$rstr = $rstr;} 
    return $rstr; 
}




/*
Utf-8、gb2312都支持的汉字截取函数
cut_str(字符串, 截取长度, 开始长度, 编码);
编码默认为 utf-8
开始长度默认为 0
*/ 

function cut_str($string, $sublen, $start = 0, $code = 'UTF-8')
{
    if($code == 'UTF-8')
    {
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);
 
        //if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";
		if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen));
        return join('', array_slice($t_string[0], $start, $sublen));
    }
    else
    {
        $start = $start*2;
        $sublen = $sublen*2;
        $strlen = strlen($string);
        $tmpstr = '';
 
        for($i=0; $i< $strlen; $i++)
        {
            if($i>=$start && $i< ($start+$sublen))
            {
                if(ord(substr($string, $i, 1))>129)
                {
                    $tmpstr.= substr($string, $i, 2);
                }
                else
                {
                    $tmpstr.= substr($string, $i, 1);
                }
            }
            if(ord(substr($string, $i, 1))>129) $i++;
        }
        //if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";
        return $tmpstr;
    }
} 

/**************************************************************/
/**************************************************************/
/**************************************************************/




// *** Insert an HTML comment ***/
function comment ($comment)
{
	echo "\n<!-- " . trim($comment) . "-->\n";
}

//*** Returns the .EXAMPLE form of a file's extension ***/
function get_extension($filename)
{
	$file_text = basename($filename);
	return (strrchr($file_text, "."));
}

//*** Return the image info **/
function getImageInfo($img) { //$img???·  
	$img_info = getimagesize($img);  
	switch ($img_info[2]) {  
		case 1:  
			$imgtype = "GIF";  
			break;  
		case 2:  
			$imgtype = "JPG";  
			break;  
		case 3:  
			$imgtype = "PNG";  
			break;  
	}  
	$img_type = $imgtype."?";  
	$img_size = ceil(filesize($img)/1000)."k"; //??С  

	$new_img_info = array (  
		"width"=>$img_info[0],  
		"height"=>$img_info[1],  
		"type"=>$img_type, 
		"size"=>$img_size  
	) ; 
	return $new_img_info;  
}

function my_rand() 
{
	mt_srand((double)microtime()*1000000 ); 
	$adid = mt_rand(0, 9999999);
	$i = 1000000;
	$j = 0;
	$zero_str = "";
	while ( $i > 0 && (int)($adid / $i) == 0 ) {
		$i /= 10;
		++$j;
	}
	for ($i = 0; $i < $j; ++$i) {
		$zero_str .= "0";
	}
	$adid = $zero_str . $adid;
	return $adid;
}
function alert_msg($msg){
	echo "<script type=\"text/javascript\">window.alert(\"$msg\")</script>";
}

function page_redirect($pagename)
{
	echo '<script type="text/javascript">window.location.href="'.$pagename.'"</script>';
}
function history_go($num)
{
	echo '<script type="text/javascript">history.go('.$num.')</script>';
}

function conv($text)
{
	return iconv("GB2312","UTF-8",$text);
}

function rconv($text)
{
	return iconv("UTF-8", "GB2312", $text);
}

//创建缩略图,以相同的扩展名生成缩略图       
//$src_file : 来源图像路径 , $thumb_file : 缩略图路径
//$t_width : 缩略图最大宽度, $t_height : 缩略图最大高度
function pic_resize ($src_file, $thumb_file, $t_width, $t_height) {       
   //$t_width  = $this->thumb_width;       
   //$t_height = $this->thumb_height;  
          
   if (!file_exists($src_file)) return false;       
       
   $src_info = getImageSize($src_file);       
       
   //如果来源图像小于或等于缩略图则拷贝源图像作为缩略图       
   if ($src_info[0] <= $t_width && $src_info[1] <= $t_height) {       
       if (!copy($src_file,$thumb_file)) {       
           return false;       
       }       
       return true;       
   }       
      
  //按比例计算缩略图大小       
   if ($src_info[0] - $t_width > $src_info[1] - $t_height) {       
       $t_height = ($t_width / $src_info[0]) * $src_info[1];       
   } else {       
       $t_width = ($t_height / $src_info[1]) * $src_info[0];       
   }       
       
  //取得文件扩展名 
  //$fileext = strtolower(substr(strrchr($src_file,'.'),1,10));
     
	$size=getimagesize($src_file); 
	 
	switch ($size["mime"]) {       
       case "image/jpeg" :
           $src_img = imagecreatefromjpeg($src_file);
		   break;       
       case "image/png" :       
           $src_img = imagecreatefrompng($src_file);
		   imagesavealpha($src_img,true);//这里很重要;
		   break;       
       case "image/gif" :       
           $src_img = imagecreatefromgif($src_file);
		   break;
		default:
			$src_img = false;
			break;
   }       
       
   //创建一个真彩色的缩略图像       
   $thumb_img = @ImageCreateTrueColor($t_width,$t_height);
   
   imagealphablending($thumb_img,false);//这里很重要,意思是不合并颜色,直接用$img图像颜色替换,包括透明色;
   imagesavealpha($thumb_img,true);//这里很重要,意思是不要丢了$thumb图像的透明色;
       
   //ImageCopyResampled 函数拷贝的图像平滑度较好，优先考虑       
   if (function_exists('imagecopyresampled')) {       
      @ImageCopyResampled($thumb_img,$src_img,0,0,0,0,$t_width,$t_height,$src_info[0],$src_info[1]);       
   } else {       
      @ImageCopyResized($thumb_img,$src_img,0,0,0,0,$t_width,$t_height,$src_info[0],$src_info[1]);       
   }       
       
   //生成缩略图       
   switch ($size["mime"]) {       
      case "image/jpeg" :       
         imagejpeg($thumb_img,$thumb_file); break;       
      case "image/gif" :       
         imagegif($thumb_img,$thumb_file); break;       
      case "image/png" :  
         imagepng($thumb_img,$thumb_file); break;       
   }       
       
   //销毁临时图像       
	@ImageDestroy($src_img);       
    @ImageDestroy($thumb_img);       
       
    return true;       
}


function print_var($var){
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
}



function comfirm_msg($msg, $url1, $url2){
	echo "<script type=\"text/javascript\">";
	echo "if(confirm('$msg'))
    {
        document.location.href = '$url1';
    }else{
		 document.location.href = '$url2';
	}";
	echo "</script>";
}

function br2nl($text)
{
	$text = str_replace("<br />","",$text);
	/* Remove HTML 4.01 linebreak tags. */
	$text = str_replace("<br>","",$text);
	/* Return the result. */
	return $text;
}

function specialcharstohtml($str) {
	if($str != '') {
		$aKey	= array("&amp;","&lt;","&gt;", "&quot;", "&#39");
		$aVal	= array("&", "<", ">", "\"", "'");

		$str = str_replace($aKey,$aVal,$str);
		return $str;
	}
	else
		return false;
}

/*
按照图片的比例自动调节图片
$srcFile 要显示的图片的路径及图片名称 如：'data/business/photo/example.gif';
$toW 要显示的图片最大宽度
$toH 要显示的图片最大高度
*/
function autoAdaptImageSize($srcFile, $toW, $toH){
	$data = getimagesize($srcFile);
    switch ($data[2]){
		case 1:
        	$im = @imagecreatefromgif($srcFile);
            break;
        case 2:
            $im = @imagecreatefromjpeg($srcFile);    
            break;
        case 3:
            $im = @imagecreatefrompng($srcFile);    
            break;
    }
    $srcW=imagesx($im);
    $srcH=imagesy($im);
    //$toW = 170;
    //$toH = 170;
    $toWH=$toW/$toH;
    $srcWH=$srcW/$srcH;
                                              
    if($toWH<=$srcWH){
    	$ftoW=$toW;
        $ftoH=$ftoW*($srcH/$srcW);
    }else{
        $ftoH=$toH;
        $ftoW=$ftoH*($srcW/$srcH);
    }
	
	$autoArr = array();
    $autoArr['w'] = round($ftoW);
    $autoArr['h'] = round($ftoH);
	return $autoArr;
}
function editor_box($name, $value=''){
	include("fckeditor/fckeditor.php") ;
	//$sBasePath = "/manager/fckeditor/"; //文本编辑器的路径
	//动态计算编辑器路径
	$arrPath = explode('/',$_SERVER['PHP_SELF'],3);
	if( $arrPath[1] == 'manager' ){
		$base_path = '';
	}else{
		$base_path = $arrPath[1].'/';
	} 
	$sBasePath = "/{$base_path}manager/fckeditor/";
	
	$oFCKeditor = new FCKeditor($name);
	$oFCKeditor->BasePath	= $sBasePath ;
	$oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/silver/' ;
	$oFCKeditor->Height = "500" ;	
	$oFCKeditor->Value = $value ;
	$oFCKeditor->Create() ;
}
function editor_box2($name, $value='', $js_config=''){
	include("fckeditor/fckeditor.php") ;
	//$sBasePath = "/manager/fckeditor/"; //文本编辑器的路径
	//动态计算编辑器路径
	$arrPath = explode('/',$_SERVER['PHP_SELF'],3);
	if( $arrPath[1] == 'manager' ){
		$base_path = '';
	}else{
		$base_path = $arrPath[1].'/';
	} 
	$sBasePath = "/{$base_path}manager/fckeditor/";
	
	$oFCKeditor = new FCKeditor($name);
	$oFCKeditor->BasePath	= $sBasePath ;
	$oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/silver/' ;
	//$oFCKeditor->Width = "400" ;
	$oFCKeditor->Height = "160" ;
	$oFCKeditor->Value = $value ;
	if (!empty($js_config)) {
		$oFCKeditor->ToolbarSet = $js_config ;
	}
	$oFCKeditor->Create() ;
}


function get_ip(){
   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
           $ip = getenv("HTTP_CLIENT_IP");
       else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
           $ip = getenv("HTTP_X_FORWARDED_FOR");
       else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
           $ip = getenv("REMOTE_ADDR");
       else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
           $ip = $_SERVER['REMOTE_ADDR'];
       else
           $ip = "unknown";
   return($ip);
}

function validateMail($mail) {
  if($mail !== "") {
    if(ereg("^[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[@]{1}[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[.]{1}[A-Za-z]{2,5}$", $mail)) {
      return true;
    } else {
      return false;
    }
  } else {
    return false;
  }
} 

function check_input($value)
{
	// 去除斜杠
	if (get_magic_quotes_gpc()) {
	$value = stripslashes($value);
	}
	// 如果不是数字则转义 SQL 语句中使用的字符串中的特殊字符
	if (!is_numeric($value)) {
		$value = mysql_real_escape_string($value);
	}
	return $value;
}

function getCode ($length = 32, $mode = 0)
{
    switch ($mode) {
    	case '1':
			$str = '1234567890';
			break;
		case '2':
			$str = 'abcdefghijklmnopqrstuvwxyz';
			break;
		case '3':
			$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			break;
    	default:
			$str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			break;
    }

    $result = '';
    $l = strlen($str)-1;
    $num=0;

    for ($i = 0;$i < $length;$i ++) {
        $num = rand(0, $l);
        $a=$str[$num];
        $result =$result.$a;
    }
	return $result;
}

 function quescrypt($questionid, $answer) {
         return $questionid > 0 && $answer != '' ? substr(md5($answer.md5($questionid)), 16, 8) : ''; }
		 
function formhash() {
		return substr(md5(substr(time(), 0, -4).UC_KEY), 16);
	}
	
/**
 * 序列化存储 
 * 
 *
 * @param string $filename  
 * @param string $var
 * @param string $dir
 * 
 * @return null
 * @author jianzhi
 */
function SerializeFile($filename,$var, $dir = NULL){
	if($dir == NULL)
		//$dir = ROOT_PATH."temp".DS."serialize".DS;
		$dir = '';
	$fp = @fopen($dir.$filename,"w+");
	if($fp){
	   if(flock($fp, LOCK_EX)) fwrite($fp,serialize($var));
	   fclose($fp);
	}
}

/**
 * 读取
 * 
 * @param string $filename  
 * @param string $dir  
 * 
 * @return string
 * @author jianzhi
 */
function UnSerializeFile($filename, $dir = NULL){
	if($dir == NULL)
    	//$dir = ROOT_PATH."temp".DS."serialize".DS;
		$dir = '';
    $fp = @fopen($dir.$filename,"r");
	if($fp){
		$content='';
	   while(!feof($fp)) $content .= fread($fp,128);
	   fclose($fp);
	   if($content) return unserialize($content);
	}
}

// 定义加密函数 $txt 为明文，$key 为密钥。
function passport_encrypt($txt, $key)
{
	$encrypt_key = md5(rand(0, 32000));	
	$ctr = 0;
	$tmp = '';
	for ($i = 0; $i < strlen($txt); $i++) {
		$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
		$tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
	}
	return base64_encode(passport_key($tmp, $key));
}

// 定义解密函数
function passport_decrypt($txt, $key)
{
	$txt = passport_key(base64_decode($txt), $key);
	$tmp = '';
	for ($i = 0; $i < strlen($txt); $i++) {
		$md5 = $txt[$i];
		$tmp .= $txt[++$i] ^ $md5;
	}
	return $tmp;
}

function passport_key($txt, $encrypt_key)
{
	$encrypt_key = md5($encrypt_key);
	$ctr = 0;
	$tmp = '';
	for ($i = 0; $i < strlen($txt); $i++) {
		$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
		$tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
	}
	return $tmp;
}
/*
$txt = "01234567890123456789";
$txt = "abcdefghijklmnopqrst";
$key = "test0216616";
//$encrypt = "";
$encrypt = passport_encrypt($txt, $key);
$decrypt = passport_decrypt($encrypt, $key);

echo "1:".$txt."<br />";
echo "2:".$encrypt."<br />";
echo "3:".$decrypt."<br />";

echo "|";*/

function pwd_md5($str,$salt='admin*_'){
	
	return 	md5($salt.md5($str.$salt.$salt));
}

function url_current($str){
	$style='';
	if(strstr($_SERVER['SCRIPT_NAME'],$str)){
		$style=' class="current"';
		
	}
	return $style;
}


function checkmail($user_email){   //验证电子邮件地址
	if(preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/",$user_email))
		return true;
	else
		return false;
}
//action动作成功控制函数
function action_return($state=1,$retrun_mess="",$activeUrl=""){
		if($state==2){echo $retrun_mess;exit;}
	  Global $acttarget;
	  echo "<script language='javascript'>";
	  if(trim($retrun_mess)!=''){
	  	 echo "alert('".$retrun_mess."');";
	  }
	  $setUrl='';
	  if($activeUrl!=''){
	    $setUrl=$activeUrl;
	  }else{
	  	$setUrl=$acttarget[1];
	  }
		if($setUrl=='-1'){
			echo "history.go(-1);";
		}else if($setUrl=='0'){
			echo "window.close();";
		}else{
			echo "location.href='".$setUrl."';";
		}
			echo "</script>";exit();
}

function checkFilter($str,$mode=TRUE){
		if($mode) return htmlspecialchars($str,ENT_QUOTES);
		else {
			$str = trim($str);
			return htmlspecialchars($str,ENT_QUOTES);
		}
}

?>