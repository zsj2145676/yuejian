<?php
class AccountAction extends Action {
	
	/*! 检查用户名是否已存在
	* @param str $username
	* @return (不存在)0|(存在)1
	*/
	public function exist($username,$ajax=true)
	{
		$Login = M('login');
		$condition['username']=$username;
		$data = $Login->where($condition)->find();
		$ret = $data==null?0:1;
		if($ajax){
			$this->ajaxReturn($ret,'',1);
		}
		else{
			return $ret;
		}
	}
	
/*! 注册
	* @param str $username 用户名
	* @param str $password 用户密码
	* @param str $occupation 用户职业（取消）
	* @param str $cat 领域，逗号分隔id集
	* @return 成功则返回uid，失败返回false
	*/
    public function signup($username, $password, $cat, $ajax=true)
	{	
		$Login = M('login');
		$condition['username']=$username;
		$data = $Login->where($condition)->find();
		if($data){
			if($ajax){
				$this->ajaxReturn(null,'Username already exists',0);
			}
			else{
				return false;
			}
		}
		$Login->create();
		$Login->username = $username;
		$Login->password = md5($password);
		$Login->createtime = time();
		$ret = (bool)$Login->add();
		if(!$ret){
			if($ajax){
				$this->ajaxReturn(null,'System error',0);
			}
			else{
				return false;
			}
		}
		$data = $Login->where($condition)->find();
		$User = M('user');
		$User->create();
		$User->group = 2;
		$User->uid = $data['id'];
		$scat='';
		foreach($cat as $item){
			$scat= $scat.",".$item;
		}
		$User->cat = $scat;
		$User->add();
		if($ajax){
			$ajdata['uid'] = $data['id'];
			$this->ajaxReturn($ajdata,'JSON');
		}
		else{
			return $data['id'];
		}
    }
	
	/*! 登陆
	* @param str username 
	* @return 成功则返回$id, 否则返回0
	*/
	/*! 登陆
	* @param str username 
	* @return 成功则返回$id, 否则返回0
	*/
	public function login($username, $password,$ajax=true)
	{
		$succeed = False;
		$group = 0;
		$Login = M('login');
		$condition['username']=$username;
		$data = $Login->join('yue_user on yue_login.id=yue_user.uid')->field('yue_login.id,password,lastlogin,yue_user.group,yue_user.name')->where($condition)->find();
		if($data){
			$group = intval($data['group']);
			$pwdx = md5($password);
			if($data['password']==$pwdx and $group!=0){
				$id = $data['id'];
				$now=time();
				$firsttime = null==$data['lastlogin']?1:0;
				$data['lastlogin'] = $now;
				$Login->save($data);
				session(C('USER_AUTH_KEY'),"$id"); // 兼容之前
				$user['uid'] = $id;
				$user['group'] = $group;
				$user['lasttime'] =  $_SERVER['REQUEST_TIME'];
				$user['firsttime'] = $firsttime;
				$user['name'] = $data['name'];
				session(C('USER_INFO'),$user);
				$succeed = True;
			}
		}
		if($ajax){
			if(!$succeed){
				$group = 0;
			}
			$this->ajaxReturn($group,'',1);
		}
		else{
			return $succeed;
		}
	}
	
	public function firstLogin()
	{
		$ret = 0;
		$user = session(C('USER_INFO'));
		if($user!=null){
			$ret = $user['firsttime'];
			$user['firsttime'] = 0;
			session(C('USER_INFO'),$user);
		}
		$this->ajaxReturn($ret,'JSON');
	}
	
	/*! 验证邮箱
	* @return 成功返回1，失败返回0
	*/
	public function verifyemail($uid,$code)
	{
		$c_delta = 24*60*60;
		$ret = 0;
		// dump($uid);
		$Email = M('email');
		$cond['uid'] = $uid;
		$dbret = $Email->where($cond)->field('id,code,time,verified')->find();
		// dump($dbret);
		if($dbret and $dbret['verified']=='0'){
			$delta = time()-(int)( $dbret['time']);
			if($dbret['code']==$code and $delta<=$c_delta){
				$dbret['time'] = 0;
				$dbret['verified'] = 1;
				$ret = $Email->save($dbret)?1:0;
			}
		}
		$this->ajaxReturn($ret,'JSON');
	}
	
	function findby_phone($phone)
	{
		$ret = 0;
		// $User = M('user');
		// $cond['phone'] = $phone;
		// $cond['phone_verified'] = 1;
		// $dbret = $User->where($cond)->find();
		//>
		$Login = M('Login');
		$cond['username'] = $phone;
		$dbret = $Login->where($cond)->find();
		//<
		if($dbret){
			$code = random(6,1);
			$msg = "$code".', 为您在yuejian的新密码，请妥善保管。【yuejian网】';
			if(send_sms($phone,$msg)){
				$Login = M('login');
				$ldata['id'] = $dbret['id'];
				$ldata['password'] = md5($code);
				$Login->save($ldata);
				$ret = 1;
			}
		}
		return $ret;
	}
	
