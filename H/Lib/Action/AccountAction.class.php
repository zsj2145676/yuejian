<?php
class AccountAction extends Action {

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
			$ret = $User->where($cond)->field('name,avatar,phone,credit as bankno')->find();
			$Email = M('email');
			$ret['email'] = $Email->where($cond)->field('address,verified')->find();
			if($ret['email']!=null){
				$ret['email']['verified'] = (int)($ret['email']['verified']);
			}
		}
		// dump($ret);
		$this->ajaxReturn($ret,'JSON');
	}
}