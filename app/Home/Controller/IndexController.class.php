<?php
namespace Home\Controller;
use Common\Controller\DataOpeController;
class IndexController extends DataOpeController {
    public function index(){
    	
        $this->display("index");
    }
}