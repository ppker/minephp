<?php
/**
 * @Author: ppker
 * @Date:   2015-08-16 17:33:28
 * @Last Modified by:   ChangYi
 * @Last Modified time: 2015-08-16 17:56:32
 * @Description Canton节点遍历
 */
namespace Api\Controller;
use Common\Controller\DataOpeController;
class CantonController extends DataOpeController {

	public function getBaseSelectSelectSelect( $where ){
		$m = D('Api/Canton');
		$list = $m->field("id,name title,parent_id,fdn val")->where($where)->order(" id desc ")->select();
		if($list) {
			$data	= array($list);
		}else{
			$data = array();
		}

		//var_dump($list);die;
		echo json_encode($list);
	}
	
	public function getSelectSelectSelectAll(){
		$where = array();
		$this->getBaseSelectSelectSelect($where);
	}

}