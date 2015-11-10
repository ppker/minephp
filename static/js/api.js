(function(MAIN, $){
	"use strict";
	var self = MAIN.nameSpace.reg("api"),
		queue = [],
		ajax = null;

	ajax = function(options){
		var ret = null;
		if(MAIN.define.isAjaxLock){
			queue.push(options);
			// 待加
		}else{
			options.async = typeof options.async === "undefined" ? true : options.async;
			options.async = options.successCallBack ? options.async : false;
			MAIN.loading.hide();
			$.ajax({
				async: options.async,
				dataType: "json",
				type: "post",
				url: options.url,
				data: options.data,

				success: function(result, textStatus){
					MAIN.define.isAjaxLock = false;
					MAIN.loading.hide();
					if(result.success && typeof options.successCallBack === "function"){
						options.successCallBack(result);
					}else if(typeof options.failCallBack === "function"){
						options.failCallBack(result);
					}
					ret = result;
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					MAIN.define.isAjaxLock = false;
					MAIN.loading.hide();
					if(typeof options.failCallBack === "function"){
						options.failCallBack({
							success: false,
							message: errorThrown,
							date: null
						});
					}
				},
				complete: function(XMLHttpRequest, textStatus){
					MAIN.define.isAjaxLock = false;
					MAIN.loading.hide();
					if(queue.length >= 1){
						var options = queue.shift();
						ajax(options);
					}
				}
			});
		}
		return ret;
	};

	/*具体的业务逻辑*/
	self.accountLogin = function(options){
		options = options ? options : {};
		options.url = "/Api/Public/checkLogin";
		return ajax(options);
	};
	
	/*为sigma查询数据*/
	self.getList = function(options){
		options = options ? options : {};
		options.url = "/Api/DataList/index";
		return ajax(options);
	}

})(YAN, jQuery);