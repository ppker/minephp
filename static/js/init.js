var path = "/static/js/";
// css
head.load([path+"plugins/bootstrap/css/bootstrap.min.css", path+"plugins/Font-awesome/css/font-awesome.css",
		path+"plugins/FlatUI/css/flat-ui.css"
	]);
// js

head.load([path+"nameSpace.js", path+"plugins/jquery/jquery-1.11.1.min.js", path+"plugins/jquery/jquery.extend.js", 
			path+"plugins/bootstrap/js/bootstrap.min.js",
			path+"plugins/bootstrap/js/jquery.bootstrap.min.js",
			path+"plugins/bootstrap/js/validator.js",
			path+"plugins/FlatUI/js/bootstrap-switch.js",
			path+"plugins/handlebars/handlebars-v1.3.0.js",
			path+"plugins/handlebars/extend.js",
			path+"plugins/md5/md5.min.js",
			path+"msg.js",
			path+"define.js", path+"loading.js", path+"utils.js", path+"api.js", path+"prompt.js",
			path+"views/home/public.js"
			],function(){
	(window.PAGE_ACTION && window.PAGE_ACTION().init());
});