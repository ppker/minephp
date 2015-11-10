<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>MinePHP管理系统</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="MinePHP管理系统" name="description" />
   <meta content="ppker" name="author" />
   <link id="style_color" rel="stylesheet" type="text/css" href="/static/css/style-default.css" />



</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
   <!-- BEGIN HEADER -->

   <div id="header" class="navbar navbar-inverse navbar-fixed-top">
       <!-- BEGIN TOP NAVIGATION BAR -->
       <div class="navbar-inner">
           <div class="container-fluid">
               <!--BEGIN SIDEBAR TOGGLE-->
               <div class="sidebar-toggle-box hidden-phone">
                   <div class="icon-reorder tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
               </div>
               <!--END SIDEBAR TOGGLE-->
               <!-- BEGIN LOGO -->
               <a class="brand" href="index.html">
                   <img src="/static/images/metro/logo.png" alt="Metro Lab" />
               </a>

               <!-- END LOGO -->
               <!-- BEGIN RESPONSIVE MENU TOGGLER -->
               <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="arrow"></span>
               </a>
               <!-- END RESPONSIVE MENU TOGGLER -->
               <div id="top_menu" class="nav notify-row">
                   <!-- BEGIN NOTIFICATION -->
                   <ul class="nav top-menu">
                       <!-- BEGIN SETTINGS -->
                       <li class="dropdown">
                           <a href="index.html#" class="dropdown-toggle" data-toggle="dropdown">
                               <i class="icon-tasks"></i>
                               <span class="badge badge-important">6</span>
                           </a>
                           <ul class="dropdown-menu extended tasks-bar">
                               <li>
                                   <p>你有6条任务</p>
                               </li>
                               <li>
                                   <a href="index.html#">
                                       <div class="task-info">
                                         <div class="desc">控制台</div>
                                         <div class="percent">44%</div>
                                       </div>
                                       <div class="progress progress-striped active no-margin-bot">
                                           <div class="bar" style="width: 44%;"></div>
                                       </div>
                                   </a>
                               </li>
                               <li>
                                   <a href="index.html#">
                                       <div class="task-info">
                                           <div class="desc">数据库更新</div>
                                           <div class="percent">65%</div>
                                       </div>
                                       <div class="progress progress-striped progress-success active no-margin-bot">
                                           <div class="bar" style="width: 65%;"></div>
                                       </div>
                                   </a>
                               </li>
                               <li>
                                   <a href="index.html#">
                                       <div class="task-info">
                                           <div class="desc">手机开发进度</div>
                                           <div class="percent">87%</div>
                                       </div>
                                       <div class="progress progress-striped progress-info active no-margin-bot">
                                           <div class="bar" style="width: 87%;"></div>
                                       </div>
                                   </a>
                               </li>
                               <li>
                                   <a href="index.html#">
                                       <div class="task-info">
                                           <div class="desc">手机App进度</div>
                                           <div class="percent">33%</div>
                                       </div>
                                       <div class="progress progress-striped progress-warning active no-margin-bot">
                                           <div class="bar" style="width: 33%;"></div>
                                       </div>
                                   </a>
                               </li>
                               <li>
                                   <a href="index.html#">
                                       <div class="task-info">
                                           <div class="desc">控制台</div>
                                           <div class="percent">90%</div>
                                       </div>
                                       <div class="progress progress-striped progress-danger active no-margin-bot">
                                           <div class="bar" style="width: 90%;"></div>
                                       </div>
                                   </a>
                               </li>
                               <li class="external">
                                   <a href="index.html#">查看所有任务</a>
                               </li>
                           </ul>
                       </li>
                       <!-- END SETTINGS -->
                       <!-- BEGIN INBOX DROPDOWN -->
                       <li class="dropdown" id="header_inbox_bar">
                           <a href="index.html#" class="dropdown-toggle" data-toggle="dropdown">
                               <i class="icon-envelope-alt"></i>
                               <span class="badge badge-important">5</span>
                           </a>
                           <ul class="dropdown-menu extended inbox">
                               <li>
                                   <p>你有5条消息</p>
                               </li>
                               <li>
                                   <a href="index.html#">
                                       <span class="photo"><img src="/static/images/metro/avatar-mini.png" alt="avatar" /></span>
									<span class="subject">
									<span class="from">Jonathan Smith</span>
									<span class="time">Just now</span>
									</span>
									<span class="message">
									    Hello, 这是个消息列子.
									</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="index.html#">
                                       <span class="photo"><img src="/static/images/metro/avatar-mini.png" alt="avatar" /></span>
									<span class="subject">
									<span class="from">Jhon Doe</span>
									<span class="time">10 mins</span>
									</span>
									<span class="message">
									 Hi, 最近咋样?
									</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="index.html#">
                                       <span class="photo"><img src="/static/images/metro/avatar-mini.png" alt="avatar" /></span>
									<span class="subject">
									<span class="from">Jason Stathum</span>
									<span class="time">3 hrs</span>
									</span>
									<span class="message">
									    This is awesome dashboard.
									</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="index.html#">
                                       <span class="photo"><img src="/static/images/metro/avatar-mini.png" alt="avatar" /></span>
									<span class="subject">
									<span class="from">Jondi Rose</span>
									<span class="time">Just now</span>
									</span>
									<span class="message">
									    Hello, this is metrolab
									</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="index.html#">See all messages</a>
                               </li>
                           </ul>
                       </li>
                       <!-- END INBOX DROPDOWN -->
                       <!-- BEGIN NOTIFICATION DROPDOWN -->
                       <li class="dropdown" id="header_notification_bar">
                           <a href="index.html#" class="dropdown-toggle" data-toggle="dropdown">

                               <i class="icon-bell-alt"></i>
                               <span class="badge badge-warning">7</span>
                           </a>
                           <ul class="dropdown-menu extended notification">
                               <li>
                                   <p>你有7条提示信息</p>
                               </li>
                               <li>
                                   <a href="index.html#">
                                       <span class="label label-important"><i class="icon-bolt"></i></span>
                                       Server #3 overloaded.
                                       <span class="small italic">34 mins</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="index.html#">
                                       <span class="label label-warning"><i class="icon-bell"></i></span>
                                       Server #10 not respoding.
                                       <span class="small italic">1 Hours</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="index.html#">
                                       <span class="label label-important"><i class="icon-bolt"></i></span>
                                       Database overloaded 24%.
                                       <span class="small italic">4 hrs</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="index.html#">
                                       <span class="label label-success"><i class="icon-plus"></i></span>
                                       New user registered.
                                       <span class="small italic">Just now</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="index.html#">
                                       <span class="label label-info"><i class="icon-bullhorn"></i></span>
                                       Application error.
                                       <span class="small italic">10 mins</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="index.html#">See all notifications</a>
                               </li>
                           </ul>
                       </li>
                       <!-- END NOTIFICATION DROPDOWN -->

                   </ul>
               </div>
               <!-- END  NOTIFICATION -->
               <div class="top-nav ">
                   <ul class="nav pull-right top-menu" >
                       <!-- BEGIN SUPPORT -->
                       <li class="dropdown mtop5">

                           <a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="index.html#" data-original-title="Chat">
                               <i class="icon-comments-alt"></i>
                           </a>
                       </li>
                       <li class="dropdown mtop5">
                           <a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="index.html#" data-original-title="Help">
                               <i class="icon-headphones"></i>
                           </a>
                       </li>
                       <!-- END SUPPORT -->
                       <!-- BEGIN USER LOGIN DROPDOWN -->
                       <li class="dropdown">
                           <a href="index.html#" class="dropdown-toggle" data-toggle="dropdown">
                               <img src="/static/images/metro/avatar1_small.jpg" alt="">
                               <span class="username">Jhon Doe</span>
                               <b class="caret"></b>
                           </a>
                           <ul class="dropdown-menu extended logout">
                               <li><a href="index.html#"><i class="icon-user"></i>我的资料</a></li>
                               <li><a href="index.html#"><i class="icon-cog"></i>我的设置</a></li>
                               <li><a href="/Api/Public/logout"><i class="icon-key"></i>退出</a></li>
                           </ul>
                       </li>
                       <!-- END USER LOGIN DROPDOWN -->
                   </ul>
                   <!-- END TOP NAVIGATION MENU -->
               </div>
           </div>
       </div>
       <!-- END TOP NAVIGATION BAR -->
   </div>
   <!-- END HEADER -->
   <!-- BEGIN CONTAINER -->
   <div id="container" class="row-fluid">
      <!-- BEGIN SIDEBAR -->
      <div class="sidebar-scroll">
        <div id="sidebar" class="nav-collapse collapse">

         <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
         <div class="navbar-inverse">
            <form class="navbar-search visible-phone">
               <input type="text" class="search-query" placeholder="Search" />
            </form>
         </div>
         <!-- END RESPONSIVE QUICK SEARCH FORM -->
         <!-- BEGIN SIDEBAR MENU -->
          <ul class="sidebar-menu">
              <li class="sub-menu active">
                  <a class="" href="index.html">
                      <i class="icon-dashboard"></i>
                      <span>控制台</span>
                  </a>
              </li>
              
              <!--新增加的功能菜单-->
              <li class="sub-menu">
                  <a href="javascript:;" class="">
                      <i class="icon-book"></i>
                      <span>系统管理</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li><a class="" href="/Home/account">用户管理</a></li>
                      <li><a class="" href="button.html">工区管理</a></li>
                      
                  </ul>
              </li>



              <li class="sub-menu">
                  <a href="javascript:;" class="">
                      <i class="icon-book"></i>
                      <span>UI 组件</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li><a class="" href="general.html">通用</a></li>
                      <li><a class="" href="button.html">按钮</a></li>
                      <li><a class="" href="slider.html">滑动</a></li>
                      <li><a class="" href="metro_view.html">Metro风格</a></li>
                      <li><a class="" href="tabs_accordion.html">Tab选项卡 & 手风琴</a></li>
                      <li><a class="" href="typography.html">文字排版</a></li>
                      <li><a class="" href="tree_view.html">树菜单</a></li>
                      <li><a class="" href="nestable.html">嵌套列表</a></li>
                  </ul>
              </li>
              <li class="sub-menu">
                  <a href="javascript:;" class="">
                      <i class="icon-cogs"></i>
                      <span>插件</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li><a class="" href="calendar.html">日历</a></li>
                      <li><a class="" href="grids.html">网格</a></li>
                      <li><a class="" href="chartjs.html">图表统计</a></li>
                      <li><a class="" href="flot_chart.html">Flot图表</a></li>
                      <li><a class="" href="gallery.html">相册</a></li>
                  </ul>
              </li>
              <li class="sub-menu">
                  <a href="javascript:;" class="">
                      <i class="icon-tasks"></i>
                      <span>表单</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li><a class="" href="form_layout.html">表单布局</a></li>
                      <li><a class="" href="form_component.html">表单组件</a></li>
                      <li><a class="" href="form_wizard.html">表单提示</a></li>
                      <li><a class="" href="form_validation.html">表单验证</a></li>
                      <li><a class="" href="dropzone.html">文件上传</a></li>
                  </ul>
              </li>
              <li class="sub-menu">
                  <a href="javascript:;" class="">
                      <i class="icon-th"></i>
                      <span>数据表格</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li><a class="" href="basic_table.html">简单表格</a></li>
                      <li><a class="" href="dynamic_table.html">动态表格</a></li>
                      <li><a class="" href="editable_table.html">可编辑表格</a></li>
                  </ul>
              </li>
              <li class="sub-menu">
                  <a href="javascript:;" class="">
                      <i class="icon-fire"></i>
                      <span>Icon图标</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li><a class="" href="font_awesome.html">FontAwesome图标</a></li>
                      <li><a class="" href="glyphicons.html">Glyphicons图标</a></li>
                  </ul>
              </li>
              <li class="sub-menu">
                  <a class="" href="javascript:;">
                      <i class="icon-trophy"></i>
                      <span>代码片段</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li><a href="general_portlet.html" class="">通用片段</a></li>
                      <li><a href="draggable_portlet.html" class="">可拖拽片段</a></li>
                  </ul>
              </li>
              <li class="sub-menu">
                  <a class="" href="javascript:;">
                      <i class="icon-map-marker"></i>
                      <span>地图</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li><a href="vector_map.html" class="">Vector地图</a></li>
                      <li><a href="google_map.html" class="">Google地图</a></li>
                  </ul>
              </li>
              <li class="sub-menu">
                  <a href="javascript:;" class="">
                      <i class="icon-file-alt"></i>
                      <span>基本页面</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li><a class="" href="blank.html">空白页面</a></li>
                      <li><a class="" href="blog.html">博客</a></li>
                      <li><a class="" href="timeline.html">时间轴</a></li>
                      <li><a class="" href="profile.html">个人资料</a></li>
                      <li><a class="" href="about_us.html">关于我们</a></li>
                      <li><a class="" href="contact_us.html">联系我们</a></li>
                  </ul>
              </li>
              <li class="sub-menu">
                  <a href="javascript:;" class="">
                      <i class="icon-glass"></i>
                      <span>其他</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li><a class="" href="lock.html">锁屏</a></li>
                      <li><a class="" href="invoice.html">购物单</a></li>
                      <li><a class="" href="pricing_tables.html">价目单</a></li>
                      <li><a class="" href="search_result.html">搜索展示</a></li>
                      <li><a class="" href="faq.html">帮助页面</a></li>
                      <li><a class="" href="404.html">404错误页面</a></li>
                      <li><a class="" href="500.html">500错误页面</a></li>
                  </ul>
              </li>

              <li>
                  <a class="" href="login.html">
                    <i class="icon-user"></i>
                    <span>登录页面</span>
                  </a>
              </li>
          </ul>
         <!-- END SIDEBAR MENU -->
      </div>
      </div>
