<?php
namespace Api\Model;
use Common\Model\DxExtCommonModel;
class CantonModel extends DxExtCommonModel {

	protected $listFields = array (
		);
	
	protected $modelInfo=array(
			"title"=>'行政区域','readOnly'=>true,
			"dictTable"=>array("fdn","text_name"),
		);
	/**
	 * 根据区域的fdn得到区域的中文显示，如郑州市|金水区|庙里社区
	*/
	function get_cn_from_cantonfdn($fdn){
		if(empty($fdn)){
			return '';
		} else{
			$list = $this->where(array('fdn' => array('eq', $fdn)))->field('text_name')->find();
			if (!empty($list)) {
				return $list['text_name'];
			}
			$canton_cn='';
			$fdn=preg_replace("/.$/",'',$fdn);//把最后一个。去掉
			$fdn_arr=explode('.',$fdn);
			if($fdn_arr){
				foreach($fdn_arr as $key){
					$cantonif=$this->get_canton($key,'name');
					$cantonname=$cantonif['name'];
					$canton_cn.="$cantonname|";
				}
			}
			return $canton_cn;
		}
		 
	}
	/**
	 * 从区域id得到区域的中文
	 * @param unknown_type $id
	 * @return unknown
	 */
	function get_canton($id,$field="")
	{
		$arr = $this->where(array('id'=>$id))->field($field)->find();
		return $arr;
	}
	/**
	 * 得到下级区域，用于树形展示
	 */
	function getsubcanton($pid) {
		$m = $this;
		$cond = array ("parent_id" => $pid );
		$ret = $m->where ( $cond )->order ( 'ordernum asc' )->field ( 'id,name,parent_id' )->select ();
		if($ret){
			return $ret;
		}
		else{
			return false;
		}
	
	}
	/**
	 * 得到区域的根节点，如果当前登录人有区域显示登录人的区域，如果没有取得配置参数中的平台所在根节点
	 */
	function getCantonid(){
		//dump(session('canton_id'));exit;
		if(session('canton_id')){
			return session('canton_id');
		}
		else{
			return C('SYS_ROOTCANTONID');
		}
	}
	/**
	 * 添加新区域，要把区域的fdn，区域的对应中文写入数据库，及上级区域的id
	 * @param $cantoninfo  数组，要新增的区域的信息
	 * @return $ret 数组，新增成功 $ret['result']=1,失败 $ret['result']=0 ，区域已存在 $ret['result']=3
	 */
	function add_newcanton($cantoninfo){
		//先判断区域是否存在
		$ret=array();
		$exist=$this->where(array('parent_id'=>$cantoninfo['parent_id'],'name'=>$cantoninfo['name']))->find();
		if($exist){
			$ret['result']=3;
		}else{
			//得到父类的fdn备用
			$parentinfo=$this->where(array('id'=>$cantoninfo['parent_id']))->field("fdn,layer")->find();
			$parent_fdn=$parentinfo['fdn'];
			if ($parentinfo['layer']) {
				$layer = $parentinfo['layer'] + 1;
			} else {
				$layer = 1;
			}
			$count=$this->where(array('parent_id'=>$cantoninfo['parent_id']))->count();
			$data=array();
			$data ['name'] = $cantoninfo['name'];
			$data ['ordernum'] = $count + 1;
			$data ['parent_id'] = $cantoninfo['parent_id'];
			$data ['layer'] = $layer;
			$data ['is_del'] = '1';
			$data ['is_gongqu'] = $cantoninfo['is_gongqu'];
			$data['create_id']=session(C('USER_AUTH_KEY'));
			$data['sortby'] = $cantoninfo['sortby'];
			$id = $this->data ( $data )->add ();
			if($id){
				//新区域的fdn
				$newfdn=$parent_fdn.$id.'.';
				$new_canton_cn=$this->get_cn_from_cantonfdn($newfdn);
				$data=array();
				$data ['fdn'] = $newfdn;
				$data ['text_name'] = $new_canton_cn;
				$data['canton_uniqueno']=$id;
				$this->where(array('id'=>$id))->data ( $data )->save ();
				$ret['result']=1;
				$ret['id']=$id;
			}
			else{
				$ret['result']=0;
			}
	
		}
		return $ret;
	}
	/**
	 * 修改区域，要把区域的fdn，区域的对应中文写入数据库，及上级区域的id
	 * @param $cantoninfo  数组，要新增的区域的信息
	 * @return $ret 数组，修改成功 $ret['result']=1,失败 $ret['result']=0 ，区域已存在 $ret['result']=3
	 */
	function edit_canton($id,$cantoninfo){
		//先判断区域是否存在
		$ret=array();
		$exist=$this->where(array('parent_id'=>$cantoninfo['parent_id'],'name'=>$cantoninfo['name'],'id'=>array('neq',$id)))->find();
		if($exist){
			$ret['result']=3;
		}else{
			//得到父类的fdn备用
			if($id){
				$data=array();
				$data ['name'] = $cantoninfo['name'];
				$data ['is_gongqu'] = $cantoninfo['is_gongqu'];
				$data ['sortby'] = $cantoninfo['sortby'];
				$this->where(array('id'=>$id))->data ( $data )->save ();
				$thiscanton=$this->where(array('id'=>$id))->find();
				//新区域的fdn
				$newfdn=$thiscanton['fdn'];
				$new_canton_cn=$this->get_cn_from_cantonfdn($newfdn);
				$data=array();
				$data ['text_name'] = $new_canton_cn;
				$this->where(array('id'=>$id))->data ( $data )->save ();
				$ret['result']=1;
			}
			else{
				$ret['result']=0;
			}
	
		}
		return $ret;
	}
	/**
	 * 删除区域
	 * @param id 区域id
	 * @return 0失败1 成功 2 不允许删除
	 */
	function delete_canton($id){
		if(empty($id)){
			return 0;
		}
		$flag=0;
		//有下级区域时把下级区域全部删除
		$info = $this->where (array('id'=>$id))->find ();
		$fdn = $info['fdn'];
		$is_del=$info['is_del'];
		if($is_del){
			$rs = $this->where(array('fdn'=>array("like",$fdn."%")))->delete();
			if($rs)
			{
				$flag = 1;
			}
			else{
				$flag=0;
			}
		}
		else{
			$flag=2;
		}
		return $flag;
	}
	/**
	 * 判断当前登陆部门是否有下级部门，有返回下级，没有返回false
	 * @param unknown_type $account_id
	 */
	public function getNextInfo($canton_id=false)
	{
		if(empty($canton_id))
		{
			$canton_id = session('canton_id');
		}
		$rs =  $this->where(array('parent_id'=>$canton_id))->find();
		if($rs){
			return $rs;
		}
		else{
			return false;
		}
	}



}