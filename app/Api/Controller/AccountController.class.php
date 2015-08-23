<?php
/**
	author: ppker
	date: 2015-07-05
*/
namespace Api\Controller;
use Common\Controller\DataOpeController;
class AccountController extends DataOpeController {
	public function __construct(){
		$this->model = D('Api/Account');

		//die('dfdsfdsf');
		// var_dump($this->model);die;
		parent::__construct();
	}

	/**
	 * 重置密码
	 */
	function resetPassword(){
		$m = $this->model;
		$data['account_id']=$_REQUEST['i'];
		$data['pwd']='123456';
		$info['status']= $m->save($data);
		if($info['status']==1){
			$info["info"]="密码重置成功";
		}else{
			$info["info"]="密码重置失败";
		}
		echo json_encode($info);
	}






}