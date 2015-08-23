<?php
/**
	author: ppker;
	date: 2015-07-09
*/

/**
 * 全局获取验证码图片
 * 生成的是个HTML的img标签
 * @param string $imgparam <br>
 * 生成图片样式，可以设置<br>
 * length=4&font_size=20&width=238&height=50&use_curve=1&use_noise=1<br>
 * length:字符长度<br>
 * font_size:字体大小<br>
 * width:生成图片宽度<br>
 * heigh:生成图片高度<br>
 * use_curve:是否画混淆曲线  1:画，0:不画<br>
 * use_noise:是否添加杂点 1:添加，0:不添加<br>
 * @param string $imgattrs<br>
 * img标签原生属性，除src,onclick之外都可以设置<br>
 * 默认值：style="cursor: pointer;" title="点击获取"<br>
 * @return string<br>
 * 原生html的img标签<br>
 * 注，此函数仅生成img标签，应该配合在表单加入name=verify的input标签<br>
 * 如：&lt;input type="text" name="verify"/&gt;<br>
 */
function sp_verifycode_img($imgparam='length=4&font_size=20&width=238&height=50&use_curve=1&use_noise=1',$imgattrs='style="cursor: pointer;" title="点击获取"'){
	$src=U('Api/Checkcode/index',$imgparam);
	$src = substr($src, 0, -5);
	$img=<<<hello
<img class="verify_img" src="$src" onclick="this.src='$src&time='+Math.random();" $imgattrs/>
hello;
	return $img;
}

/**
	ajax格式化
*/
function to_ajax($success, $message, $data = array()){
	return array(
			'success' => $success,
			'message' => $message,
			'data' => $data
		);
}

// 根据浏览器类型决定文件名转换成什么编码，，，ie只能用gbk编码的文件名，firefox支持utf8
function get_filename_bybrowser($filename){
	$my_broswer=$_SERVER['HTTP_USER_AGENT'];
	if(!preg_match("/Firefo|Chrome|Opera|Safari/", $my_broswer)){
		$filename = urlencode($filename);
		$filename = str_replace("+", "%20", $filename);
//		$filename=iconv('utf-8', 'gbk', $filename);//防止文件名存储时乱码
	}else{
		$filename=  sprintf("\"%s\"", $filename);
	}
	return $filename;
}


