<?php
// +----------------------------------------------------------------------
// | MinePHP  version:1.0
// +----------------------------------------------------------------------
// | date: 2015-6-15
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: ppker <yanzhipeng@vchangyi.com>
// +----------------------------------------------------------------------
/**
 * 项目入口文件
 */
//检测环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
if (ini_get('magic_quotes_gpc')) {
	function stripslashesRecursive(array $array){
		foreach ($array as $k => $v) {
			if(is_string($v)){
				$array[$k] = stripslashes($v);
			}else if (is_array($v)){
				$array[$k] = stripslashesRecursive($v);
			}
		}
		return $array;
	}
	$_GET = stripslashesRecursive($_GET);
	$_POST = stripslashesRecursive($_POST);
}
//开启调试
define("APP_DEBUG", true);
//设置TP的SESSION
session_name('minephp');
//Web当前路径
define("SITE_PATH", dirname(__FILE__)."/");
//项目路径
define("APP_PATH", SITE_PATH . "app/");
//核心框架路径
define("CENTER_PATH", SITE_PATH . "ppker/");
//缓存路径
define("RUNTIME_PATH", SITE_PATH . "data/runtime/");
//静态缓存目录
define("HTML_PATH", SITE_PATH . "data/runtime/Html/");
//DxInfo基类扩展
define("DXINFO_PATH", SITE_PATH . "DxInfo/");
//版本号
define("MinePHP", "P1.0.0");
//静态资源
define("STATIC", SITE_PATH . "static/");
//载入核心文件
require CENTER_PATH . "Core/Thinkphp.php";