<?php
//import('collect.Common/ErrorConstants');
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
    	header("location:./index.php");
    }
	
	public function test()
	{
		dump($ErrorConstants::SystemError);
	}
}