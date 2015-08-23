<?php
/**
	author: ppker
	date: 2015-07-05
	+++++++++++++++++++++++++++
	功能描述：
*/
namespace Common\Controller;
use Think\Controller;

class DxExtCommonController extends Controller {
	protected $model = null;
	protected $theModelName = "";

	/**
	 * 过滤的Controller
	 */
	protected $controller_array = array(
			'Public',
			'Index',
			'DataList'
		);
	function __construct(){
		parent::__construct();
		
		if(false == in_array($this->getModelName(), $this->controller_array)){
			//  实例化的东西 全部放到Api 层里面
			if(empty($this->model)) $this->model = D('Api/'.$this->getModelName());
			else $this->theModelName = $this->model->name;
		}

	}

	private $cacheControllerList = array(); //系统Controller缓存

	function _initialize(){
		$log_id = $this->writeControllerLog(); // 先写入日志表中
		if(true !== C("DISABLE_ACTION_AUTH_CHECK")){ // 进行验证
			$this->cacheControllerList	= DxFunction::getModuleControllerForMe(); //用户的所有权限列表菜单
			if (!DxFunction::checkNotAuth(C('NOT_AUTH_ACTION'),C('REQUIST_AUTH_ACTION'))){
				
				
				//dump(session());
				//dump(session(C("USER_AUTH_KEY")));die;

				if(0 == intval(session(C("USER_AUTH_KEY")))) {
					$url = C("LOGIN_URL");
					if($url[0]!="/"){
						//$url = U($url);
						$url = '/Home/'.$url;
					} else $url = '/Home' . $url;
					redirect($url,0,"");
				}
				// 判断用户是否有当前动作操作权限
				$privilege = $this->check_controller_privilege();
				if (!$privilege) {  //无权限
					if($log_id){
						$this->updateActionLog($log_id);
					}
					if(C('LOG_RECORD')) Log::save();
					$this->success("您无权访问此页面!","showmsg");
					exit;
				}


			}
		}

		//自定义皮肤
		if (cookie('RESTHOME_SKIN_ROOT')) {
			$SKIN_ROOT = $_COOKIE['RESTHOME_SKIN_ROOT'];
		} else {
			//这里虽然__PUBLIC__ 是一个字符串 但是加载到模板里面 就会自动解析了
			// 要记得在配置文件里面 定义一下 DEFAULT_SKIN
			$SKIN_ROOT = "__PUBLIC__/project/Skin/".C("DEFAULT_SKIN")."/";
		}
		
		$this->assign('SKIN_ROOT', $SKIN_ROOT);
		
		//将系统变量加载到config中，供系统使用。
		$sysSetData		= S("Cache_Global_SysSeting");

		if(empty($sysSetData)){
			$sysSet		= D("SysSetting");
			$sysSetData	= $sysSet->select();
			S("Cache_Global_SysSeting",$sysSetData);
			//dump(M()->query($sql='show tables'));die;
		}
		//dump($sysSetData);exit;
		//放到系统配置里面了
		foreach($sysSetData as $set){
			C("SysSet.".$set["name"],$set["val"]);
		}
	}

	/**
	 * (判断当前用户是否有这种动作的权限)
	 * @param    (字符串)     (action_name)    (动作)
	 */
	public function check_action_privilege($controller_name = '',$action_name = '') {
		$cacheAction	= $this->cacheActionList;
		if(empty($cacheAction)) return false;	//不通过
		
		$thisModule	= empty($controller_name)?CONTROLLER_NAME:$controller_name;
		$thisAction	= empty($action_name)?ACTION_NAME:$action_name;
		//dump($thisModule);dump($thisAction);exit;
		//dump($cacheAction["myAction"][$thisModule][$thisAction]);dump($cacheAction["allAction"][$thisModule][$thisAction]);
		if(empty($cacheAction["myAction"][$thisModule][$thisAction])){
			if(empty($cacheAction["allAction"][$thisModule][$thisAction])){
				return true;	//未定义的Action，默认都有权限操作
			}else{
				return false;
			}
		}else
			return true;
	}

	protected function getModelName(){
		if(empty($this->theModelName)){
			$this->theModelName = $this->_getControllerName();
		}
		// dump($this->theModelName);die;
		return $this->theModelName;
	}

	/**
		补充TP的方法
	*/
	protected function _getControllerName(){
		if(empty($this->name)) {
		    // 获取Action名称
		    $this->name = substr(get_class($this),0,-10);
		    $this->name = substr($this->name,strrpos($this->name, '\\', 0)+1);
		}
		return $this->name;
	}	