/**
 * 根据字段定义生成字段的修改输入框，for  data_edit.html
 * 1.因为诸如，责任护理员等，每个用户不同内容的字典表存在，所以并不适合直接将file_enum输出成值。。公共字典变动等情况也影响这个功能。。所以，还是将字典表，输出为变量
 * */
 function getFieldInput($field,$valid=array(),$field_content=false,$ignoreEditor=false){
	$field_name	= $field["name"];
	if($field_content===false) $field_content	= "\$objectData['".$field_name."']";
	if($ignoreEditor || empty($field["editor"])){
		switch($field["type"]){
			case "password":
				$fieldInput = sprintf("<input name='%s' type='password' value='' style='width:%spx' class=\"itemAddInput %s\" />",$field_name,$field["width"],$valid[$field_name]);
				$fieldInput .= sprintf("<input name='%s' value=\"{\$objectData.%s|htmlentities=###,ENT_QUOTES,'UTF-8'}\" type='hidden' />",$field_name,$field_name);
				break;
			case "enum":
                $fieldInput = sprintf('{:W_FIELD("FormEnum", array("name"=>"%1$s","allowdefault"=>empty($pkId[1]),"validclass"=>$valid["%1$s"],"custom_class"=>"itemAddRadio","value"=>$objectData["%1$s"],"fieldSet"=>$listFields["%1$s"]))}', $field_name);
                break;
			case "set":
                $fieldInput = sprintf('{:W_FIELD("FormCheck", array("name"=>"%1$s","allowdefault"=>empty($pkId[1]),"validclass"=>$valid["%1$s"],"custom_class"=>"itemAddRadio","value"=>$objectData["%1$s"],"fieldSet"=>$listFields["%1$s"]))}', $field_name);
				break;
			case "select":
                $fieldInput = sprintf('{:W_FIELD("FormSelect", array("name"=>"%1$s", "allowdefault"=>empty($pkId[1]), "validclass"=>$valid["%1$s"], "custom_class"=>"itemAddSelect", "value"=>$objectData["%1$s"], "fieldSet"=>$listFields["%1$s"]))}', $field_name);
				break;
			case 'date':
			    $dateFormat    = "yyyy-MM-dd";
			    $fieldInput = sprintf('{:W_FIELD("Date", array("name"=>"%1$s", "fieldSet"=>$listFields["%1$s"], format=>"%2$s", "allowdefault"=>empty($pkId[1]),"validclass"=>$valid["%1$s"],"value"=>$objectData["%1$s"]))}', $field_name,$dateFormat);
			    break;
			case 'y_m':
			    $dateFormat    = "yyyy-MM";
			    $fieldInput = sprintf('{:W_FIELD("Date", array("name"=>"%1$s", "fieldSet"=>$listFields["%1$s"], format=>"%2$s", "allowdefault"=>empty($pkId[1]),"validclass"=>$valid["%1$s"],"value"=>$objectData["%1$s"]))}', $field_name,$dateFormat);
			    break;
			case 'time':
			    $dateFormat    = "HH:mm:ss";
			    $fieldInput = sprintf('{:W_FIELD("Date", array("name"=>"%1$s", "fieldSet"=>$listFields["%1$s"], format=>"%2$s", "allowdefault"=>empty($pkId[1]),"validclass"=>$valid["%1$s"],"value"=>$objectData["%1$s"]))}', $field_name,$dateFormat);
				break;
			case 'datetime':
			    $dateFormat    = "yyyy-MM-dd HH:mm:ss";    //itemAddDateTime
			    $fieldInput = sprintf('{:W_FIELD("Date", array("name"=>"%1$s", "fieldSet"=>$listFields["%1$s"], format=>"%2$s", "allowdefault"=>empty($pkId[1]),"validclass"=>$valid["%1$s"],"value"=>$objectData["%1$s"]))}', $field_name,$dateFormat);
				break;
			case "canton":
				$fieldInput = sprintf('{:W_FIELD("Canton", array("name"=>"%1$s", "fieldSet"=>$listFields["%1$s"], "validclass"=>$valid["%1$s"], "value"=>$objectData["%1$s"]))}', $field_name);
				break;
			case "uploadFile":
                $fieldInput = sprintf('{:W_FIELD("UploadFile", array("name"=>"%1$s", "fieldSet"=>$listFields["%1$s"], "validclass"=>$valid["%1$s"], "value"=>$objectData["%1$s"]))}', $field_name);
				break;
			case "cutPhoto":
				$fieldInput = sprintf('{:W_FIELD("CutPhoto", array("name"=>"%1$s", "fieldSet"=>$listFields["%1$s"], "allowdefault"=>empty($pkId[1]), "validclass"=>$valid["%1$s"], "value"=>$objectData["%1$s"]))}', $field_name);
				break;
			case 'string':
			default:
                $fieldInput = sprintf('{:W_FIELD("String", array("name"=>"%1$s", "fieldSet"=>$listFields["%1$s"],"allowdefault"=>empty($pkId[1]), "validclass"=>$valid["%1$s"], "custom_class"=>"itemAddText", "value"=>$objectData["%1$s"]))}', $field_name);
				break;
		}
	}else{
		$fieldInput = $field["editor"];
	}
	$req	= strpos($valid[$field_name], 'required')===false?'':'<span class="field_required">*</span>';
	return $fieldInput.$req;
}
// 为了将所有的字段widget放到同一个目录下方便引入。。增加此函数
function W_FIELD($name, $data=array(), $return=false) {
	$class = $name . 'Widget'; // StringWidget
	// 还是放到Common/Widget 里面吧 注释掉下一行
	//require_cache(dirname(__FILE__). '/../Controller/' . $class . '.class.php');
	$new_class = 'Common\Widget\\'.$class;
	$widget = new $new_class;
	if (!class_exists($new_class))
		throw_exception(L('_CLASS_NOT_EXIST_') . ':' . $class);
	$content = $widget->render($data);
	
	if ($return)
		return $content;
	else
		echo $content;
}

/**
 * 此方法用于过滤html属性值.
 * @param String $val 需要过滤的的值
 * @return String 处理过的文本内容.
 */
function escapeHtmlValue($val){
    $val    = htmlentities($val, ENT_QUOTES,"UTF-8");
    return $val;
}

function escapeJson($data){
	$ret=str_replace("{","{ ", json_encode($data));
	return $ret;
}