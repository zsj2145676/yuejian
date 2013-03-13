<?php
class IndexAction extends Action {
    public function index(){
	$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 hah <b>ThinkPHP</b>！</p></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
	
	/*! index页面搜索
	* @param str keywords
	* @return
	*/
	public function search($keywords)
	{
	}
	
	/*! index页面显示内容
	* @param $page 页面编号（默认为0）
	* @param $count 每页数量
	*/
	public function show_all($page=0, $count=50)
	{
	
	}
	
	
	public function test()
	{
		dump(session('?id'));
		// dump(session('id'));
	}
}
