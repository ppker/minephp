<?php
/**
	author: ppker
	date: 2015-07-05
*/
namespace Common\Controller;
class DxFunction {

	function escapeJson($data){
		return str_replace("{", "{ ", json_encode($data));
	}
	
	/**
		获取当前日期
	*/
	function getMySqlNow(){
		return date('Y-m-d H:i:s');
	}

	/**
	 * 权限验证的辅助功能，用于处理Module、Action相同，但是args不同的权限验证。
	 * 此函数只能判断简单的参数信息，复杂的参数无法正确判断，比如：
	 * args	分别为：a=1		a=1&b=2		a=1&b=2&c=3
	 * 则函数在判断到a=1时认为完全匹配，则返回。
	 * */
	function argsInRequest($controller,$request){
		unset($request["_URL_"]);
		if(empty($request)){
			foreach($controller as $action){
				if(empty($action["args"])) return $action["menu_name"];
			}
			return false;
		}
		$defaultName	= "";
		foreach($controller as $action){
			//如果没有找到与参数匹配的action，则使用args为空的action
			if(empty($action["args"])){
				$defaultName = $action["menu_name"];
				continue;
			}
			$args	= explode("&",str_replace("?","",$action["args"]));
			$check	= false;
			foreach($args as $tv){
				$tv	= explode("=",$tv);
				if($request[$tv[0]]==$tv[1]){
					$check	= true;
				}else{
					$check	= false;
				}
			}
			if($check){
				return $action["menu_name"];
			}
		}
		return $defaultName;
	}

	/**
	 * 获取登录账号的权限列表。并缓存之。
	 * 1.所有菜单列表
	 * 2.登录账号有权限访问的菜单列表
	 * 系统会出现，Module、Action相同，但是args不相同的的菜单。
	 * @param	$ignore		是否忽略缓存，在登录时，要强制获取新的权限信息，所以需要忽略之
	 * */
	function getModuleControllerForMe($ignore=false){
		$allController	= S("Cache_module_controller_ALL");
		$menuM	= null;
		if(empty($allController)){
			$menuM = D('Api/Menu');
			//if($menuM instanceof Model) return array();    //如果没有自定义Menu的Model，则表示没有启用此功能。
			$allController = array();
			//获取`menu`的所有数据
			$controller_list = $menuM->getAllController();
			foreach($controller_list as $l){
				if(!empty($l["module_name"]) && !empty($l["controller_name"]))
					$allController[$l["module_name"]][$l["controller_name"]][$l[$menuM->getPk()]]	= array("args"=>$l["args"],"menu_name"=>$l["menu_name"]);
			}


			S("Cache_module_controller_ALL",json_encode($allController));
		}else{
			$allController	= json_decode($allController,true);
			//dump($allController);exit;
		}
		
		//dump($allController);die;
		$my_id = session(C('USER_AUTH_KEY'));

		// dump($my_id);exit;
		if(intval($my_id)<1) return array("allController"=>$allController);
		
		if(!$ignore) $myController = S("Cache_module_controller_".$my_id);
		
		if(!$ignore && !empty($myController)){
			$myController	= json_decode($myController,true);
			return array("allController"=>$allController,"myController"=>$myController);
		}
		
		if(empty($menuM)) $menuM = D('Api/Menu');

		$controller_list  	= $menuM->getMyController();
		
		$myController		= array();
		foreach($controller_list as $l){
			if(!empty($l["module_name"]) && !empty($l["controller_name"]))
				$myController[$l["module_name"]][$l["controller_name"]][$l[$menuM->getPk()]]	= array("args"=>$l["args"],"menu_name"=>$l["menu_name"]);
		}
	
		S("Cache_module_controller_".$my_id,json_encode($myController),3600);
		return array("allController"=>$allController,"myController"=>$myController);
	}


		/**
		 * Enter description here...
		 *
		 * @param unknown_type $string      为需加、解密字符串
		 * @param unknown_type $operation   "DECODE"时解密,"ENCODE"表示加密
		 * @param unknown_type $key         密匙
		 * @param unknown_type $expiry      密文有效期  
		 * @return unknown
		 */
		function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
			//echo $string;exit;
		    // 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙    
		    $ckey_length = 4;
		    // 密匙    
		    //$key = md5($key ? $key : $GLOBALS['discuz_auth_key']);    
		    $key = md5($key ? $key : '8888');
		    //echo $key;exit;
		    //$key = md5($key ? $key : md5($_SERVER['HTTP_USER_AGENT']));
		    // 密匙a会参与加解密    MD5 前16位
		    $keya = md5(substr($key, 0, 16));
		   	
