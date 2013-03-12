<?php
class InvitationAction extends Action {
	
	/*! 查询邀请码所对应用户信息
	* @param str $code
	* @return info|null
	*/
	public function check($code)
	{
		$ret = null;
		$Invitation = M('invitation');
		$condition['code']=$code;
		$data = $Invitation->where($condition)->find();
		if($data!=null){
			$ret['used'] = (int)($data['used']);
			$ret['uid'] = $data['uid'];
			if($ret['uid']!=null){
				$User = M('user');
				$ucond['uid'] = $ret['uid'];
				$data = $User->where($ucond)
						->field('name,avatar')->find();
				$ret['name'] = $data['name'];
				$ret['avatar'] = $data['avatar'];
			}
		}
		$this->ajaxReturn($ret,'JSON');
	}
	
	/*!
	* 成功返回1，邀请码不可用返回0，用户名已存在（对于买家）返回2
	*/
	public function bind($username, $password, $code)
	{
		$ret = 0;
		$Invitation = M('invitation');
		$icond['code'] = $code;
		$idata = $Invitation->where($icond)->field('uid,used')->find();
		if($idata!=null and $idata['used']=='0'){
			import("@.Action.AccountAction");
			$account = new AccountAction();
			if($idata['uid']==null){ // buyer
				$dbret = $account->signup($username,$password,null,false);
				if($dbret){
					$idata['uid'] = $dbret;
					$ret = 1;
				}
				else{
					$ret = 2;
				}
			}
			else{ // seller
				if(!$account->exist($username,false)){
					$Login = M('login');
					$ldata['id'] = $idata['uid'];
					if($username!=null){
						$ldata['username'] = $username;
					}
					$ldata['password'] = md5($password);
					$Login->save($ldata);
					$ret = 1;
				}
			}
			if($ret==1){
				$idata['used'] = 1;
				$Invitation->where($icond)->save($idata);
			}
		}
		$this->ajaxReturn($ret);
	}
	
	public function test()
	{
		dump(C('USER_AUTH_KEY'));
		dump(session('user'));
		dump(session('?user'));
	}
	
}
?>
