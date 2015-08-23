<?php

	$theProjectConfig = require(DXINFO_PATH . "config.inc.php");// 自定义配置
	
	//dump(DXINFO_PATH . "database.inc.php");die;
	$theProjectDatabase = require(DXINFO_PATH . "/database.inc.php");// 数据库配置

	if(file_exists(SITE_PATH . "database.php")) $theAppDatabase = require(SITE_PATH . "database.php");
	else $theAppDatabase = array();

	$theAppConfig = array(
		'DX_PUBLIC' => DXINFO_PATH . "DxWebRoot/",// dxinfo公共目录
		'LOGIN_USER_NICK_NAME' => 'real_name', // 数据库里面的用户昵称
		'USER_AUTH_KEY' => 'account_id', // 验证用户的数据表字段
		'APP_DEBUG' => false,
		'UPLOADS_DIR' => SITE_PATH . "Uploads", // 上传目录
		// 上传文件格式
		'UPLOAD_FILE_EXT' => array(
			'gif','jpg','jpeg','bmp','png','pdf','doc','docx','xls','ppt','pptx',
			'xlsx','vsd','vsdx','dwg','mp4','mov','txt','zip','rar','7z'
		),
		// 附件文件格式
		'FUJIAN_FIELD_FILE_EXT' => array(
			"filetype" => "gif、.jpg、.jpeg、.bmp、.png、.pdf、.doc、.docx、.xls、.xlsx、.ppt、.pptx、.vsd、.vsdx、.dwg、.mp4、.mov、.txt、.zip、.rar、.7z",
			"maxNum"=>0 , 
			"buttonValue"=>"文件上传",
			"maxSize"=>10485760
		)
	);

	if(file_exists(DXINFO_PATH . 'debug.inc.php')) $theDebugConfig = require(DXINFO_PATH . 'debug.inc.php');
	else $theDebugConfig = array();

	//加载扩展的自定义的函数
	$myAppFunction = array(
		//'LOAD_EXT_FILE' => ''
	);
	
	$endConfig = array_merge($theProjectConfig, $theProjectDatabase, $theAppDatabase, $theAppConfig, $theDebugConfig, $myAppFunction );

	//dump($endConfig);die;
return $endConfig;