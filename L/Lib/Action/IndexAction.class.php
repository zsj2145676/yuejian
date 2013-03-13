<?php
class IndexAction extends Action {
    public function index(){
    }
    
    public function updateStatisticsForLandingpage() {
        $parentName = $this->_post('parent_name');
        $statisticsArray = explode(',', $this->_post('statistics'));
        $statisticsLandingpageM = M('StatisticsLandingpage');
        $parentId = $statisticsLandingpageM->where('item_name="'.$parentName.'"')->getField('item_id',1);
        $statisticsLandingpageM->where('item_name="'.$parentName.'"')->setInc('sum',1);
        foreach ($statisticsArray as $v) {
            $condition['parent_id'] = $parentId;
            $condition['item_name'] = $v;
            $condition['_logic']= 'AND';
            $statisticsLandingpageM->where($condition)->setInc('sum',1);
        }
        $data['status'] = 1;
        $this->ajaxReturn($data, 'JSON');
    }
}