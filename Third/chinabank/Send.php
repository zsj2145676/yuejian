<?php
include ('mkpost.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>暗拍支付</title>

<link href="css/index.css" rel="stylesheet" type="text/css">
</head>

<?php
/////////////////////////////////// thinkphp ////////////////////////////
$money = trim($_REQUEST['money']);
$tradeid = trim($_REQUEST['tradeid']);
if(isset($_REQUEST['description'])){
	$description = $_REQUEST['description'];
}
else{
	$description = '';
}

$argv = array( 
		 'uid'=>$_SESSION['uid'],
         'tradeid'=>$tradeid,
		 'money'=>$money, 
		 'description'=>$description,
		 ); 
$line = submit_post('localhost','/h.php?m=Trade&a=bid',$argv);
$bidid = $line;
if($bidid!=''){
	echo '<body onLoad="javascript:document.E_FORM.submit();">';
}
else{
	echo '暗拍错误，非法暗拍操作';
}
/////////////////////////////////// chinabank ///////////////////////////
	$v_mid = '22616519';								 // 商户号，这里为测试商户号1001，替换为自己的商户号(老版商户号为4位或5位,新版为8位)即可
	$v_url = 'http://218.245.3.203/yuejian13-r/any.php?m=Pay&a=callback';	// 请填写返回url,地址应为绝对路径,带有http协议
	$key   = 'guangfeinanqunjerry';					    // 如果您还没有设置MD5密钥请登陆我们为您提供商户后台，地址：https://merchant3.chinabank.com.cn/

	$v_oid = $bidid;
	$v_amount = $money;                  //支付金额
    $v_moneytype = "CNY";                                            //币种

	$text = $v_amount.$v_moneytype.$v_oid.$v_mid.$v_url.$key;        //md5加密拼凑串,注意顺序不能变
    $v_md5info = strtoupper(md5($text));                             //md5函数加密并转化成大写字母

	if(isset($_SERVER['HTTP_REFERER'])){
		$remark1 = $_SERVER['HTTP_REFERER'];
	}
	else{
		$remark1 = '/';
	}
	
	$v_rcvname   = ''; // $_SESSION['uid'];// 收货人
	$v_rcvaddr   = '';// 收货地址
	$v_rcvtel    = '';// 收货人电话
	$v_rcvpost   = '';// 收货人邮编
	$v_rcvemail  = '';// 收货人邮件
	$v_rcvmobile = '';// 收货人手机号

	$v_ordername = '';	// 订货人姓名
	$v_orderaddr = '';	// 订货人地址
	$v_ordertel   = '';	// 订货人电话
	$v_orderpost  = '' ;	// 订货人邮编
	$v_orderemail  = '' ;	// 订货人邮件
	$v_ordermobile ='' ;	// 订货人手机号 
?>

<!--以下信息为标准的 HTML 格式 + ASP 语言 拼凑而成的 网银在线 支付接口标准演示页面 无需修改-->

<form method="post" name="E_FORM" action="https://Pay3.chinabank.com.cn/PayGate">
	<input type="hidden" name="v_mid"         value="<?php echo $v_mid;?>">
	<input type="hidden" name="v_oid"         value="<?php echo $v_oid;?>">
	<input type="hidden" name="v_amount"      value="<?php echo $v_amount;?>">
	<input type="hidden" name="v_moneytype"   value="<?php echo $v_moneytype;?>">
	<input type="hidden" name="v_url"         value="<?php echo $v_url;?>">
	<input type="hidden" name="v_md5info"     value="<?php echo $v_md5info;?>">
 
 <!--以下几项项为网上支付完成后，随支付反馈信息一同传给信息接收页 -->	
	
	<input type="hidden" name="remark1"       value="<?php echo $remark1;?>">
	<input type="hidden" name="remark2"       value="<?php echo $remark2;?>">



<!--以下几项只是用来记录客户信息，可以不用，不影响支付 -->
	<input type="hidden" name="v_rcvname"      value="<?php echo $v_rcvname;?>">
	<input type="hidden" name="v_rcvtel"       value="<?php echo $v_rcvtel;?>">
	<input type="hidden" name="v_rcvpost"      value="<?php echo $v_rcvpost;?>">
	<input type="hidden" name="v_rcvaddr"      value="<?php echo $v_rcvaddr;?>">
	<input type="hidden" name="v_rcvemail"     value="<?php echo $v_rcvemail;?>">
	<input type="hidden" name="v_rcvmobile"    value="<?php echo $v_rcvmobile;?>">

	<input type="hidden" name="v_ordername"    value="<?php echo $v_ordername;?>">
	<input type="hidden" name="v_ordertel"     value="<?php echo $v_ordertel;?>">
	<input type="hidden" name="v_orderpost"    value="<?php echo $v_orderpost;?>">
	<input type="hidden" name="v_orderaddr"    value="<?php echo $v_orderaddr;?>">
	<input type="hidden" name="v_ordermobile"  value="<?php echo $v_ordermobile;?>">
	<input type="hidden" name="v_orderemail"   value="<?php echo $v_orderemail;?>">

</form>
</body>
</html>
