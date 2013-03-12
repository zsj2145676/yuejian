<?php

class PayAction extends Action {
	
	/*! 交易成功回调
	* @param v_oid 订单号
	* @param v_pmode 支付方式
	* @param v_pstatus 支付状态(20成功，30失败)
	* @param v_pstring 支付结果
	* @param v_amount 支付金额
	* @param v_moneytype 实际币种
	* @param v_md5str MD5校验值
	**/
	public function callback($v_oid,$v_md5str,$v_pstatus,$v_amount,$v_moneytype,$remark1,$remark2)
	{
		$key='guangfeinanqunjerry';
		// $v_oid     =trim($_POST['v_oid']);       // 商户发送的v_oid定单编号   
		// $v_pmode   =trim($_POST['v_pmode']);    // 支付方式（字符串）   
		// $v_pstatus =trim($_POST['v_pstatus']);   //  支付状态 ：20（支付成功）；30（支付失败）
		// $v_pstring =trim($_POST['v_pstring']);   // 支付结果信息 ： 支付完成（当v_pstatus=20时）；失败原因（当v_pstatus=30时,字符串）； 
		// $v_amount  =trim($_POST['v_amount']);     // 订单实际支付金额
		// $v_moneytype  =trim($_POST['v_moneytype']); //订单实际支付币种    
		// $remark1   =trim($_POST['remark1' ]);      //备注字段1 /uid
		// $remark2   =trim($_POST['remark2' ]);     //备注字段2 // refu,desc
		// $v_md5str  =trim($_POST['v_md5str' ]);   //拼凑后的MD5校验值  
		// 重新计算md5的值
		$md5string=strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$key));
		if ($v_md5str==$md5string)
		{
			if($v_pstatus=="20"){
				// 成功
				$Bid = M('bid');
				$data['id'] = $v_oid;
				$data['price'] = (double)($v_amount);
				// $data['createtime'] = time();
				$data['payed'] = 1;
				$dbret = $Bid->save($data);
				if($dbret){
					// header('Location:'.$remark1);
					echo '支付成功，请等候竞拍结束...'
					return;
				}
			}
			else
			{
				
			}
		}
		echo '支付失败';
	}
	  
	public function test($tradeid,$money)
	{
		$Bid = M('bid');
		$dbret = $Bid->select();
		dump($dbret);
	}
}