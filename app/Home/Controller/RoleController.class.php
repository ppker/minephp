<?php
namespace Home\Controller;
use Common\Controller\DataOpeController;
class RoleController extends DataOpeController {
    function __construct(){
    	$this->cacheTpl = false;
    	parent::__construct();
    }
        
}