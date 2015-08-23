<?php
namespace Api\Model;
use Common\Model\DxRoleModel;
class RoleModel extends DxRoleModel{
	public $listFields = array(
		'role_id'=>array("width"=>150,"title"=>"操作",'hide'=>22,'renderer'	=> "var valChange=function valChangeCCCC(value ,record,columnObj,grid,colNo,rowNo){
									var v	= '<a href=\"javascript:dataOpeRoleEdit(' + value + ');\">修改</a>';
									return v;
								}"), 
		'name'=>array("width"=>150,"title"=>"角色名称")
	);
	
	
	protected $_validate = array(
    	array('name','','帐号名称已经存在！',0,'unique',2) // 在新增的时候验证name字段是否唯一
	); 
	  
	
	protected $modelInfo = array(              
			"title"=>'用户角色', 
			'readOnly'=>true,
			"dictTable"=>"name",
			"helpInfo"=>"用户角色由系统初始化，无法进行增删!",
			"order"=>"`order` asc"
	);
	
}