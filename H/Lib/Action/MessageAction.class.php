<?php
// @_@

class MessageAction extends Action {
	/*! 获取系统通知
	* @param int $page 页码 从1开始
	*/
	public function index($page=1,$count=16)
	{
		$uid = session(C('USER_AUTH_KEY'));
		$Message = M('message');
		$cond['yue_message.uid'] = $uid;
		$cond['yue_message.state'] = array('neq','deleted');
		$total = (int)($Message->where($cond)->count());
		$ret['total_page'] = $total;
		$ret['page'] = $page;
		$ret['count'] = $count;
		$dbret = $Message->where($cond)
			->join('yue_user on yue_message.from=yue_user.uid')
			->field('yue_message.id,yue_message.from,yue_user.name,yue_message.header,yue_message.state,yue_message.createtime')
			->order('yue_message.createtime desc')
			->page($page,$count)->select();
		if($dbret!=null){
			$ret['message'] = array();
			foreach($dbret as $item){
				$item['createtime'] = format_time_min( (int)($item['createtime']),'/');
				if($item['from']==null){
					$item['name'] = '约见';
					$item['from'] = '';
				}
				$ret['message'][]=$item;
			}
		}
		else{
			$ret['messages'] = null;
		}
		// dump($ret);
		$this->ajaxReturn($ret,'JSON');
	}
	
	public function detail($id)
	{
		$ret = null;
		$Message = M('message');
		if($Message){
			$cond['yue_message.id'] = $id;
			$ret = $Message->where($cond)
			->join('yue_user on yue_message.from=yue_user.uid')
			->field('yue_message.id,yue_user.name,yue_message.subject,
					yue_message.content,yue_message.state,yue_message.createtime')
			->find();
			if($ret){
				$ret['createtime'] = format_time_min( (int)($ret['createtime']),'/');
				if($ret['name']==null){
					$ret['name'] = '约见';
				}
				if($ret['state'] != 'viewed'){
					$data['state'] = 'viewed';
					$Message->where($cond)->save($data);
				}
			}
		}
		// dump($ret);
		$this->ajaxReturn($ret,'JSON');
	}
	
	/*! 删除一条消息
	*/
	public function delete($id,$ajax=true)
	{ 
		$ret = 0;
		$Message = M('message');
		if($Message){
			$cond['id'] = $id;
			$data['state'] = 'deleted';
			$ret = $Message->where($cond)->save($data)?1:0;
		}
		if($ajax){
			$this->ajaxReturn($ret,'JSON');
		}
		else{
			return $ret;
		}
	}
	
	/*!
	* 删除多条记录
	**/
	public function deleteAll($ids)
	{
		$ret = 0;
		$Message = M('message');
		if($Message){
			$ret = 1;
			foreach($ids as $id){
				if(!$this->delete($id,false)){
					$ret = 0;
				}
			}
		}
		$this->ajaxReturn($ret,'JSON');
	}
	
	public function test()
	{
		dump(format_date(0));
		dump(1);
	}
	
}