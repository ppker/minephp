<?php

/**
 * 显示表单select控件
 *
 * @author zhangyud
 */
namespace Common\Widget;
use Common\Widget\DxWidget;
class FormSelectWidget extends DxWidget {
    private $default=array(
        //是否允许显示默认值
        "allowdefault"=>false,
        //默认值
        "default"=>'', 
        "value"=>'',
        "valChange"=>array(),
        "name"=>'', 
        'placeholder'=>'请选择',
        //是否显示为多选
        "multiple"=>false,
        //class
        'class'=>'',
        'validclass'=>'',
        'custom_class'=>'',
        'readOnly'=>false,
        //保留
        'label'=>'',
        'width'=>0,
        'height'=>0,
        'cwidth'=>'',
        );
    public function render($data) {
        $val=  array_merge($this->default, $data["fieldSet"], $data);
        $val['id']=  uniqid($val['name']."_");
        $val['value']=  htmlentities($val['value'],ENT_QUOTES,"UTF-8");
        if(empty($val['value']) && $val['allowdefault'] && !$val['readonly']){
            $val['value']=  htmlentities($val['default'],ENT_QUOTES,"UTF-8");
        }
        $val['placeholder']=  htmlentities($val['placeholder'],ENT_QUOTES,"UTF-8");
        if($val['multiple']){
            $val['val']		= $val['value']===''?array():explode(",", $val['value']);
            $val['size']	= count($val['valChange']);
            if($val['size']>5) $val['size'] = 5;
            $ret=$this->renderFile("multi", $val);
        }else{
            $ret=$this->renderFile("render", $val);
        }
        return preg_replace('/<!--(.*)-->/Uis', '', $ret);
    }
}

?>
