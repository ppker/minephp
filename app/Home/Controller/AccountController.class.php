<?php
namespace Home\Controller;
use Common\Controller\DataOpeController;
class AccountController extends DataOpeController {

	public function __construct(){
		$this->cacheTpl = false;
		parent::__construct();
	}

	public function index(){
		$m = M('Role');
		$role_cate = $m->field(array('role_id','name'))->order('`order` asc')->select();
		if(empty($role_cate)) $role_cate = array();
		$this->assign('roleArray',$role_cate);
		// 传递 model, 主要是通过js 传递给api 然后api再传递给Controller
		$this->assign('controller' , CONTROLLER_NAME);
		$this->display("./DxInfo/DxTpl/data_list.html");
		// parent::index();
	}
}