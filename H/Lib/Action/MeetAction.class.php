<?php

class MeetAction extends Action {
    public function index(){
		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
	
	/*! 约见过的人
	* @param int $uid 默认为当前用户
	*/
	public function history($count=8)
	{
		$uid = session(C('USER_AUTH_KEY'));
		$Meeting = M('meeting');
		$cond['interviewer'] = $uid;
		$dbret = $Meeting->where($cond)->field('interviewee as tt')
		->union("(select interviewer as tt from yue_meeting  where interviewee='$uid')")->select();
		$total = count($dbret);
		$ret['total'] = $total;
		$ret['meets'] = array();
		$count = (int)($count);
		if($count==0 or $count>$total){
			$count = $total;
		}
		import('@.Action.UserAction');
		$user = new UserAction;
		for($i=0;$i<$count;$i++){
			$ret['meets'][] = $user->brief($dbret[$i]['tt']);
		}
		// dump($ret);
		$this->ajaxReturn($ret,'JSON');
	}
	
	/*! 待评论会见
	*/
	public function meet($page=1)
	{
		$ret = null;
		$page = (int) $page;
		$uid = session(C('USER_AUTH_KEY'));
		$Meeting = M('meeting');
		$cond['interviewer'] = $uid;
		$cond['comment'] = -1;
		$ret['total_page'] = (int)($Meeting->where($cond)->count());
		$dbret = $Meeting->where($cond)->order('createtime desc')->page($page,1)->select();
		if($dbret!=null){
			$item = $dbret[0];
			$meet['id'] = $item['id'];
			$idate = (int)($item['createtime'])+TRADE_DEADLINE;
			$meet['date'] = format_date_cn($idate);
			import('@.Action.UserAction');
			$user = new UserAction;
			$meet['seller'] = $user->brief($item['interviewee']);
			$meet['buyer'] = $user->brief($item['interviewer']);
			$ret['meet'] = $meet;
		}
		else{
			$ret['meet'] = null;
		}
		// dump($ret);
		$this->ajaxReturn($ret,'JSON');
	}
	
	/*! 评价会见
	*
	*/
	public function comment($id,$value)
	{
		$ret = 0;
		$uid = session(C('USER_AUTH_KEY'));
		$Meeting = M('meeting');
		if($Meeting){
			$cond['id'] = $id;
			$cond['interviewer'] = $uid;
			$cond['comment'] = -1;
			$data['comment'] = $value;
			$ret = $Meeting->where($cond)->save($data)?1:0;
		}
		$this->ajaxReturn($ret,'JSON');
	}
}