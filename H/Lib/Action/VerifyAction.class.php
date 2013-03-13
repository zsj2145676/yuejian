<?php
// 请求由status返回状态
// 查询由data返回
class VerifyAction extends Action {

	public function send($phone,$code)
	{
		$msg = "$code".', 为您在yuejian的验证码，请您在10分钟内完成提交。如非本人操作，请忽略。【yuejian网】';
		//$msg = "'想约你看电影'为用户0123de向您发送的短信请您在10分钟内完成回复。回复N不再受此人打扰。【yuejian网】";
		//dump($msg);
		return send_sms($phone,$msg);
	}
	
	/*! 生成并发送短信验证码
	*
	*/
	public function smscode($phone)
	{
		$ret = 0;
		$code = random(4,1);
		if($this->send($phone,$code)){
			$veri['code'] = $code;
			$veri['time'] = time();
			$veri['phone'] = $phone;
			session('smsverfiy',$veri);
			$ret = 1;
		}
		$this->ajaxReturn($ret,'json');
	}
	
	public function checkphone()
	{
		$ret = 0;
		$uid = session(C('USER_AUTH_KEY'));
		$User = M('user');
		$cond['uid'] = $uid;
		$data = $User->where($cond)->field('phone_verified')->find();
		if($data){
			$ret = (int)($data['phone_verified']);
		}
		$this->ajaxReturn($ret,'json');
	}
	/*! 检测验证码
	* 
	*/
	public function checksms($code)
	{
		$ret = 0;
		$c_delta = 10*60;
		if(session('?smsverfiy')){
			$veri = session('smsverfiy');
			if(strcasecmp($veri['code'],$code)==0){
				$time = $veri['time'];
				$delta = $time - time();
				$ret = $delta<=$c_delta?1:0;
				
				$uid = session(C('USER_AUTH_KEY'));
				$User = M('user');
				$cond['uid'] = $uid;
				$data['phone'] = $veri['phone'];
				$data['phone_verified'] = 1;
				$User->where($cond)->save($data);
				$ret = 1;
				session('smsverfiy',null);
				// 入库
			}
		}
		$this->ajaxReturn($ret,'JSON');
	}

	/*! 生成并发送认证链接，有效期24小时
	* @return 成功1，失败0（尚未设置邮箱）
	*/
	public function emailcode()
	{
		$ret = 0;
		$uid = session(C('USER_AUTH_KEY'));
		$suser = session('user');
		$name = $suser['name'];
		if($uid){
			$Email = M('email');
			$cond['uid'] = $uid;
			$cond['verified'] = 0;
			$dbret = $Email->where($cond)->field('id,address')->find();
			if($dbret){
				$data['id'] = $dbret['id'];
				$code =  random(32);
				$data['code'] = $code;
				$data['time'] = time();
				if($Email->save($data)){
					$link = "http://localhost/a.php?m=Account&a=verifyemail&uid=$uid&code=$code";
					$subject = '验证登录邮箱【yuejian网安全中心 】';
					$body="尊敬的yuejian帐号网用户$name：<br>
					<br>您好！<br>
					<br>为了您的下一步操作，需要验证您的登录邮箱，请点击以下链接确认更改。<br>
					<br><a href=$link>$link</a><br>
					<br>如果上面的链接无法点击，您也可以复制链接，粘贴到您浏览器的地址栏内，然后按“回车”键打开预设页面，完成相应功能。<br>
					<br>如果有其他问题，请联系我们：admin@yuejian.me 谢谢！<br>
					<br>此为系统消息，请勿回复<br>";
					$to = $dbret['address'];
					$from = 'piaobush_public@163.com';
					$smtp = new smtp('piaobush_public@163.com','drmrdm163','smtp.163.com',25,true);
					$ret = $smtp->sendmail($to,$from,$subject,$body)?1:0;
				}
			}
		}
		$this->ajaxReturn($ret,'JSON');
	}
	
	public function test()
	{
		dump(session('?id'));
		dump(session('smsverfiy'));
	}
}
?>