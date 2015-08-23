<?php
namespace Common\Widget;
use Think\Controller;
class DxWidget extends Controller {

	// 使用的模板引擎 每个Widget可以单独配置不受系统影响
	protected $template =  '';
	/**
	 * 渲染模板输出 供render方法内部调用
	 * @access public
	 * @param string $templateFile  模板文件
	 * @param mixed $var  模板变量
	 * @return string
	 */
	protected function renderFile($templateFile='',$var='') {
	    ob_start();
	    ob_implicit_flush(0); // 关闭绝对刷送
	    if(!file_exists_case($templateFile)){

	        // dump($templateFile);die;
	        // 自动定位模板文件
	        $name   = substr(get_class($this),13,-6); //Common\Widget\String

	        $filename   =  empty($templateFile)?$name:$templateFile;
	        // $templateFile = BASE_LIB_PATH.'Widget/'.$name.'/'.$filename.C('TMPL_TEMPLATE_SUFFIX');
	        $templateFile = dirname(__FILE__).$name.'/'.$filename.C('TMPL_TEMPLATE_SUFFIX');
	        if(!file_exists_case($templateFile))
	            throw_exception(L('_TEMPLATE_NOT_EXIST_').'['.$templateFile.']');
	    }
	    $template   =  strtolower($this->template?$this->template:(C('TMPL_ENGINE_TYPE')?C('TMPL_ENGINE_TYPE'):'php'));
	    
	    if('php' == $template) {
	        // 使用PHP模板
	        if(!empty($var)) extract($var, EXTR_OVERWRITE);
	        // 直接载入PHP模板
	        include $templateFile;
	    }elseif('think'==$template){ // 采用Think模板引擎
	        if($this->checkCache($templateFile)) { // 缓存有效
	            // 分解变量并载入模板缓存
	            extract($var, EXTR_OVERWRITE);
	            //载入模版缓存文件
	            include C('CACHE_PATH').md5($templateFile).C('TMPL_CACHFILE_SUFFIX');
	        }else{
	            //$tpl = \Think\Think::instance('Template');  // 此方法不行得 换一下方法
	            $tpl = new \Think\Template;
	            // 编译并加载模板文件
	            $tpl->fetch($templateFile,$var);
	        }
	    }else{
	        $class   = 'Template'.ucwords($template);
	        if(is_file(CORE_PATH.'Driver/Template/'.$class.'.class.php')) {
	            // 内置驱动
	            $path = CORE_PATH;
	        }else{ // 扩展驱动
	            $path = EXTEND_PATH;
	        }
	        require_cache($path.'Driver/Template/'.$class.'.class.php');
	        $tpl   =  new $class;
	        $tpl->fetch($templateFile,$var);
	    }
	    $content = ob_get_clean();

	  /*  echo "<pre>";
	    var_dump($content);
	    echo "</pre>";die;*/
	    return str_replace("__DXPUBLIC__", C("DX_PUBLIC"), $content);
	    //return $content;
	}

	/**
	 * 检查缓存文件是否有效
	 * 如果无效则需要重新编译
	 * @access public
	 * @param string $tmplTemplateFile  模板文件名
	 * @return boolen
	 */
	protected function checkCache($tmplTemplateFile) {
	    if (!C('TMPL_CACHE_ON')) // 优先对配置设定检测
	        return false;
	    $tmplCacheFile = C('CACHE_PATH').md5($tmplTemplateFile).C('TMPL_CACHFILE_SUFFIX');
	    if(!is_file($tmplCacheFile)){
	        return false;
	    }elseif (filemtime($tmplTemplateFile) > filemtime($tmplCacheFile)) {
	        // 模板文件如果有更新则缓存需要更新
	        return false;
	    }elseif (C('TMPL_CACHE_TIME') != 0 && time() > filemtime($tmplCacheFile)+C('TMPL_CACHE_TIME')) {
	        // 缓存是否在有效期
	        return false;
	    }
	    // 缓存有效
	    return true;
	}
}