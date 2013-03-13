<?php
// @_@

class BuyerAction extends Action {

	/*! 获取用户信息(基本信息+关注统计+均价统计+video+weibo)
	* @param guid $uid 用户id，默认当前用户
	* @return: 用户信息|null
	*/
	public function info($uid=null)
	{
		if($uid==null){
			$uid = session(C('USER_AUTH_KEY'));
		}
		// user
		$User = M('user');
		$ucond['uid'] = $uid;
		$user = $User->where($ucond)->field('name,avatar,birthday,occupation,school,product,job')->find();
		if($user){
			if($user['birthday']=='0'){
				$user['birthday'] = '';
			}
			else{
				$user['birthday'] = format_date_cn((int)($user['birthday']));
			}
			$user['avatar'] = avatar_url($user['avatar']);
			// 宣言
			$Status = M('status');
			$status = $Status->where($ucond)->find();
			$user['declaration']= $status['text'];
			if($user['declaration']==null){
				$user['declaration'] = '';
			}
		}
		// dump($user);
		$this->ajaxReturn($user,'JSON');
	}
	
	/*! 想约见的人的列表
	* 
	*/
	public function friends($uid=null, $count=0)
	{
		if($uid==null){
			$uid = session(C('USER_AUTH_KEY'));
		}
		
		$Relation = M('relation');
		$cond['from'] = $uid;
		$count = (int)($count);
		// dump($count);
		if($count!=0){
			$data = $Relation->where($cond)
			->join('yue_user on yue_relation.to=yue_user.uid')
			->limit($count)->field('yue_user.uid as friend,name,avatar')->select();
		}
		else{
			$data = $Relation->where($cond)
			->join('yue_user on yue_relation.to=yue_user.uid')
			->field('yue_user.uid as friend,name,avatar')->select();
		}
		foreach($data as &$item){
			$item['avatar'] = avatar_url($item['avatar'],'small');
		}
		$ret['total'] = (int)($Relation->where($cond)->count());
		$ret['friends'] = $data;
		// dump($ret);
		$this->ajaxReturn($ret,'JSON');
	}
}