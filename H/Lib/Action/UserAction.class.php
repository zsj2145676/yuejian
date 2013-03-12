<?php

class UserAction extends Action {

	/* 设置用户信息
	* @return 成功返回1，失败返回0 
	*/
	public function setinfo()
	{
		$ret = 0;
		$uid = session(C('USER_AUTH_KEY'));
		$User = M('user');
		if($User){
			$cond['uid'] = $uid;
			
			$name = $_GET['name'];
			$birthday = $_GET['birthday'];
			$occupation = $_GET['occupation'];
			$school = $_GET['school'];
			$product= $_GET['product'];
			$job = $_GET['job'];
			$email = $_GET['email'];
			$phone = $_GET['phone'];
			$bankno = $_GET['bankno'];
			$bank = $_GET['bank'];
			$bankname = $_GET['bankname'];
			if($name){
				$data['name'] = $name;
			}
			if($birthday){
				$data['birthday'] =  strtotime($birthday);
			}
			if($occupation){
				$data['occupation'] = $occupation;
			}
			if($school){
				$data['school'] = $school;
			}
			if($product){
				$data['product'] = $product;
			}
			if($job){
				$data['job'] = $job;
			}
			if($phone){
				$data['phone'] = $phone;
				$data['phone_verified'] = 0;
			}
			if($email){
				$Email = M('email');
				$edata['address'] = $email;
				$edata['verified'] = 0;
				$Email->where($cond)->save($edata);
			}
			if($bank and $bankno and $bankname){
				$data['bank'] = $bank;
				$data['credit'] = $bankno;
				$data['bankname'] = $bankname;
			}
			
			$User->where($cond)->save($data);
			$dbret = $User->where($cond)->find();
			$ret = 1;
			foreach($data as $k=>$v){
				if($v!=$dbret[$k]){
					$ret = 0;
					break;
				}
			}
		}
		$this->ajaxReturn($ret,'JSON');
	}
	
	public function setAvatar($avatar)
	{
		$ret = 0;
		$uid = session(C('USER_AUTH_KEY'));
		if($uid){
			$User = M('user');
			$cond['uid'] = $uid;
			$data['avatar'] = $avatar;
			$ret = $User->where($cond)->save($data)?1:0;
		}
		return $ret;
	}
	
	public function setDeclaration($text)
	{
		$uid = session(C('USER_AUTH_KEY'));
		$ret = 0;
		$Status = M('status');
		if($Status and $uid){
			$cond['uid'] = $uid;
			if($Status->where($cond)->find()==null){
				$data['uid'] = $uid;
				$data['text'] = $text;
				$Status->add($data);
				$ret = 1;
			}
			else{
				$data['text'] = $text;
				$Status->where($cond)->save($data);
				$ret = 1;
			}
		}
		$this->ajaxReturn($ret);
	}
	
	public function setStatus($status)
	{
		$uid = session(C('USER_AUTH_KEY'));
		$ret = 0;
		$Status = M('status');
		if($Status){
			$cond['uid'] = $uid;
			if($Status->where($cond)->find()==null){
				$data['uid'] = $uid;
				$data['html'] = $status;
				$Status->add($data);
			}
			else{
				$data['html'] = $status;
				$ret = $Status->where($cond)->save($data)?1:0;
			}
		}
		$this->ajaxReturn($ret);
	}
	
	public function brief($uid)
	{
		$ret = null;
		$User = M('user');
		$cond['uid'] = $uid;
		$dbret = $User->where($cond)->field('name,avatar')->find();
		if($dbret){
			$ret['uid'] = $uid;
			$ret['name'] = $dbret['name'];
			$ret['avatar'] = avatar_url($dbret['avatar'],'small');
		}
		return $ret;
	}
	
		/*! 取账号
	* @return 成功返回info，失败返回null
	*/
	public function get()
	{
		$ret = null;
		$uid = session(C('USER_AUTH_KEY'));
		if($uid){
			$User = M('user');
			$cond['uid'] = $uid;
			$ret = $User->where($cond)->field('name,avatar,phone,credit as bankno,bank,bankname')->find();
			if($ret){
				$ret['avatar'] = avatar_url($ret['avatar'],'small');
			}
		}
		// dump($ret);
		$this->ajaxReturn($ret,'JSON');
	}
}