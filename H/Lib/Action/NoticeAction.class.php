<?php
// @_@ //

class NoticeAction extends Action {
	/*! 获取系统通知
	* @param int $page 页码 从1开始
	*/
	public function index($page=1)
	{
		$uid = session(C('USER_AUTH_KEY'));
		$Notice = M('notice');
		$cond['yue_notice.uid'] = $uid;
		$total = (int)($Notice->where($cond)->count());
		$ret['total_page'] = $total;
		$ret['page'] = $page;
		$dbret = $Notice->where($cond)
			->join('yue_trade on yue_trade.id=tradeid')
			->join('yue_bid on yue_bid.id=bidid')
			->join('yue_user on yue_user.uid=yue_bid.buyer')
			->field('yue_notice.createtime as noticetime,
					yue_notice.tradeid,
					yue_trade.starttime as date,
					yue_bid.price as buyprice,
					yue_bid.message as buymsg,
					yue_user.uid as buyerid,yue_user.avatar,yue_user.name')
			->order('noticetime desc')
			->page($page,1)->select();
		// dump($dbret);
		if($dbret!=null){
			$dbret = $dbret[0];
			$suser =  session('user');
			$notice['sellername'] = $suser['name'];
			$notice['date'] = format_date_cn((int)($dbret['date']));
			$Bid = M('bid');
			$bcond['tradeid'] = $dbret['tradeid'];
			
			$notice['buyer_count'] = (int)($Bid->where($bcond)->count());
			$notice['price'] = (double)($dbret['buyprice']);
			$notice['message'] = $dbret['buymsg'];
			// $notice['buyer_count'] = (int) $dbret['buyer_count'];
			$buyer['uid'] = $dbret['buyerid'];
			$buyer['name'] = $dbret['name'];
			$buyer['avatar'] = avatar_url($dbret['avatar'],'normal');
			$notice['buyer'] = $buyer;
			$notice['createtime'] = format_date((int)($dbret['noticetime']));
			$ret['notice'] = $notice;
		}
		else{
			$ret['notice'] = null;
		}
		// dump($ret);
		// dump($ret);
		$this->ajaxReturn($ret,'JSON');
	}
	
	public function test()
	{
		dump(format_date(0));
		dump(1);
	}
	
}