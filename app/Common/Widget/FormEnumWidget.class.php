<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Common\Widget;
use Common\Widget\DxWidget;
class FormEnumWidget extends DxWidget {
    private $default=array(
        //是否允许显示默认值
        "allowdefault"=>true,
        //默认值
        "default"=>'',
        //当前值,当前值为空时显示
        "value"=>'',
        //显示列表,结构array('v'=>'label')
        "valChange"=>array(),
        "name"=>'', 
        //占位符
        'placeholder'=>'',
        //自定义css类
        'class'=>'',
        //表单验证使用的css类
        'validclass'=>'',
        //自定义css,推荐使用此字段
        'custom_class'=>'',
        'readOnly'=>false,
        //保留
        'label'=>'',
        'width'=>0,
        'height'=>0,
        'cwidth'=>'',
        );
    public function render($data) {
        $val            = array_merge($this->default, $data["fieldSet"], $data);

        //if(empty($val['value']) && $val['allowdefault'] && !$val['readonly']){
        if(empty($val['value']) && !empty($val['default'])){
            $val['value']    = escapeHtmlValue($val['default']);
        }else
            $val['value']    = escapeHtmlValue($val['value']);
        $val['placeholder']  = escapeHtmlValue($val['placeholder']);
        $val["inputType"]    = $val["type"]=="set"?"checkbox":"radio";
        $ret    = $this->renderFile("render", $val);
        return preg_replace('/<!--(.*)-->/Uis', '', $ret);
    }
}

?>
