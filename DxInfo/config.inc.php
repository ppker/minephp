<?php
return array(
	/*DxExtForTp 配置*/
	'DX_PUBLIC' => DX_PUBLIC,// DxInfo的Web目录地址

	'TMPL_ACTION_ERROR' => DXINFO_PATH . "DxTpl/success.html",// 错误跳转对应的模板文件
	'TMPL_ACTION_SUCCESS' => DXINFO_PATH . "DxTpl/success.html",// 成功跳转对应的模板文件

	'TOKEN_ON' => false,// 表单令牌关闭，1.一个提交，多个model->create时，后面的令牌验证错误
	'TOKEN_NAME' => 'DxToken',// 表单令牌
	'TOKEN_RESET' => false,// 需要设置，否则ajax提交验证失败后，将导致系统重新生成令牌。

	'APP_AUTOLOAD_PATH' => DXINFO_PATH,// TP自动加载模板

	'SESSION_AUTO_START' => true,// SESSION自动开启

	'SESSION_OPTIONS' => array(
		'type' => 'db',// session采用数据库保存 
		'expire' => 3600,// session过期时间，如果不设就是php.ini中设置的默认值
	),
	'SESSION_TABLE' => 'think_session',

	//'TMPL_ENGINE_TYPE' => "Dxthink",// 模板解析类。。TP自带的类对，tags支持非常弱，3.1.3就不支持tags，3.1.2的模板继承不支持tags，所以直接创建自己的模板类
	'TMPL_STRIP_SPACE' => false,// 是否去除模板文件里面的html空格与换行,这个查询按钮没有间隔

	'URL_ROUTER_ON' => true,
	'URL_ROUTE_RULES' => array( // 正则模式下，不能使用 /xx/xx/xx/xx传递GET参数，会强制引入分组概念，导致action对应不上
		"/(\w+)\/edit\/(\d+)/" => ":1/add?id=:2",
		"/(\w+)\/delete\/(\d+)/" => ":1/delete?id=:2"	
	),


	//'tags' => array(); // 标记设置

	'URL_MODEL' => 2,// URL模式
	'DEFAULT_THEME' => '',// 默认皮肤
	'OUTPUT_ENCODE' => false,

	/*-----权限设置区域-----------*/
	'LOGIN_MD5' => false,//   是否MD5加密密码
	//不进行data_change记录的Model,如果 第一个为NO的话，就关闭该日志记录功能
	'NO_SAVE_DATA_CHANGE' => array('DataChangeLog', 'Menu', 'OperationLog'),

	'DP_NOT_CHECK_ACTION' => array('Public' => 1, 'DataSync' => 1, 'Checkcode' => 1, 'DataList' => 1), // 不进行数据权限控制的ACTION  'Account' => 1,
	'NOT_AUTH_ACTION' => array('Public' => 1, 'Web' => 1, 'Checkcode' => 1, 'DataList' => 1),// 无需权限认证的Action

	'REQUIST_AUTH_ACTION' => array(), //必须权限认证的Action

	'DISABLE_ACTION_AUTH_CHECK' => false,// 关闭操作权限验证

	/*------设置上传区域-------*/

	'UPLAOD_BASE_PATH' => dirname(APP_PATH) . "/userUploadFiles", // 设置上传目录
	'UPLOAD_BASE_URL' => __ROOT__."/userUploadFiles",// 上传路径的URL
	'TEMP_FILE_PATH' => RUNTIME_PATH . "TMP_IMG",// 文件上传的临时路径
	// 通常文件上传的扩展名
	'UPLOAD_IMG_FILETYPE' => '.gif、.jpeg、.jpg、.png、.pdf、.doc、.docx、.xls、.ppt、.txt、.mp4、.mov',
	// photo_default.png
	'CUT_PHOTO_DEFAULT_IMG' => 'touxiang_default_heibai.jpg',

	/*-----用户日志设置区域------*/
	'LOG_RECORD' => true, // 进行日志记录
	'LOG_OPERATION_RECORD' => true, // writeActionLog方法控制
	'LOG_EXCEPTION_RECORD' => true, // 是否记录异常信息日志
	'LOG_LEVEL' => 'EMERG,ALERT,CRIT,ERR,WARN,INFO,DEBUG,SQL',// 允许记录的日志级别

	/*------用户自动化设置区域---------*/
	'DEFAULT_MODULE' => 'Home',// 默认模块
	'LOGIN_URL' => 'Public/login',// 登陆页面

    'USER_AUTH_KEY' => 'login_user_id',// 系统验证用户身份字段
    'LOGIN_USER_NICK_NAME' => "name", // 用户昵称字段名
    'DELETE_TAGS' => array ( "delete_status" => "1" ),// 删除标记字段值变化
    // 我的桌面默认宽度和高度,宽度和高度要不带单位，用于页面css显示 如 style="width:300px;height:206px"
    //'MY_DESKTOP' => array ('width' => '300','height' => '206' ),

    //自动完成字段
    'DP_POWER_FIELDS' => array (
        array ('field_name' => 'creater_user_id','auto_type' => 1,'type' => 0,'session_field' => "login_user_id" ),
        array ('field_name' => 'creater_user_name','auto_type' => 1,'type' => 0,'session_field' => 'true_name' ),
        array ('field_name' => 'creater_canton_fdn','auto_type' => 1,'type' => 1,'session_field' => 'cantonfdn' ),
        array ('field_name' => 'creater_public','auto_type' => 0,'type' => 2,'session_field' => '' ) 
    )


);
?>