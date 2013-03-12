<?php

class RelationAction extends Action {
    public function index(){
		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
	
	// /*!! 两个用户关注情况详细信息
	// * @param int $target: 目标用户id
	// * @param int $source: 源用户id,o默认为当前用户
	// * @return: 关系信息|null
	// */
	// public function show($target, $source=0,$ajax=true)
	// {
		// if($source==0){
			// $source = session(C('USER_AUTH_KEY'));
		// }
		// $ret = null;
		
		// import('@.Action.User');
		// $user = new UserAction();
		// $suser = $user->show_brief($source,false);
		// $tuser = $user->show_brief($target,false);
		// if($suser&&$tuser){
			// $flag = $this->following($source,$target);
			// $suser['following'] = $flag;
			// $tuser['followed_by'] = $flag;
			// $flag = $this->following($target,$source);
			// $suser['followed_by'] = $flag;
			// $tuser['following'] = $flag;
			// $ret = ['source'=>$suser,'target'=>$tuser];
		// }
		// if(!$ajax){
			// return $ret;
		// }
		// if($ret){
			// $ajdata['relation'] = $ret;
			// $this->ajaxReturn($ajdata,'',1);
		// }
		// else{
			// $this->ajaxReturn(null,'User does not exist',0);		
		// }
	// }
	
	// /*! source是否关注target
	// * @param int $source 默认为当前用户
	// * @param int $target 
	// * @return true|false
	// */
	// public function following($target, $source=0)
	// {
		// if($source==0){
			// $source = session(C('USER_AUTH_KEY'));
		// }
		// $Relation = M('relation');
		// $condition['from'] = $source;
		// $condition['to'] = $target;
		// return $Relation->where($condition)->find()!=null;
	// }
	
	// /*! ta的粉丝id集
	// * @param int $uid 默认为当前用户
	// * @param int $page 页码 默认为1
	// * @param int $count 每页显示数量 默认为50，最大为200
	// * @return array | null 粉丝列表id信息
	// */
	// public function followers_id($uid=0, $page=1, $count=50)
	// {
		// $ret= $this->relations($uid,$page,$count,true);
		// foreach($ret['ids'] as $k=>$v){
			// $ajdata['friends_id'][] = $v['to'];
		// }
		// $this->ajaxReturn($ajdata,'',1);
		// return $ret;
	// }
	
	// /*! ta的粉丝列表详细信息
	// * @param int $uid 默认为当前用户
	// * @param int $page 页码 默认为1
	// * @param int $count 每页显示数量 默认为50，最大为200
	// * @return array | null 粉丝列表详细信息
	// */
	// public function followers_show($uid=0, $page=1, $count=50)
	// {
		// $ids = $this->relations($uid,$page,$count,false);
		// import('@.Action.User');
		// $user = new UserAction();
		// if($ids){
			// for($i=0;$i<count($ids['ids']);$i++){
				// $user = new UserAction();
				// $ret[] = $user->info($uid,false);
			// }
			// $ret['page'] = $ids['page'];
			// $ret['count'] = $ids['count'];
			// $ret['size'] = $ids['size'];
			// $ret['total_page'] = $ids['total_page'];
			// $ajdata['followers'] = $ret;
			// $this->ajaxReturn($ajdata,'',1);
		// }
		// else{
			// $this->ajaxReturn(null,'System error',0);
		// }
	// }
	
	// /*! ta关注的用户id集
	// * @param int $uid 默认为当前用户
	// * @param int $page 页码 默认为1
	// * @param int $count 每页显示数量 默认为50，最大为200
	// * @return array | null 关注列表id信息
	// */
	// public function friends_id($uid=0, $page=1, $count=50)
	// {
		// $ret= $this->relations($uid,$page,$count,true);
		// foreach($ret['ids'] as $k=>$v){
			// $ajdata['friends_id'][] = $v['to'];
		// }
		// $this->ajaxReturn($ajdata,'',1);
		// return $ret;
	// }
	
	// /*! ta关注列表详细信息
	// * @param int $uid 默认为当前用户
	// * @param int $page 页码 默认为1
	// * @param int $count 每页显示数量 默认为50，最大为200
	// * @return array | null 关注列表详细信息
	// */
	// public function friends_show($uid=0, $page=1, $count=50)
	// {
		// if($uid==0){
			// $uid=session(C('USER_AUTH_KEY'));
		// }
		// $ids = $this->relations($uid,$page,$count,true);
		// import('@.Action.User');
		// if($ids){
			// for($i=0;$i<count($ids['ids']);$i++){
				// $user = new UserAction();
				// $ret[] = $user->info($uid,false);
			// }
			// $ret['page'] = $ids['page'];
			// $ret['count'] = $ids['count'];
			// $ret['size'] = $ids['size'];
			// $ret['total_page'] = $ids['total_page'];
			// $ajdata['friends'] = $ret;
			// $this->ajaxReturn($ajdata,'',1);
		// }
		// else{
			// $this->ajaxReturn(null,'System error',0);
		// }
	// }
	
	// /*! 关注某用户
	// * @param int target
	// * @param return true|false
	// */
	// public function create($target)
	// {
		// $ret = false;
		// $source=session(C('USER_AUTH_KEY'));
		// $Relation = M('Relation');
		// if($Relation){
			// $condition['from'] = $source;
			// $condition['to'] = $target;
			// $data=$Relation->where($condition)->find();
			// if(!$data){
				// $ret=$Relation->add($condition);
				// if($ret){
					// $data = $this->show($target,false);
					// $ajdata['relation'] = $data;
					// $this->ajaxReturn(ajdata,'',1);
				// }
				// else{
					// $this->ajaxReturn(null,'System error',0);
				// }
			// }
			// else{
				// $this->ajaxReturn(null,'Already followed uid',0);
			// }
		// }
		// $this->ajaxReturn(null,'System error',0);
	// }
	
	// /*! 取消关注某用户
	// * @param int target
	// */
	// public function destory($target)
	// {
		// $ret = false;
		// $source=session(C('USER_AUTH_KEY'));
		// $Relation = M('Relation');
		// if($Relation){
			// $condition['from'] = $source;
			// $condition['to'] = $target;
			// $ret=(bool)$Relation->where($condition)->delete();
		// }
		// if($ret){
			// $this->ajaxReturn(null,'',1);
		// }
		// else{
			// $this->ajaxReturn(null,'Need you follow uid',0);
		// }
	// }

	
	// public function test()
	// {
		// dump(format_date(0));
		// dump(1);
	// }
	
	// private function relations($uid, $page, $count, $from)
	// {
		// $page =(int) $page;
		// if($uid===0){
			// $uid=session(C('USER_AUTH_KEY'));
		// }
		// if($from){
			// $field = 'to';
			// $condition['from'] = $uid;
		// }
		// else{
			// $field = 'from';
			// $condition['to'] = $uid;
		// }
		// $Relation = M('Relation');
		// $data = $Relation->where($condition)->page($page,$count)->field($field)->select();
		// $total = $Relation->where($condition)->field('count(*)')->select();
		// if($total){
			// $total=(int)($total[0]['count(*)']);
		// }
		// else{
			// $total = 0;
		// }
		// $totalpage = (int)($total/$count);
		// if($total%$count!=0){
			// $totalpage++;
		// }
		// $ret['ids'] = $data;
		// $ret['size'] = count($data);
		// $ret['page'] = $page;
		// $ret['count'] = $count;
		// $ret['total_page'] = $totalpage;
		// return $ret;
	// }
	
	/*! 赞某人：source-target只能赞一次，
	* @param guid target 目标
	* @param str type shuai,meng,niu
	* @return 2:已评价过，1：成功
	*/
	public function approve($target, $type)
	{
		$ret = 0;
		if($type!='shuai' and $type!='meng' and $type!='niu'){
			$this->ajaxReturn(0,'JSON');
		}
		$source=session(C('USER_AUTH_KEY'));
		$Approve = M('approve');
		$acond['target'] = $target;
		$acond['source'] = $source;
		$data=$Approve->where($acond)->find();
		if($data==null){
			$acond['type'] = $type;
			$data = $Approve->add($acond);
			if($data){
				$User = M('user');
				$ucond['uid'] = $target;
				$dbret = $User->where($ucond)->setInc($type);
				$ret = $dbret?1:0;
			}
		}
		else{
			$ret = 2;
		}
		$this->ajaxReturn($ret,'JSON');
	}
	
	/*! 关注某人：source-target只能关注一次
	* @param guid $target 目标id
	* @return 0失败，1成功，2已关注过
	*/
	public function follow($target)
	{
		$ret = 0;
		$source=session(C('USER_AUTH_KEY'));
		if($source!=$target){
			$Relation = M('relation');
			$cond['from'] = $source;
			$cond['to'] = $target;
			$dbret = $Relation->where($cond)->find();
			if($dbret==null){
				$dbret = $Relation->add($cond);
				if($dbret){
					$User = M('user');
					$ucond['uid'] = $target;
					$dbret = $User->where($ucond)->setInc('follower_count');
					$ret = 1;
				}
			}
			else{
				$ret = 2;
			}
		}
		// dump($ret);
		$this->ajaxReturn($ret,'JSON');
	}
}