/**
	author: ppker
	date: 2015-07-08
*/
window.PAGE_ACTION = function(){
	"use strict";
	var formInit = null;
	formInit = function(){

		var $info = null,
			$form = null;
		$form = $("#form");
		$form.submit(function(e){
			if(YAN.utils.isPassForm($form)){
				
				YAN.api.accountLogin({
					data: $form.serializeJson(),
					successCallBack: function(result){
						$.messager.model = { 
						        ok:{ text: "关闭", classed: 'btn-primary' }
						       
						};

						$.messager.alert('提示', result.message);
						window.setTimeout(function(){
					   	window.location.href = "/Home/Index";
					   }, YAN.define.dumpTimeout);
					},
					failCallBack: function(result){
						$.messager.alert(result.message);

					}
				});
			}
			e.preventDefault();
		});	
	};
	return {
		init: function(){
			formInit();
		}
	};
};