		    // 密匙b会用来做数据完整性验证    MD5 后16位
		    $keyb = md5(substr($key, 16, 16));
		    // 密匙c用于变化生成的密文    
		    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';
		    //dump($keyc);exit;
		    
		    // 参与运算的密匙    
		    $cryptkey = $keya . md5($keya . $keyc);
		    $key_length = strlen($cryptkey);
		    // 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，解密时会通过这个密匙验证数据完整性    
		    // 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确   
		    //echo sprintf('%010d', $expiry ? $expiry + time() : 0);exit;
		    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
			
		    //dump($string);exit;
		    $string_length = strlen($string);
		    $result = '';
		    //0-255 256个数组元素
		    $box = range(0, 255);
		    $rndkey = array();
		    // 产生密匙簿  64位的字符串  余数也有64个
		    for ($i = 0; $i <= 255; $i++) {
		        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
		    }
	// 	    dump($cryptkey);echo '<br />';
	// 	    dump($rndkey);exit;
		    
		    // 用固定的算法，打乱密匙簿，增加随机性，好像很复杂，实际上对并不会增加密文的强度    
		    //有点像洗扑克牌不过这里是  不断的抽2张牌 然后互换位置
		    for ($j = $i = 0; $i < 256; $i++) {
		        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
		        //$box[$i] $box[$j] 互换
		        $tmp = $box[$i];
		        $box[$i] = $box[$j];
		        $box[$j] = $tmp;
		    }
		    // 核心加解密部分    
		    for ($a = $j = $i = 0; $i < $string_length; $i++) {
		        $a = ($a + 1) % 256;
		        $j = ($j + $box[$a]) % 256;
		        //再次洗扑克牌啊 ，抽2张互换位置 放回去
		        $tmp = $box[$a];
		        $box[$a] = $box[$j];
		        $box[$j] = $tmp;
		        // 从密匙簿得出密匙进行异或，再转成字符    
		        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		    }
		    if ($operation == 'DECODE') {
		        // substr($result, 0, 10) == 0 验证数据有效性    
		        // substr($result, 0, 10) - time() > 0 验证数据有效性    
		        // substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16) 验证数据完整性    
		        // 验证数据有效性，请看未加密明文的格式 
		        //0000000000002a910ffae10bb0123456
		    	
		    	
		        if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
		            return substr($result, 26);
		        } else {
		            return '';
		        }
		    } else {
		        // 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因    
		        // 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码    
		        
		    	//dump($keyc . str_replace('=', '', base64_encode($result)));exit;
		        return $keyc . str_replace('=', '', base64_encode($result));
		    }
		}

		//下面函数的一个实际应用，判定action是否为不验证权限action
		function checkNotAuth($no_action,$yes_action=array()){
			return DxFunction::checkInNotArray($no_action,$yes_action,CONTROLLER_NAME,ACTION_NAME);
		}
		/**
		 * 判断是否存放在not数组中，并且未存放在yes数组中。
		 * 用户判定一个数据的设定值。
		 * 1.只要存放在yes数组中，则全部返回 false
		 * 2.仅仅只存放在not数组中才返回true
		 * 3.函数支持2个数组维度
		 * 比如：
		 * 1.判定Action是否允许不验证权限
		 * 2.判定Model是否不进行数据权限验证
		 * @param	$no_array		存放no的数组，
		 * @param	$yes_array		存放yes的数组，
		 * @return					true:确认不验证		false:确认需验证
		 * **/
		function checkInNotArray($no_array,$yes_array=array(),$first="",$secord="")
		{
			//dump($secord);exit;

			if(empty($no_array)) return false;
			//如果整个模块都设置为不需验证。
			//dump($first);exit;
			if(isset($no_array[$first]) && !is_array($no_array[$first])){

				if(!empty($yes_array)){
					return DxFunction::checkYesArray($yes_array);
				}else
					return true;
			}else{
				if(isset($no_array[$first][$secord])){
					if(!empty($yes_array)){
						return DxFunction::checkYesArray($yes_array);
					}else
						return true;
				}else
					return false;
			}
			return false;
		}
		function checkYesArray($yes_array,$first=CONTROLLER_NAME,$secord=MODULE_NAME){
			//如果此模块设置为需强制验证
			//dump($yes_array[$first]);exit;
			if(isset($yes_array[$first]))
				if(is_array($yes_array[$first])){
				//同时 Action 设置强制验证
					if(isset($yes_array[$first][$secord])){
						return false;
					}else
						return true;
				}else
					return false;
			else
				return true;
		}






}
