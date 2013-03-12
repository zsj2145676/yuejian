<?php
class LandingAction extends Action {
    public function index($email){
		$landingpage=M('landingpage');
		$condition['email']=$email;
		$ret = $landingpage->where($condition)->select();
		if($ret==NULL){
			$landingpage->create();
			$landingpage->email = $email;
			$landingpage->created = time();
			$landingpage->add($data);		
		}
		$this->show("<script>window.location.href=\"landingpage/landingdetail.php\";</script>");
    }
	
	public function detail($target)
	{
		$landingdetail = M('landingdetail');
		$condition['name'] = $target;
		$ret = $landingdetail->field('id')->where($condition)->find();
		dump($ret);
		if($ret==NULL){
			$landingdetail->create();
			$landingdetail->name = $target;
			$landingdetail->count = 1;
			$landingdetail->add();
			$this->ajaxReturn($data,"",1);
		}
		else{
			$id = $ret['id'];
			$landingdetail->where("id=$id")->setInc('count');
			$this->ajaxReturn($data,"",1);
		}
	}
}
?>