<!-- <?php if(($modelInfo["enablePrint"]) == "1"): ?><script language="javascript" src="__DXPUBLIC__/public/Lodop6.010/LodopFuncs.js"></script>
<object id="LODOP_OB" classid="clsid:2105C259-1E0C-4534-8141-A753534CB4CA" width=0 height=0 style="display:none"> 
  <embed id="LODOP_EM" type="application/x-print-lodop" width=0 height=0 pluginspage="install_lodop32.exe"></embed>
</object><?php endif; ?> -->
<div id="main-content" style="min-height:500px;">

       <div class="container-fluid">
          <!-- BEGIN PAGE HEADER-->   
          <div class="row-fluid">
             <div class="span12">
                 <!-- BEGIN THEME CUSTOMIZER-->
                 <div id="theme-change" class="hidden-phone">
                     <i class="icon-cogs"></i>
                      <span class="settings">
                          <span class="text">主题颜色:</span>
                          <span class="colors">
                              <span class="color-default" data-style="default"></span>
                              <span class="color-green" data-style="green"></span>
                              <span class="color-gray" data-style="gray"></span>
                              <span class="color-purple" data-style="purple"></span>
                              <span class="color-red" data-style="red"></span>
                          </span>
                      </span>
                 </div>
                 <!-- END THEME CUSTOMIZER-->
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                 <h3 class="page-title">
                   控制台
                 </h3>
                 <ul class="breadcrumb">
                     <li>
                         <a href="index.html#">首页</a>
                         <span class="divider">/</span>
                     </li>                      
                     <li class="active">
                         控制台
                     </li>
                     
                 </ul>
                 <!-- END PAGE TITLE & BREADCRUMB-->
             </div>
          </div>
          <!-- END PAGE HEADER-->
          <!-- BEGIN PAGE CONTENT-->
          
          <div class="dataListLeftMenuArea">
              <!-- <?php echo ($modelInfo["leftArea"]); ?> -->
          </div>

          <div class="dataListDataArea">
            <input id="modelInfo_editTitle" value="" type="hidden" />
              <table id="gridHeader" style="display:none"></table>
              
              <div id="header_title" class="dataListHeader" style="margin-bottom: 0px;">
                  <span style="font-size: 22px;font-weight: bold;"></span>

                
                <div id='query_items' style="display:inline;">
                  <form id="data_list_search" class="form-search" style="display:inline;">
                    登录名:<input id='username' size='10' style='width:120px' class='dataOpeSearch z_input likeRight likeLeft' value='' />
                    真实姓名:<input id='real_name' size='10' style='width:120px' class='dataOpeSearch z_input likeRight likeLeft' value='' />
                    角色:<select id='role_id' name='role_id' class='dataOpeSearch' style='width:120px;style=display:inline'>
                                <option value=''>请选择</option><?php if(is_array($roleArray)): $i = 0; $__LIST__ = $roleArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($vo["role_id"]); ?>'><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                              </select>
                    <input onclick='javascript:dataOpeSearch(true);' type='button' class='btn btn-info btn-sm' value='查询' id='item_query_items' />
                    <input onclick='javascript:dataOpeSearch(false);' type='button' class='btn btn-info btn-sm' value='全部数据' id='item_query_all' />      
                  </form>
                </div>
                <div class="y_import" style="display:none;"></div>
            
            </div>
            

            
            <div id="dataListCon">
              <div id="dataList"></div>
              
              <div id="grid-help-info">
                <?php echo ($modelInfo["helpInfo"]); ?>
              </div>
            </div>
          </div>
          <!--
          <?php if((C("APP_DEBUG")) == "true"): ?><script src="/Public/public/sigma_grid/src/gt_base.js" type="text/javascript"></script>
            <script src="/Public/public/sigma_grid/src/gt_tool.js" type="text/javascript"></script><?php endif; ?>
          -->
          <div class="js_sign"></div>

       <!-- END PAGE CONTAINER-->
    </div>

