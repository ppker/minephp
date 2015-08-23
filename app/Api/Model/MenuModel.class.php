<?php
/**
 * Author: ppker
 * Date: 15/7/03
 */
namespace Api\Model;
use Common\Model\DxMenuModel;

class MenuModel extends DxMenuModel {
	public $listFields=array(
			"menu_id"      => array('type'=>'int','size'=>5,'pk'=>true),
			"parent_id"    => array('type'=>'int','size'=>5,'title'=>'上级菜单编号'),
			"order_no"     => array('type'=>'int','size'=>10 ,'default' =>'0','comment'=> '序号,等于:父亲的order_no+自己的显示order_no*power(32,6-order_level)'),
			"order_level"  => array('type'=>'int','size'=>1, 'default' => '0', 'comment' =>'order层次'),
			"menu_name"    => array('type'=>'varchar','size'=>45, 'default' =>'', 'comment'=> '菜单名称'),
			"module_name"  => array('type'=> 'varchar','size'=>45 ,'default'  =>'', 'comment' => '模块名称'),
			"action_name"  => array('type'=>'varchar','size'=>31, 'default'  =>'', 'comment' => 'Action名称'),
			"args"         => array('type'=>'varchar','size'=>127,'default'  =>'', 'comment' => '参数,某些菜单提供默认参数'),
			"type"         => array('type'=>"enum",'default' =>'action','valChange'=>array('quick_menu','menu','action','hide_action'), 'comment'=> '菜单类型：快捷菜单、菜单、显示动作、后台动作'),
			"is_desktop"   => array('type'=> 'tinyint','size'=>4, 'default' => '0'),
			"desktop_url"  => array('type'=>'varchar','size'=>31, 'default' =>'','comment'=>'桌面菜单URL'),
			"other_info"   => array('type'=> 'varchar','size'=>127,'default' =>'','comment'=>'附加信息')
	);
	//根据id获取下级菜单的信息
	public function getLowerMenu($id){
		$data	= $this->where(array("parent_id"=>$id,'menu_id'=>array('in',D("Role")->getMenuID())))->order("order_no asc")->select();
		
		return $data;
	}
	/*
	 * 获取一级菜单 导航
	 * */
	public function getTopMenuList(){
		$data = $this->where(array("parent_id"=>0))->order("order_no asc")->select();
		return $data;
	}
	
	/*
	 * 获取下级菜单 二级小菜单
	 * */
	public function getLowerMenuList($id){
		$data = $this->where(array("parent_id"=>$id))->order("order_no asc")->select();
// 		die($this->getLastSQL());
		return $data;
	}
	//根据id获取菜单信息
	public function getMenuInfo($id){
		return $this->where(array($this->getPk()=>$id))->find();
	}
	
	public function getAllMenuList(){
		return $this->select();
	}
	
	public function getRoleDeskTop(){
		$data	= $this->where(array("is_desktop"=>"1",'menu_id'=>array('in',D("Role")->getMenuID())))->order("order_no asc")->select();
		return $data;
	}
	
	
}