var dxGrid  = null;
$(function(){
	
	try{
		dxGrid	= new $.dxGrid();
		var gridFields        = {$gridFields};
    //colsOption
		var datasetFields     = {$datasetFields};
    //dsOption fields
		dxGrid.init({ "gridDiv":"dataList",",loadUrl":"","gridFields":gridFields,"datasetFields":datasetFields,"parentGridDiv":"dataListCon","enablePage":"{$modelInfo['enablePage']}","enableExport":"{$modelInfo['enableExport']}","enablePrint":"{$modelInfo['enablePrint']}"});
		dxGrid.setBaseURL("__URL__");
		dxGrid.setData(dxGrid.urladd("__URL__/get_datalist","{\\$InitSearchPara}"));
		<notempty name="ignoreInitSearch">
		dxGrid.setOrginURL("__URL__/get_datalist");
		</notempty>
		dxGrid.showGrid(['header_title','data_add','query_items','grid-help-info','Copyright',<?php echo intval(C("DATAOPE_LIST_HEIGHT"));?>]);
	}catch(e){
		//
	}
	
});