	function findby_email($email)
	{
		$ret = 0;
		// $Email = M('email');
		// $cond['email'] = $email;
		// $cond['verified']  = 1;
		// $dbret = $Email->where($cond)->field('id,uid')->find();
		//>
		$Login = M('Login');
		$cond['username'] = $email;
		$dbret = $Login->where($cond)->find();
		//<
		if($dbret){
			$econd['uid'] = $dbret['id'];
			$Email = M('email');
			$data = $Email->where($econd)->find();
			if($data == null){
				$edata['uid'] = $dbret['id'];
				$edata['address'] = $email;
				$edata['verified'] = 1;
				$ret = $Email->add($edata);
				$data = $Email->where($econd)->find();
			}
			$code =  random(32);
			$data['code'] = $code;
			$data['time'] = time();
			$data['pwd'] = 1;
			$uid = $data['uid'];
			if($Email->save($data)){
				$link = "http://localhost/yuejian/a.php?m=Account&a=pwdback&code=$code&uid=$uid";
				$subject = '取回登录密码【yuejian网安全中心 】';
				$body="尊敬的yuejian帐号网用户$name：<br>
				<br>您好！<br>
				<br>为了您的下一步操作，请点击以下链接确认更改。<br>
				<br><a href=$link>$link</a><br>
				<br>如果上面的链接无法点击，您也可以复制链接，粘贴到您浏览器的地址栏内，然后按“回车”键打开预设页面，完成相应功能。<br>
				<br>如果有其他问题，请联系我们：admin@yuejian.me 谢谢！<br>
				<br>此为系统消息，请勿回复<br>";
				$to = $email;
				$from = 'piaobush_public@163.com';
				$smtp = new smtp('piaobush_public@163.com','drmrdm163','smtp.163.com',25,true);
				$ret = $smtp->sendmail($to,$from,$subject,$body)?1:0;
			}
		}
		return $ret;
	}
	/*! 请求找回密码
	**/
	public function findpwd($username,$type)
	{
		$ret = 0;
		if($type=='phone'){
			$ret = $this->findby_phone($username);
		}
		else if($type=='mail'){
			$ret = $this->findby_email($username);
		}
		$this->ajaxReturn($ret,'JSON');
	}
	
	/*! 响应找回密码
	* @return 成功返回1，失败返回0，
	*/
	public function pwdback($code,$uid)
	{
		$c_delta = 24*60*60;
		$ret = 0;
		$Email = M('email');
		$cond['uid'] = $uid;
		$cond['pwd'] = 1;
		$dbret = $Email->where($cond)->field('id,uid,code,time,verified')->find();
		// dump($dbret);
		if($dbret){
			$delta = time()-(int)( $dbret['time']);
			// dump($delta);
			if($dbret['code']==$code and $delta<=$c_delta){
				$dbret['time'] = 0;
				$dbret['pwd'] = 0;
				$Email->save($dbret);
				session('lost',$uid);
				$ret = 1;
			}
		}
		// dump($ret);
		header('location:/yuejian/index.php?m=Index&a=extpage&reset=1');
		$this->ajaxReturn($ret);
	}
	
	/*! 设置新密码
	* 若oldpwd为null则为密码取回方式重设密码
	*/
	public function setpwd($newpwd,$oldpwd=null)
	{
		$ret = 0;
		$Login = M('login');
		if($oldpwd!=null){
			$uid = session(C('USER_AUTH_KEY'));
			$cond['id'] = $uid;
			$dbret = $Login->where($cond)->find();
			$md5pwd = md5($oldpwd);
			if($md5pwd==$dbret['password']){
				$cond['password'] = md5($newpwd);
				$Login->save($cond);
				$ret = 1;
			}
		}else{
			$uid = session('lost');
			if($uid!=null){
				$data['id'] = $uid;
				$data['password'] = md5($newpwd);
				$Login->save($data);
				session('lost',null);
				$ret = 1;
			}
		}
		$this->ajaxReturn($ret);
	}
	
	/*! 注销
	*/
	public function logout()
	{
		session('[destroy]');
		header('Location:./index.php');
	}
	
	
	public function test($username,$password)
	{
		$Login = M('login');
		$cond['username'] = $username;
		$data['password']=md5($password);
		$Login->where($cond)->save($data);
		dump(session('lost'));
	}
	
}
?>
