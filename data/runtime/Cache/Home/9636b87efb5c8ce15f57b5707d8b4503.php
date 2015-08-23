<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

	<head>
		<meta charset="UTF-8" />
		<title>MinePhp网站管理后台</title>
		<meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge" />
		<meta name="renderer" content="webkit|ie-comp|ie-stand">
		<meta name="robots" content="noindex,nofollow">
		<script type="text/javascript" src="/static/js/head.js" data-headjs-load="/static/js/init.js"></script>
		<link href="/static/css/log/admin_login.css" rel="stylesheet" />
		<style>
			#login_btn_wraper {
				text-align: center;
			}
			#login_btn_wraper .tips_success {
				color: #fff;
			}
			#login_btn_wraper .tips_error {
				color: #DFC05D;
			}
			#login_btn_wraper button:focus {
				outline: none;
			}
		</style>
		<script>
			if (window.parent !== window.self) {
				document.write = '';
				window.parent.location.href = window.self.location.href;
				setTimeout(function() {
					document.body.innerHTML = '';
				}, 0);
			}
		</script>

	</head>

	<body>
		<div class="logo_in">
			<img src="/static/images/log/logo.png" style="width:130px;height:130px;">
		</div>
		<div class="tip">
			<span>今天是<?php echo ($serverDate); ?>&nbsp;&nbsp; <?php echo ($week); ?></span>&nbsp;&nbsp;您的IP：<span><?php echo ($clientIp); ?></span>
		</div>
		<div class="wrap_in">
			<div class="login_in">
				<h1>MinePhp后台管理中心</h1>
				<form id="form" autoComplete="off" class="J_ajaxForm" data-toggle="validator">
					<ul>
						<li>
							<input class="input" id="J_admin_name" required name="username" type="text" placeholder="帐号名或邮箱" title="帐号名或邮箱" valie="" />
						</li>
						<li>
							<input class="input" id="admin_pwd" type="password" required name="password" placeholder="密码" title="密码" />
						</li>
						<li>
							<div id="J_verify_code">
								<?php echo ($imgcode); ?>
							</div>
						</li>
						<li>
							<input class="input" type="text" name="verify" placeholder="请输入验证码" />
						</li>
					</ul>
					<div id="login_btn_wraper">
						<button type="submit" name="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">登录</button>
					</div>
				</form>
			</div>
		</div>
		<div class="copy">&copy; 2015 <a href="#">MinePhp</a>
		</div>
				
	</body>

</html>