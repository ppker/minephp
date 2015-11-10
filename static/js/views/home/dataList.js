/**
	author: ppker
	date: 2015-07-23
*/
window.dxGrid = $.dxGrid;
window.PAGE_ACTION = function(){
	"use strict";
	var getList = null;
	getList = function(){
		YAN.api.getList({
		    data:{controller:controller},
		    successCallBack: function(result){
		    	var dxGrid = null;
		    	if(result.data.modelInfo.hasOwnProperty('enablePrint')){
		    		var html_js = '<script language="javascript" src="/static/js/plugins/Lodop6.010/LodopFuncs.js"></script>' +
								'<object id="LODOP_OB" classid="clsid:2105C259-1E0C-4534-8141-A753534CB4CA" width=0 height=0 style="display:none">' + 
								'<embed id="LODOP_EM" type="application/x-print-lodop" width=0 height=0 pluginspage="install_lodop32.exe"></embed></object> ';
		    		$(".js_sign").after(html_js);
		    	}

		    	if(result.data.modelInfo.hasOwnProperty('leftArea')){
		    		$(".dataListLeftMenuArea").html(result.data.modelInfo.leftArea);
		    	}

		    	if(result.data.modelInfo.hasOwnProperty('editTitle')){
		    		$("#modelInfo_editTitle").val(result.data.modelInfo.editTitle);
		    	}

		    	if(result.data.modelInfo.hasOwnProperty('gridHeader')){
		    		$("#gridHeader").html(result.data.modelInfo.gridHeader);
		    	}

		    	if(result.data.modelInfo.hasOwnProperty('modelTitle')){
		    		$("#header_title").find("span").html(result.data.modelInfo.modelTitle);
		    	}

		    	if(!result.data.modelInfo.hasOwnProperty('searchHTML')){
		    		$("#data_list_search").remove();
		    	}

		    	if(result.data.modelInfo.hasOwnProperty('readOnly')){
		    		$("#query_items").after("<input class=\"btn btn-success btn-sm\" id='item_add' onclick=\"javascript:dataOpeAdd('" + result.data.InitSearchPara + "','" + result.data.modelInfo.addTitle + "');\" type='button' value='" + result.data.modelInfo.addTitle +"' />");
		    	}

		    	if(result.data.modelInfo.hasOwnProperty('enableImport')){
		    		$(".y_import").before("<form method=\"post\" style=\"display:inline;\" action=\"__URL__/importFromExcel\" enctype=\"multipart/form-data\"><input  type=\"file\" name=\"file_stu\" /><input type=\"submit\"  value=\"导入Excel表\" /></form>");
		    	}

		    	if(result.data.modelInfo.hasOwnProperty('otherManageAction')){
		    		$(".y_import").before(result.data.modelInfo.otherManageAction);
		    	}

		    	if(result.data.modelInfo.hasOwnProperty('helpInfo')){
		    		$("#grid-help-info").text(result.data.modelInfo.helpInfo);
		    	}
		    	try{
		    		//dxGrid = new $.dxGrid;
		    		dxGrid = new window.dxGrid;
		    		var gridFields = result.data.gridFields,
		    			datasetFields = result.data.datasetFields;
		    		dxGrid.init({ "gridDiv":"dataList",",loadUrl":"","gridFields":gridFields,"datasetFields":datasetFields,"parentGridDiv":"dataListCon","enablePage":result.data.modelInfo.enablePage,"enableExport":result.data.modelInfo.enableExport,"enablePrint":result.data.modelInfo.enablePrint});
		    		dxGrid.setBaseURL(Y_URL);
		    		dxGrid.setData(dxGrid.urladd(Y_URL+'/get_datalist',result.data.InitSearchPara));
		    		if(result.data.hasOwnProperty('ignoreInitSearch')){
		    			dxGrid.setOrginURL(Y_URL + "/get_datalist");	
		    		}
		    		dxGrid.showGrid(['header_title','data_add','query_items','grid-help-info','Copyright', 100]); // 后面可以再增加一个参数 是整个sigma表格距离底部的高度 给一个int类型的数字即可
					window.new_dxGrid = dxGrid;		    	
		    	}catch(e){

		    	}

		        $.messager.alert(result.message);
		        //YAN.utils.dumpReload();
		    },
		    failCallBack: YAN.utils.failCallBack
		});		


	};
	return {
		init: function(){
			getList();
			//window.dxGrid = null;
		}
	};
};