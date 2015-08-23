<?php
/**
 * @Author: ppker
 * @Date:   2015-08-04 07:37:56
 * @Last Modified by:   ChangYi
 * @Last Modified time: 2015-08-12 01:19:15
 */
namespace Api\Controller;
use Common\Controller\DataOpeController;
class DataListController extends DataOpeController {
	public function index(){
		$controller = $_POST['controller'];
		$this->model = D($controller);
		parent::index();
	}	
}