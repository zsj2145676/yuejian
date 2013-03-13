<?php
class ActivityAction extends Action {
    
    public function index(){
        $user = session('user');
        $this->assign('uid',$user['uid']);
        $this->assign('group',$user['group']);
        if($user['uid']==null){
            $this->assign('navdiv',"<li><a href=# id='openlogin'>登陆</a></li><li>|</li><li><a href=# id='openregister'>注册</a></li>");
        }  else {
            $this->assign('navdiv',"<li><a href='javascript:;' id='mypage'>个人主页</a>&nbsp;&nbsp;<a href='./a.php?m=Account&a=logout'><span></span>登出</a></li>");
        }
        $this->display();
    }
}
?>