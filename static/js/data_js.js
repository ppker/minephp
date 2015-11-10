/* 
* @Author: ppker
* @Date:   2015-07-23 07:03:44
* @Last Modified by:   ChangYi
* @Last Modified time: 2015-08-16 17:24:09
*/

var path = "/static/js/plugins/"; // css路径
var path_js = "/static/js/js/"; // js路径
var path_base = "/static/js/"; // 公共js路径
// css
head.load([path+"artDialog5/skins/default.css", path+"sigma_grid/gt_grid.css",
		path+"sigma_grid/skin/default/skinstyle.css",
		path+"sigma_grid/sigma_grid.css",
		// 验证的
		path+"validate/css/validationEngine.jquery.css"

	]);
// js

head.load([path_js+"jquery-1.8.3.min.js", path_js+"selectselectselect.js", path_base+"plugins/artDialog5/source/jquery.artDialog.js",
			path_base+"plugins/artDialog5/source/artDialog.plugins.js",
			// 验证js
			path_base+"plugins/validate/js/jquery.validationEngine.js",
			path_base+"plugins/validate/js/languages/jquery.validationEngine-zh_CN.js",
			path_base+"plugins/validate/js/validate.js",
			// 上传文件js
			path_base+"plugins/jquery-upload-file/blueimp/js/load-image.min.js",
			path_base+"plugins/jquery-upload-file/blueimp/js/tmpl.min.js",
			path_base+"plugins/jquery-upload-file/js/vendor/jquery.ui.widget.js",
			path_base+"plugins/jquery-upload-file/js/jquery.iframe-transport.js",
			path_base+"plugins/jquery-upload-file/js/jquery.fileupload.js",
			path_base+"plugins/jquery-upload-file/js/jquery.fileupload-fp.js",
			path_base+"plugins/jquery-upload-file/js/jquery.fileupload-ui.js",
			

			//path_base+"plugins/sigma_grid/src/gt_grid.js",
			//path_base+"plugins/sigma_grid/gt_msg_cn.js",
			//path_base+"plugins/sigma_grid/gt_grid_all.js",
			//path_base+"plugins/sigma_grid/sigma_custom/fix.toolbar.js",
			//path_base+"plugins/sigma_grid/DataOpe.js", // sigma_grid 封装扩展js
			
			path_js+"dataope_ext.js"

			// 定制js
			
			// 初始化js
			
			],function(){
				//alert('ssss');
				window.PAGE_ACTION && $(window).ready(window.PAGE_ACTION().init());
				
});