<?php

class TradeAction extends Action {
    public function index(){
		$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
	
	/*! 显示一条交易的详细信息
	* @param int $id 默认为当前最新交易
	* @return 交易信息|null
	*/
	public function show($id=0)
	{
		$Trade = M('trade');
		if($id){
			$condition['id'] = $id;
			$data = $Trade->where($condition)->find();
		}
		else{
			$uid = session(C('USER_AUTH_KEY'));
			$condition['seller'] = $uid;
			$data = $Trade->where($condition)->order('createtime desc')->limit(1)->select();
		}
		if($data){
			$data['createtime'] = format_time($data['createtime']);
			import('@.Action.User');
			$user = new UserAction();
			$data['seller'] = $user->show_brief($data['seller']);
			if($data['buyer']){
				$data['buyer'] = $user->show_brief('buyer');
			}
		}

		dump($data);
		return $data;
	}

	/*! 显示一系列交易的详细信息
	* @param int $id
	* @return 交易信息|null
	*/
	public function show_all($ids)
	{
		$ret = array();
		foreach($ids as $key=>$val){
			$ret[] = show($val);
		}
		return $ret;
	}
	
	/*! ta发起的交易信息id集
	* @param int $uid 用户id，默认为当前用户
	* @param int $page 结果页码，默认为1（首页），最大为200
	* @param int $count 每页数量，默认50
	* @return array<guid>
	*/
	public function detail_id($uid=0, $page=1, $count=50)
	{
		if($uid==0){
			$uid = session(C('USER_AUTH_KEY'));
		}
		$page = (int) $page;
		$count = (int) $count;
		$Trade = M('trade');
		$condition['seller'] = $uid;
		$data = $Trade->where($condition)->page($page,$count)->order('createtime desc')->field('id')->select();// order by id
		$total = $Trade->where($condition)->field('count(*)')->select();
		if($total){
			$total=(int)($total[0]['count(*)']);
		}
		else{
			$total = 0;
		}
		$totalpage = (int)($total/$count);
		if($total%$count!=0){
			$totalpage++;
		}
		$ret['ids'] = $data;
		$ret['page'] = $page;
		$ret['count'] = $count;
		$ret['total_page'] = $totalpage;
		return $ret;
	}
	
	/*! ta发起的交易信息集详细信息
	* @param int $uid 用户id
	* @param int $page 结果页码
	* @param int $count 每页数量，默认50
	*/
	public function detail_show($uid=0, $page=1, $count=50)
	{
		// 处于程序清晰通过id->show实现，会造成不必要查询
		$ids = $this->detail_id($uid,$page,$count);
		$ret['trades'] = $this->show_all($ids['ids']);
		$ret['page'] = $page;
		$ret['count'] = $count;
		$ret['total_page'] = $$ids['total_page'];
		return $ret;
	}
	
	/*! 检测时间段是否可用(不存在相邻3小时之内的交易)
	* @param uid 用户id，若为null则为当前用户
	* @param time 时间段 格式如 2012-12-20 23:00~1:00 （1:00表示第二天）
	* @return 1有冲突 0 无冲突
	*/
	public function checktime($time, $uid=null, $ajax=True)
	{	
		$c_delta = 3*60*60;
		if($uid==null){
			$uid = session(C('USER_AUTH_KEY'));
		}
		$ret = 1;
		// $format = 'Y-n-j G:i';
		$segs = explode('~',$time);
		if(count($segs)==2){
			$day_time = explode(' ',$segs[0]);
			$iStart = strtotime($segs[0]);
			$sEnd = $day_time[0].' '.$segs[1];
			$iEnd = strtotime($day_time[0].' '.$segs[1]);
			if($iEnd!=False&&iStart!=False){
				if($iEnd<$iStart){
					$iEnd += 24*60*60;
				}
				if($iEnd>$iStart){
					$left = $iStart - $c_delta;
					$right = $iEnd + $c_delta;
					$Trade = M('trade');
					$condition['seller'] = $uid;
					$condition['endtime|starttime'] = array('between',"$left,$right");
					$data = $Trade->where($condition)->find();
					$ret = $data==null?0:1;
				}
			}
		}
		if($ajax){
			$this->ajaxReturn($ret,'JSON');
		}
		else{
			return $ret;
		}
	}
	
	/*! 拍卖ta的时间
	* @param float $price 底价
	* @param int start 约见起始时间
	* @param int end 约见结束时间
	* @param str palce 约见地点
	* @param str welfare 公益选项 id串，默认为入私囊
	* @return 1 | 0
	*/
	public function create($money, $time, $address, $description, $charity,$uid=null)
	{
		$ret = 0;
		if($uid==null){
			$uid = session(C('USER_AUTH_KEY'));
		}
		if($this->checktime($time,$uid,False)!=1){
			$segs = explode('~',$time);
			if(count($segs)==2){
				$day_time = explode(' ',$segs[0]);
				$iStart = strtotime($segs[0]);
				$sEnd = $day_time[0].' '.$segs[1];
				$iEnd = strtotime($day_time[0].' '.$segs[1]);
				if($iEnd!=False&&iStart!=False){
					if($iEnd<$iStart){
						$iEnd += 24*60*60;
					}
					$Trade = M('trade');
					$data['price'] = $money;
					$data['seller'] = $uid;
					$data['starttime'] = $iStart;
					$data['endtime'] = $iEnd;
					$data['place'] = $address;
					$data['description'] = $description;
					$data['welfare'] = $charity;
					$ret=$Trade->add($data)==False?0:1;
				}
			}
		}
		$this->ajaxReturn($ret,'JSON');
	}
	
	
	/*! 检测是否可竞拍
	* 拍卖有效 && 非本人 &&未拍过
	* @return 拍卖结束过无效:0;可竞拍:1;本人:2，已拍过(已支付):3
	*/
	public function checkbid($tradeid,$ajax=true)
	{
		$ret = 0;
		if($uid==null){
			$uid = session(C('USER_AUTH_KEY'));
		}
		$Trade = M('trade');
		$cond['id'] = $tradeid;
		$cond['state'] = 'unfinished';
		$dbret = $Trade->where($cond)->find();
		if($dbret){ // 拍卖有效
			if($dbret['seller']!=$uid){ // 非本人
				$Bid = M('bid');
				$bcond['tradeid'] = $tradeid;
				$bcond['buyer'] = $uid;
				$dbret = $Bid->where($bcond)->find();
				$ret = ($dbret==null || $dbret['payed']=='0')?1:3;
			}
			else{
				$ret = 2;
			}
		}
		if($ajax){
			$this->ajaxReturn($ret,'JSON');
		}
		else{
			return $ret;
		}
	}
	
	/*! 参与竞拍
	* @param int $tradeid 拍卖id
	* @param float money 竞拍价
	* @param str description 描述
	*/
	public function bid($uid, $tradeid, $money,$description='')
	{
		$state = $this->checkbid($tradeid,false);
		if($state!=1){
			return;
		}
		$buyer = $uid;
		$Bid = M('bid');
		if($Bid){
			$data['tradeid'] = $tradeid;
			$data['buyer'] = $buyer;
			$dbret = $Bid->where($data)->find();
			if($dbret == null){ // 未拍过
				$data['price'] = $money;
				$data['message'] = $description;
				$data['createtime'] = time();
				$ret = $Bid->add($data);
				if($ret){
					$cond['tradeid'] = $tradeid;
					$cond['buyer'] = $buyer;
					$dbret = $Bid->where($cond)->find();
				}
			}
			else{ // 已拍，未支付
					$udata['price'] = $money;
					$udata['message'] = $description;
					$udata['id'] = $dbret['id'];
					$Bid->save($udata);
			}
			if($dbret!=null){
				echo $dbret['id'];
			}
		}
	}

	public function payed($tradeid)
	{
		$ret = 0;
		$uid = session(C('USER_AUTH_KEY'));
		$cond['tradeid'] = $tradeid;
		$cond['buyer'] = $uid;
		$Bid = M('bid');
		if($Bid){
			$dbret = $Bid->where($cond)->field('payed')->find();
			if($dbret){
				$ret = (int)($dbret['payed']);
			}
		}
		$this->ajaxReturn($ret,'JSON');
	}
	
	public function test($time)
	{
	}
	
}