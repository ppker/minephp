/**
 * [js命名空间]
 * @param  {[type]} self)){}(window [description]
 * @return {[type]}
 * version: 1.0
 * date: 2015-6-15
 */
(function(self){
		'use strict';
		var yan={}; //全局
		yan.nameSpace = {
			// 注册
			reg: function(s){
				var arr = s.split('.');
				var namespace = yan; //引用类型 绑定

				for (var i = 0, k = arr.length; i < k; i++) {
					if(typeof namespace[arr[i]] == 'undefined') {
						namespace[arr[i]] = {};
					}
					namespace = namespace[arr[i]];//再次引用类型 绑定
				};
				return namespace;//给下一层使用 进一步处理对象
			},
			// 删除
			del: function(s){
				var arr = s.split('.');
				var namespace = yan;
				for (var i = 0,k = arr.length; i <k; i++) {
					if(typeof namespace[arr[i]] !== 'undefined'){
						delete namespace[arr[i]];
					}
				};
				return true;
			},
			//判断
			isDefined: function(s){
				var arr = s.split('.');
				var namespace = yan;
				var isDe = [];
				for (var i = 0,k = arr.length; i < k; i++) {
					if(typeof namespace[arr[i]] !== 'undefined'){
						isDe[arr[i]] = true;
					}else isDE[arr[i]] = false;
				};
				return isDe;
			}	
		};

		self.YAN = yan;
	})(window);