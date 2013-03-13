<?php
class SearchAction extends Action {

	// function js_unescape($str)
	// {
		// $ret = '';
		// $len = strlen($str);
		// for ($i = 0; $i < $len; $i++){
			// if ($str[$i] == '%' && $str[$i+1] == 'u'){
				// $val = hexdec(substr($str, $i+2, 4));
				// if ($val < 0x7f) $ret .= chr($val);
				// else if($val < 0x800) $ret .= chr(0xc0|($val>>6)).chr(0x80|($val&0x3f));
				// else $ret .= chr(0xe0|($val>>12)).chr(0x80|(($val>>6)&0x3f)).chr(0x80|($val&0x3f));
				// $i += 5;
			// }
			// else if ($str[$i] == '%'){
				// $ret .= urldecode(substr($str, $i, 3));
				// $i += 2;
			// }
			// else $ret .= $str[$i];
		// }
		// return $ret;
	// }

    /*! 首页内容
    *
    */
    public function index($key='', $type='', $page=1, $count=30)
    {
		// dump($key);
		$User = M('user');
		// $key = $this->js_unescape($key);
		// dump($key);
		$condition['group'] = C('USER_GROUP_SELLER');
		if($key!='' and $key!=null and $key!='null'){
			$condition['name'] = array('like',"%$key%");
		}
		if($type!=''){
			$condition['cat'] = array('like',"%$type%");
		}
		$total = $User->where($condition)->field('count(*)')->select();
		//  pages
		if($total){
			$total=(int)($total[0]['count(*)']);
		}
		else{
			$total = 0;
		}
		$pages = (int)($total/$count);
		if($total%$count!=0){
			$pages++;
		}

		$data = $User
		->join('(select id as tradeid,seller,price,description,state,max(createtime) as createtime,1 as flag from yue_trade group by seller) as TT on yue_user.uid=TT.seller')
		->where($condition)
		->order('state desc')//yue_user.shuai+yue_user.meng+yue_user.niu desc'
		->page($page,$count)
		->field('uid as seller,name,avatar,meng,niu,shuai,'."(shuai+meng+niu) as total_cmt".',TT.tradeid,TT.price,TT.description,TT.state')
		->select();
		if ($data!=null){
			foreach($data as &$item){
				$item['meng'] = (int)($item['meng']);
				$item['niu'] = (int)($item['niu']);
				$item['shuai'] = (int)($item['shuai']);
				$item['total_cmt'] = (int)($item['total_cmt']);
				$item['price'] = (float)($item['price']);
				$item['avatar'] = avatar_url($item['avatar']);
			}
		}
		$ret['page'] = $page;
		$ret['count'] = $count;
		$ret['total_page'] = $pages;
		$ret['result'] = $data;
		// dump($ret);
		$this->ajaxReturn($ret,'JSON');
    }
	
	public function test()
	{
		dump(session('?id'));
		// dump(session('id'));<?php
		dump(urlencode('垦荒'));

	}
}
