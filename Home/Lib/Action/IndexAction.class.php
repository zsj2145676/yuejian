<?php
class IndexAction extends Action {
    public function index(){
        import("A.Action.OAuthAction");
        $oAuth = new OAuthAction();
        $this->assign('weiboLoginUrl',$oAuth->buildWeiboConnectUrl());
        
        $user = session('user');
        $this->assign('uid',$user['uid']);
        $this->assign('group',$user['group']);
        if($user['uid']==null){
            $this->assign('navdiv',"<li><a href='#logindiv' id='openlogin' data-toggle='modal'>登陆</a></li><li>|</li><li><a id='openregister' href='#registerdiv' data-toggle='modal'>注册</a></li>");
        }  else {
            $this->assign('navdiv',"<li><a href='javascript:;' id='mypage'>个人主页</a>&nbsp;&nbsp;<a href='./a.php?m=Account&a=logout'><span></span>登出</a></li>");
        }
        $this->display();
    }
    
    public function extpage() {
        $this->assign('type',$this->_get("type"));
        $user = session('user');
        $this->assign('uid',$user['uid']);
        $this->assign('group',$user['group']);
        if($user['uid']==null){
            $this->assign('navdiv',"<li><a href=# id='openlogin'>登陆</a></li><li>|</li><li><a href=# id='openregister'>注册</a></li>");
        }  else {
            $this->assign('navdiv',"<li><a href='javascript:;' id='mypage'>个人主页</a>&nbsp;&nbsp;<a href='./a.php?m=Account&a=logout'><span></span>登出</a></li>");
        }
        $this->display();
    }
    
    public function detail() {
        $user = session('user');
        $this->assign('uid',$user['uid']);
        $this->assign('group',$user['group']);
        if($user['uid']==null){
            $this->assign('navdiv',"<li><a href=# id='openlogin'>登陆</a></li><li>|</li><li><a href=# id='openregister'>注册</a></li>");
        }  else {
            $this->assign('navdiv',"<li><a href='javascript:;' id='mypage'>个人主页</a>&nbsp;&nbsp;<a href='./a.php?m=Account&a=logout'><span></span>登出</a></li>");
        }
        $this->display();
    }
    
    public function customer() {
        $user = session('user');
        $this->assign('uid',$user['uid']);
        $this->assign('group',$user['group']);
        if($user['uid']==null){
            $this->assign('navdiv',"<li><a href=# id='openlogin'>登陆</a></li><li>|</li><li><a href=# id='openregister'>注册</a></li>");
        }  else {
            $this->assign('navdiv',"<li><a href='javascript:;' id='mypage'>个人主页</a>&nbsp;&nbsp;<a href='./a.php?m=Account&a=logout'><span></span>登出</a></li>");
        }
        $this->display();
    }
    
    public function sell() {
        $user = session('user');
        $this->assign('uid',$user['uid']);
        $this->assign('group',$user['group']);
        if($user['uid']==null){
            $this->assign('navdiv',"<li><a href=# id='openlogin'>登陆</a></li><li>|</li><li><a href=# id='openregister'>注册</a></li>");
        }  else {
            $this->assign('navdiv',"<li><a href='javascript:;' id='mypage'>个人主页</a>&nbsp;&nbsp;<a href='./a.php?m=Account&a=logout'><span></span>登出</a></li>");
        }
        $this->display();
    }
    
//    public function connectCallback() {
//        $o = session('oauth');
//        $this->assign('username',$o['name']);
//        
//        $this->display();
//    }
    
    public function weiboConnectCallback() {
	    include_once( $_SERVER['DOCUMENT_ROOT'].'/Third/OAuth/weibo/config.php' );
            include_once( $_SERVER['DOCUMENT_ROOT'].'/Third/OAuth/weibo/saetv2.ex.class.php' );
		$o = new SaeTOAuthV2(WB_AKEY, WB_SKEY);

		if (isset($_REQUEST['code'])) {
			$keys = array();
			$keys['code'] = $_REQUEST['code'];
			$keys['redirect_uri'] = WB_CALLBACK_URL;
			try {
				$token = $o->getAccessToken('code', $keys);
			} catch (OAuthException $e){
			}
		}

		if ($token){
			$_SESSION['token'] = $token;
			$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
			$uid_get = $c->get_uid();
			$uid = $uid_get['uid'];
			$user_message = $c->show_user_by_id( $uid);
			$_SESSION['oauth']['name'] = $user_message['name'];
			$_SESSION['oauth']['oauthid'] = $uid;
			$_SESSION['oauth']['server'] = 1;//1是微博 2 人人 3 QQ
		}
        $o = session('oauth');
        $this->assign('username',  implode(',', $uid_get));
        
        $this->display();
	}
    
}