	/**
	 * 将用户操作写入日志表中
	 * 初始操作，无论是否权限验证是否通过，都存储，再权限验证后，更新操作的验证信息。
	 */
	public function writeControllerLog($moduleName="",$ControllerName=""){
		$model = D('OperationLog');
		$model->ip = get_client_ip()."_".$_SERVER["REMOTE_ADDR"];

		$model->controller = empty($controllerName) ? CONTROLLER_NAME : $controllerName;
		
		$model->module = empty($moduleName)?MODULE_NAME:$moduleName;

		$controller_name = $this->cacheControllerList["allController"][$model->module][$model->controller];
		
		if(sizeof($controller_name)>1){
			$controller_name	= argsInRequest($controller_name,$_REQUEST);
			// ==
		}else{
			$controller_name	= array_values($controller_name);
			$controller_name	= $controller_name[0]["menu_name"];
		}

		if(empty($controller_name) || is_array($controller_name)) $model->controller_name	= "";
		else $model->controller_name	= $controller_name;

		$model->account_name  = $_SESSION[C("LOGIN_USER_NICK_NAME")];
		if(!$model->account_name) $model->account_name = "外星用户";
		// dump($model->account_name);die;
		//dump($_SESSION[C("LOGIN_USER_NICK_NAME")]);die;
		$model->account_id  = $_SESSION[C("USER_AUTH_KEY")];
		if(!$model->account_id) return 0;
		$model->over_pri  	= 0;
		unset($_REQUEST['_URL_']);
		unset($_REQUEST["_gt_json"]);
		$model->options = var_export($_REQUEST,true); //保存的是空的数组	
		$log_id =$model->add();	
		// echo $model->getLastSql();exit;	
		return $log_id;
	}
	public function updateActionLog($log_id){
		$model = D('OperationLog');
		$model ->over_pri =1;
		$model->where(array('id'=>$log_id))->save();
	}

	/**
	 * (判断当前用户是否有这种动作的权限)
	 * @param    (字符串)     (controller_name)    (动作)
	 */
	public function check_controller_privilege($module_name = '',$controller_name = '') {
		$cacheController = $this->cacheControllerList;
		if(empty($cacheController)) return false;	//不通过
		
		$thisModule	= empty($module_name)?MODULE_NAME:$module_name;
		$thisController	= empty($controller_name)?CONTROLLER_NAME:$controller_name;
		
		//dump($cacheController);die;

		if(empty($cacheController["myController"][$thisModule][$thisController])){
			if(empty($cacheController["allController"][$thisModule][$thisController])){
				return true;	//未定义的Action，默认都有权限操作
			}else{
				return false;
			}
		}else
			return true;
	}

	/**
	 * [_searchToString 转化搜索条件成url]
	 * @return [type] [description]
	 */
	protected function _searchToString(){
		$s		= array();
		// 清除被污染的数据 Cookie中的数据
		unset($_REQUEST['controller']);
		unset($_REQUEST['p_shigong']);
		unset($_REQUEST['PHPSESSID']);
		unset($_REQUEST['minephp']);
		
		foreach($_REQUEST as $key=>$val){
			$s[]	= $key."=".urldecode($val);
		}

		//dump(implode("&", $s));exit;
		
		return implode("&", $s);
	}


		/**
		 +----------------------------------------------------------
		 * 根据表单生成查询条件
		 * 进行列表过滤
		 +----------------------------------------------------------
		 * @access protected
		 +----------------------------------------------------------
		 * @param string $name 数据对象名称
		 +----------------------------------------------------------
		 * @return HashMap
		 +----------------------------------------------------------
		 * @throws ThinkExecption
		 +----------------------------------------------------------
		 */
		protected function _search($name = '') {
			$model  = $this->model;
			$map    = array ();
			//支持like、大于、小于
	        $dbFields   = array_keys($model->getListFields());
			
			//print_r($dbFields);exit;
			if(APP_DEBUG) \Think\Log::write(var_export($_REQUEST,true).var_export($dbFields,true).MODULE_NAME."|".ACTION_NAME,\Think\Log::INFO);
			//$dbFields	= $model->getDbFields();
			//print_r($_REQUEST);exit;
			
			foreach($_REQUEST as $key=>$val){
				if ($val!=0 && (empty($val) || str_replace("%","",$val)=="")) continue;
				$fieldAdd	= "";
				if( substr($key,0,4)=="egt_" ){
					$key		= substr($key,4);
					$fieldAdd	= "egt";
				}else if( substr($key,0,4)=="elt_" ){
					$key		= substr($key,4);
					$fieldAdd	= "elt";
				}else if( substr($key,0,3)=="gt_" ){
					$key		= substr($key,3);
					$fieldAdd	= "gt";
				}else if( substr($key,0,3)=="lt_" ){
					$key		= substr($key,3);
					$fieldAdd	= "lt";
				}
				
				if (in_array($key,$dbFields,true)) {
					if($fieldAdd == "egt" || $fieldAdd=="elt" || $fieldAdd == "gt" || $fieldAdd=="lt"){
						if(array_key_exists($key, $map))
							$map[$key]	= array($map[$key],array($fieldAdd,$val),"and");
						else $map[$key]	= array($fieldAdd,$val);
					}else if(strtolower(trim($val))=="null"){
						$map[$key] = array("exp","is null");
					}else if($val[0]=="%" || $val[strlen($val)-1]=="%")
						$map[$key] = array("like",$val);
					else
						$map[$key] = $val;
				}
			}
			if(APP_DEBUG) \Think\Log::write(var_export($map,true).MODULE_NAME."|".ACTION_NAME."_Search",\Think\Log::INFO);
			return $map;
		}
















}