</div>
	<!-- ie8 fixes -->
	<!--[if lt IE 9]>
	<script src="/static/js/js/excanvas.js"></script>
	<script src="js/respond.js"></script>
	<![endif]-->

	<!--common script for all pages-->
	<!--script for this page only-->
	<!-- END JAVASCRIPTS -->

	<script type="text/javascript" src="/static/js/head.js"></script>
	<script type="text/javascript" src="/static/js/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/static/js/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/static/js/js/body_common.js"></script>	



	<script type="text/javascript" src="/static/js/main_common.js"></script>
	<script type="text/javascript" src="/static/js/data_js.js"></script>
	<?php if((dataList)): ?><!-- page -->
		
		<script type="text/javascript" src="/static/js/plugins/sigma_grid/DataOpe.js"></script>
		<script type="text/javascript" src="/static/js/plugins/sigma_grid/gt_msg_cn.js"></script>
		<script type="text/javascript" src="/static/js/plugins/sigma_grid/gt_grid_all.js"></script>
		<script type="text/javascript" src="/static/js/plugins/sigma_grid/sigma_custom/fix.toolbar.js"></script>

		<script src="/static/js/views/home/dataList.js"></script>
		<script type="text/javascript">
			var controller = null;
			controller = "<?php echo ($controller); ?>";	
			var URL_URL = '/Home/Account';
			var PUBLIC_URL    = '/Public';
			var Y_URL = URL_URL.replace(/Home/, "Api");
			
		</script><?php endif; ?>
	<script>

		/*head.ready('/static/js/js/dataope_ext.js', function(){
			alert('ssss');
			window.PAGE_ACTION && $(window).ready(window.PAGE_ACTION().init());
		});*/
		// $(function(){
		// 	window.PAGE_ACTION && $(window).ready(window.PAGE_ACTION().init());
		// })
		//(window.PAGE_ACTION && $(window).ready(window.PAGE_ACTION().init()));
	</script>


<!-- BEGIN FOOTER -->
	<div id="footer">
	    2015 &copy; MainPhp by ppker
	</div>
   <!-- 
     -->
	<!--script-->
	

</body>
<!-- END BODY -->
</html>