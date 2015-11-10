/**
 * [JS全局定义]
 * @param  {[type]} MAIN [description]
 * @return {[type]}      [description]
 * date: 2015-06-15
 * version: 1.0
 */
(function(MAIN){
	'use strict';
	var self = MAIN.nameSpace.reg("define");

	self.imgServer = '';//图片地址
	self.isAjaxLock = false;
	self.loadingImg = "/static/images/loading.gif";
	self.dumpTimeout = 1000;
	self.pageSize = 50;
	self.indexNoticeReceiveSize = 5;
	self.indexTaskReceiveSize = 5;
	self.indexWorkReportSize = 5;
	self.indexPunctualSize = 5;

	self.mapCenterPosition = [0,0];// 地图中心
	self.mapZoom = 12;// 级别
	self.signTableSize = 5000;
	self.reportTableSize = 5000;

	self.cookieDay = 60;
	self.templatesDir = "/static/templates";
	self.isCacheTemplate = true;

	self.defaultUserPhoto = "/static/images/defaultUserPhoto.jpg";
	self.defaultMarkerPic = "/static/images/defaultmarker.png";

	self.reportIcons = [
		"fa-archive",
		"fa-bar-chart-o",
		"fa-book",
		"fa-briefcase",
		"fa-bullseye",
		"fa-calendar",
		"fa-compass",
		"fa-database",
		"fa-exclamation-triangle",
		"fa-external-link-square",
		"fa-flag",
		"fa-folder-open",
		"fa-gaver",
		"fa-info-circle",
		"fa-laptop",
		"fa-map-marker",
		"fa-money",
		"fa-paper-plane",
		"fa-pencil-square-o",
		"fa-picture-o",
		"fa-question-circle",
		"fa-random",
		"fa-reply-all",
		"fa-rss-square",
		"fa-tasks",
		"fa-upload",
		"fa-user"
	];

	// 获取url 参数
	self.urlParams = (function(url) {
		var result = new Object();
		var idx = url.lastIndexOf('?');

		if (idx > 0) {
			var params = url.substring(idx + 1).split('&');
			for (var i = 0; i< params.length; i++) {
				idx = params[i].indexOf('=');

				if (idx > 0) {
					result[params[i].substring(0, idx)] = params[i].substring(idx + 1);
				}
			}
		}
		return result;
	})(window.location.href);
	
	self.dataTableLan = {
		sInfo: "共找到 _TOTAL_ 条记录, 当前显示(_START_ 到 _END_)",
		sLengthMenu: "每页显示 _MENU_条",
		sSearch: "在结果中查找: _INPUT_",
		sZeroRecords: "没有找到符合条件的数据",
		sNext: "下一页",
		sInfoEmpty: "木有记录",
		sInfoFiltered: "(从 _MAX_ 条记录中过滤)",
			oPaginate: {
				sFirst: "首页",
				sPrevious: "前一页",
				sNext: "后一页",
				sLast: "尾页"
			}
	};
	self.dataTableStateSave = true;
})(YAN)