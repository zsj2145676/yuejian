<?php

class SellerAction extends Action {

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
		$user = $User->where($ucond)->field('name,avatar,birthday,occupation,school,product,job,follower_count')->find();
		if($user){
			if($user['birthday']=='0'){
				$user['birthday'] = '';
			}
			else{
				$user['birthday'] = format_date_cn((int)($user['birthday']));
			}
			// avatar
			$user['avatar'] = avatar_url($user['avatar']);
			// cfollowers
			$user['follower_count'] = (int)($user['follower_count']);
			// average price
			$Trade = M('trade');
			$tcond['seller'] = $uid;
			$tcond['state']  = 'success';
			$user['avg_price'] = (double)($Trade->where($tcond)->avg('final_price'));
			// status
			$Status = M('status');
			$status = $Status->where($ucond)->find();
			$user['weibo']['mof'] = 0;
			$user['video'] = '';
			if($status!=null){
				$user['video'] = $status['video'];
				if($status['wb_id']!=null){
					$user['weibo']['wid'] = $status['wb_id'];
					$user['weibo']['duty'] = $status['wb_duty'];
					$user['weibo']['mof'] = 1;
				}
			}
		}
		// dump($user);
		$this->ajaxReturn($user,'JSON');
	}
	
	public function trade($uid=null, $page=1)
	{
		$c_delta = 3*60*60;
		$ret = null;
		if($uid==null){
			$uid = session(C('USER_AUTH_KEY'));
		}
		$page = (int)($page);
		$Trade = M('trade');
		$cond['seller'] = $uid;
		$cond['state'] = 'unfinished';
		$deadline = time()-$c_delta;
		$cond['starttime'] = array('GT',$deadline);
		$total = (int) ($Trade->where($cond)->count());
		$ret['total_page'] = $total;
		$ret['page'] = $page;
		$dbret = $Trade->where($cond)->order('starttime asc')->page($page,1)->select();
		if($dbret!=null){
			$item = $dbret[0];
			$istart = (int)$item['starttime'];
			$start = format_time_min($istart);
			$end = format_time_min($item['endtime']);
			$segs = explode(' ',$start);
			$trade['tradeid'] = $item['id'];
			$trade['date'] = $segs[0];
			$tmp = explode(' ',$end);
			$trade['time'] = $segs[1].'-'.$tmp[1];
			$trade['price'] = (float) $item['price'];
			$deadline = $istart - $c_delta;
			$trade['deadline'] = format_time($deadline,'/');
		}
		$ret['trade'] = $trade;
		$this->ajaxReturn($ret);
	}
	
	/*! 交易信息
	* @param guid $uid 目标uid
	* @param int $page 页面(取消)
	*/
	public function tradeall($uid=null, $state='unfinished')
	{
		$c_delta = 3*60*60;
		$ret = null;
		if($uid==null){
			$uid = session(C('USER_AUTH_KEY'));
		}
		$Trade = M('trade');
		$cond['seller'] = $uid;
		$cond['state'] = $state;
		$dbret = $Trade->where($cond)->order('starttime asc')->select();
		if($dbret!=null){
			$ret = array();
			foreach ($dbret as $item){
				$istart = (int)$item['starttime'];
				$start = format_time_min($istart);
				$end = format_time_min($item['endtime']);
				$segs = explode(' ',$start);
				$trade['tradeid'] = $item['id'];
				$trade['date'] = $segs[0];
				$tmp = explode(' ',$end);
				$trade['time'] = $segs[1].'-'.$tmp[1];
				$trade['price'] = (float) $item['price'];
				$trade['address'] = $item['place'];
				$trade['content'] = $item['description'];
				$deadline = $istart - $c_delta;
				$trade['deadline'] = format_time($deadline,'/');
				$ret[] = $trade;
			}
		}
		// dump($ret);
		$this->ajaxReturn($ret);
	}
	
	/*! 想约见的人的列表
	* 
	*/
	public function followers($uid=null, $count=null)
	{
		if($uid==null){
			$uid = session(C('USER_AUTH_KEY'));
		}
		
		$Relation = M('relation');
		$cond['to'] = $uid;
		if($count!=null){
			$count = (int)($count);
			$data = $Relation->where($cond)
			->join('yue_user on yue_relation.from=yue_user.uid')
			->limit($count)->field('yue_user.uid as follower,name,avatar')->select();
		}
		else{
			$data = $Relation->where($cond)
			->join('yue_user on yue_relation.from=yue_user.uid')
			->field('yue_user.uid as follower,name,avatar')->select();
		}
		$ret['total'] = (int)($Relation->where($cond)->count());
		foreach($data as &$item){
			$item['avatar'] = avatar_url($item['avatar'],'small');
		}
		$ret['followers'] = $data;
		$this->ajaxReturn($ret,'JSON');
	}
	
	/*! 在detail页面上的评论信息i
	* @param int $uid 默认为当前用户
	*/
	public function comments($uid=null, $page=1, $count=8)
	{
		if($uid==null){
			$uid = session(C('USER_AUTH_KEY'));
		}
		$Comment = M('comment');
		$page = (int) ($page);
		$count = (int) ($count);
		$cond['master'] = $uid;
		$total = (int)($Comment->where($cond)->count());
		$total_page = (int)($total/$count);
		if($total%$count!=0){
			$total_page++;
		}
		$data = $Comment->where($cond)
				->join('yue_user on yue_comment.from=yue_user.uid')
				->order('createtime desc')
				->field('yue_comment.id,yue_user.uid as author,name,avatar,content,yue_comment.createtime')
				->page($page,$count)
				->select();
		foreach($data as &$item){
			$item['avatar'] = avatar_url($item['avatar'],'small');
			$item['createtime'] = format_time_min($item['createtime'],'/');
		}
		$ret['total_page'] = $total_page;
		$ret['comments'] = $data;
		// dump($ret);
		$this->ajaxReturn($ret,'JSON');
	}
	
	public function status($uid)
	{
		$ret = '';
		$Status = M('status');
		if($Status){
			$cond['uid'] = $uid;
			$dbret = $Status->where($cond)->field('html')->find();
			if($dbret and $dbret['html']!=null){
				$ret = $dbret['html'];
			}
		}
		// dump($ret);
		echo  json_encode($ret,JSON_HEX_TAG);
		//$this->ajaxReturn($ret,'JSON');
	}
	
	public function test()
	{
		dump(strlen('213'));
	}
}