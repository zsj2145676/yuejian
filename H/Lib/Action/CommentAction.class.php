<?php

class CommentAction extends Action {
    public function index(){
		//$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
	
	// /*! 获得一条Comment详细信息
	// * @param int $id comment id
	// * @return array|null
	// */
	// public function show($id)
	// {	
		// $Comment = M('comment');
		// $condition['id'] = $id;
		// $data = $Comment->where($condition)->find();
		// if($data){
			// $data['createtime'] = format_time($data['createtime']);
			// import('@.Action.User');
			// $user = new UserAction();
			// $data['from'] = $user->show_brief($data['from']);
			// $data['to'] = $user->show_brief($data['to']);
		// }
		
		// dump($data);
		// return $data;
	// }
	
	// /*! 获取一组Comment详细信息
	// * @param array<int> $ids
	// * @return 评论信息数组|null 
	// */
	// public function show_all($ids)
	 // {
		// $Comment = M('comment');
		// $ret = array();
		// for(int i=0;i<count($ids);i++){
			// $ret[] = $this->show($ids[i])
		// }
		// return $ret;
	// }
	

	// /*! 在ta页面上的评论信息
	// * @param int $uid 默认为当前用户
	// * @param int $page 默认为1（首页）
	// * @param int $count 默认为50，最大为200
	// * @return array|null
	// */
	// public function detail_show($uid=0, $page=1, $count=50)
	// {
		// 处于程序清晰通过id->show实现，会造成不必要查询
		// $ids = $this->detail_id($uid,$page,$count);
		// $ret['comments'] = $this->show_all($ids['ids']);
		// $ret['page'] = $page;
		// $ret['count'] = $count;
		// $ret['total_page'] = $$ids['total_page'];
		// return $ret;
	// }
	
	/*! 创建一条评论
	* @param int $master 主人
	* @param int $to 被评论人，默认为无
	* @param str $content 内容
	* @return int 成功则返回comment id，否则返回0
	*/
	public function create($content,$master=null, $to=null)
	{
		$ret = 0;
		$me = session(C('USER_AUTH_KEY'));
		if($master==null){
			$master = $me;
		}
		if($to==null){
			$to = $master;
		}
		$Comment = M('comment');
		$data['master'] = $master;
		$data['to'] = $to;
		$data['from'] = $me;
		$data['createtime'] = time();
		$data['content'] = $content;
		$ret=$Comment->add($data);
		// dump($ret);
		$this->ajaxReturn($ret,'JSON');
	}
	
	
	public function test()
	{
		dump(format_date(0));
		dump(1);
	}
	
}