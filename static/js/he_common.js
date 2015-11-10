/* 
* @Author: ppker
* @Date:   2015-07-14 13:34:13
* @Last Modified by:   ChangYi
* @Last Modified time: 2015-08-23 20:14:57
*/

var path = "/static/js/plugins/"; // css路径
var path_js = "/static/js/js/"; // js路径
var path_base = "/static/js/"; // 公共js路径
// css
head.load([path+"bootstrap/css/bootstrap.min.css", path+"bootstrap/css/bootstrap-responsive.min.css",
		path+"bootstrap/css/bootstrap-fileupload.css",
		path+"font-awesome/css/font-awesome.css",
		"/static/css/style.css",
		"/static/css/style-responsive.css",
		//"/static/css/style-default.css", // 此处可以改变全局颜色
		path+"fullcalendar/fullcalendar/bootstrap-fullcalendar.css",
		path+"jquery-easy-pie-chart/jquery.easy-pie-chart.css"

	]);
// js

head.load([path_base+"nameSpace.js", path_js+"jquery-1.8.3.min.js", path_base+"plugins/jquery/jquery.extend.js", 
			path_base+"plugins/jquery/jquery.widget.min.js",
			path_base+"plugins/bootstrap-typeahead/bootstrap3-typeahead.js",
			path_base+"plugins/bootstrap/js/bootstrap.min.js",
			path_base+"plugins/bootstrap/js/jquery.bootstrap.min.js",
			path_base+"plugins/bootstrap/js/validator.js",
			//path_base+"plugins/FlatUI/js/bootstrap-switch.js",
			path_base+"plugins/data-tables/media/js/jquery.dataTables.js",
			path_base+"plugins/handlebars/handlebars-v1.3.0.js",
			path_base+"plugins/handlebars/extend.js",
			path_base+"plugins/md5/md5.min.js",
			//path_base+"plugins/jstree/jstree.js",
			//path_base+"plugins/jstree/jstree.wholerow.js",
			//path_base+"plugins/jstree/jstree.contextmenu.js",
			//path_base+"plugins/jstree/jstree.types.js",
			//path_base+"plugins/jstree/jstree.checkbox.js",
			path_base+"plugins/bootstrap-datetimepicker/build/js/moment.js",
			path_base+"plugins/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js",
			path_base+"plugins/bootstrap-datetimepicker/src/js/locales/bootstrap-datetimepicker.zh-CN.js",
			// ext js
			path_js+"jquery.nicescroll.js",
			path_base+"plugins/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js",
			path_base+"plugins/jquery-slimscroll/jquery.slimscroll.min.js",
			path_base+"plugins/fullcalendar/fullcalendar/fullcalendar.min.js",
			path_base+"plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js",
			path_js+"jquery.sparkline.js",
			path_base+"plugins/chart-master/Chart.js",
			path_js+"jquery.scrollTo.min.js",
			path_js+"common-scripts.js",
			path_js+"easy-pie-chart.js",
			path_js+"sparkline-chart.js",
			path_js+"home-page-calender.js",
			path_js+"home-chartjs.js",
			// base js
			path_base+"msg.js",
			path_base+"utils.js",
			path_base+"api.js",
			path_base+"define.js",
			path_base+"loading.js",
			path_base+"prompt.js"
			//
			// 定制js
			
			// 初始化js
			
			],function(){

});
