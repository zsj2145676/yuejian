<?php
class OAuthAction extends Action {
	
	/*! 第三方登录结果检测
	*/
	public function oauth()
	{
		import('@.Action.Account');
		$succeed = False;
		if(session('?oauth')){
			$oauth = session('oauth');
			$server = $oauth['server'];
			$oauthid = $oauth['oauthid'];
			$OAuth = M('oauth');
			$condition['server'] = $server;
			$condition['oauthid'] = $oauthid;
			$data = $OAuth->where($condition)->find();
			if($data==null){// 首次第三方登录
				$now = time();
				$rand = rand();
				$name = $oauth['name'];
				$username = "$name$now$rand";
				$password = "$now_$rand";
				$cat = '';
				$account = new $AccountAction();
				$uid = $account->signup($username,$password,$cat,false);
				$condition['uid'] = $uid;
				$OAuth->add($condition);
			}
			else{
				$uid = $data['uid'];
			}
			// 
			$Login = M('login');
			$lc['id'] = $uid;
			$data = $Login->where($lc)->field('group,lastlogin')->find();
			if($data){
				$id = $data['id'];
				$group = intval($data['group'])
				$now=time();
				$firsttime = null==$data['lastlogin'];
				$data['lastlogin'] = $now;
				$Login->save($data);
				session(C('USER_AUTH_KEY'),"$id"); // 兼容之前
				$user['uid'] = $id;
				$user['group'] = $group;
				$user['lasttime'] =  $_SERVER['REQUEST_TIME'];
				$user['firsttime'] = $firsttime;
				session(C('USER_INFO'),$user);
				$succeed = True;
			}
		}
		if(!$succeed){
		    $group = 0;
		}
		$this->ajaxReturn($group,'',1);
	}
	
	public function sina_callback()
	{
		load ('@.config.php');
		include_once ('saetv2.ex.class.php');
		$o = new SaeTOAuthV2(WB_AKEY, WB_SKEY);

		if (isset($_REQUEST['code']))
		{
			$keys = array();
			$keys['code'] = $_REQUEST['code'];
			$keys['redirect_uri'] = WB_CALLBACK_URL;
			try
			{
				$token = $o->getAccessToken('code', $keys);
			}
			catch (OAuthException $e)
			{
			}
		}

		if ($token){
			$_SESSION['oauth']['token'] = $token;
			$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
			$uid_get = $c->get_uid();
			$uid = $uid_get['uid'];
			$user_message = $c->show_user_by_id( $uid);
			$_SESSION['oauth']['name'] = $user_message['name'];
			$_SESSION['oauth']['oauthid'] = $uid
			$_SESSION['oauth']['server'] = 'weibo'
		}
	}
	
	public function sina()
	{
		
	}
	
	public function renren()
	{
	}
	
	public function douban()
	{
	
	}
	
	public function qq()
	{
	}
	
	public function test1($oid)
	{
		$oauth['server'] = 'sina';
		$oauth['oauthid'] = $oid;
		$oauth['name'] = 'helloo';
		session('oauth',$oauth);
		dump($oauth);
	}
}
?>
