<?php
/**
	author: ppker
	date: 2015-07-05
*/
namespace Api\Model;
use Common\Model\DxAccountModel;
class AccountModel extends DxAccountModel {
	public $listFields=array(
		"account_id"=>array('type'=>'int','size'=>10,'title'=>'操作','width'=>280,'pk'=>true,'hide'=>22,
		"renderer"=>"var valChange=function valChangeCCCC(value,record,columnObj,grid,colNo,rowNo){
						var v= '<a href=\"javascript:dataOpeEdit(' + value + ');\" class=\"btn btn-xs btn-success\">修改</a>';
						 v += ' <a href=\"javascript:dataOpeDelete(' + value + ');\" class=\"btn btn-xs btn-danger\">删除</a>';
						 v += ' <a href=\"javascript:resetPasswd('+value+');\" class=\"btn btn-xs btn-success\">重置密码</a>';
						 return v;
					 }" ),
		"username"=>array('type'=>'varchar','size'=>100,'title'=>'登录名','width'=>80),
		"pwd"     =>array('type'=>'varchar','size'=>100,'title'=>'登陆密码','type'=>'password','hide'=>29,
						  'editor'=>' <input type="password" id="pwd" name="pwd" style="width:140px"
						   class="itemAddInput validate[required,minSize[6],maxSize[15]]" /><span class="field_required">*</span></td></tr>
						   <tr class="itemAddTr">
						   <td align="right" class="itemAddTr"><span class="itemAddField"><b>确认密码</b></span>:</td>
						   <td><input type="password" id="check_pwd" name="check_pwd" style="width:140px"
							class="itemAddInput validate[required,minSize[6],maxSize[15],equals[pwd]]" />',
						 ),
		"real_name"=>array('type'=>'varchar','size'=>45,'width'=>80,'title'=>'真实姓名'),
			"tel"  =>array('type'=>'varchar','size'=>12,'width'=>90,'title'=>'联系电话'),
			"email"=>array('type'=>'varchar','size'=>60,'width'=>160,'title'=>'EMail'),
		  "address"=>array('type'=>'varchar','size'=>60,'width'=>120,'title'=>'家庭地址'),
		  "sort"   =>array('type'=>'varcahr','size'=>12,'width'=>50,'title'=>'排序','hide'=>1),
		 "role_id" =>array('type'=>'int','size'=>10,'title'=>'角色','type'=>'select','valChange'=>array('model'=>'Role'),'width'=>80),
		 "dept_id" =>array('type'=>'int','size'=>10,'title'=>'部门ID','hide'=>7),
		 "canton_id"=>array('type'=>'int','size'=>10,'title'=>'所在区域','width'=>3000,'hide'=>7),
		"canton_fdn"=>array('title'=>'所在部门',"type"=>"canton","valChange"=>array("model"=>"Canton"),"width"=>250,'frozen'=>true,
		'editor'=>' <div id="selectCanton"></div>
			<input type="hidden" id="canton_fdn" name="canton_fdn" class="dataOpeSearch likeRight" value="{$objectData.canton_fdn}" />
			<script type="text/javascript">
				$(function(){
					var canton_fdn = $("#canton_fdn").val();
					$.get("/Api/Canton/getSelectSelectSelectAll/",function(data){
						$.selectselectselect(data,"selectCanton",canton_fdn,"0",function(t){
							$("#canton_fdn").val($(t).val());
							$("#selectCanton").find("select").attr("style","width:150px");
							
						});
					},"json");
				});
			</script>',
	  ),
	  "create_id"=>array('type'=>'int','size'=>10,'title'=>'创建人','hide'=>7),
	  "create_time"=>array('type'=>'timestamp','title'=>'创建时间','hide'=>7), 
	);
		
	protected $_validate=array(
			array('username','','抱歉，账号名称已经存在!',self::MUST_VALIDATE,'unique'),
			array("real_name","2,15","抱歉，姓名应大于2个字符且小于15个字符!",self::MUST_VALIDATE,'length'),
			array("pwd","require","密码不能为空!",self::EXISTS_VALIDATE,'',self::MODEL_INSERT),
			array('canton_fdn','2,30','<font size=3 color="red"><b>抱歉，请选择所属工区</b></font>',self::MUST_VALIDATE,'length')
		);
	protected $modelInfo=array(
			"title"=>'系统账号',
			'readOnly'=>false,
			"helpInfo"=>"1.删除账号并不影响机构信息<br />2.请根据角色进行合理的分配用户账户。",
			'searchHTML'=>true
	);
}