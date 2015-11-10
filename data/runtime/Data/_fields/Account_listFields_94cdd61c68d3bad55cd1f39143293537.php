a:14:{s:10:"account_id";a:8:{s:4:"type";s:3:"int";s:4:"size";i:10;s:5:"title";s:23:"<center>操作</center>";s:5:"width";i:280;s:2:"pk";b:1;s:4:"hide";i:22;s:8:"renderer";s:432:"var valChange=function valChangeCCCC(value,record,columnObj,grid,colNo,rowNo){
						var v= '<a href="javascript:dataOpeEdit(' + value + ');" class="btn btn-xs btn-success">修改</a>';
						 v += ' <a href="javascript:dataOpeDelete(' + value + ');" class="btn btn-xs btn-danger">删除</a>';
						 v += ' <a href="javascript:resetPasswd('+value+');" class="btn btn-xs btn-success">重置密码</a>';
						 return v;
					 }";s:4:"name";s:10:"account_id";}s:8:"username";a:5:{s:4:"type";s:7:"varchar";s:4:"size";i:100;s:5:"title";s:26:"<center>登录名</center>";s:5:"width";i:80;s:4:"name";s:8:"username";}s:3:"pwd";a:7:{s:4:"type";s:8:"password";s:4:"size";i:100;s:5:"title";s:29:"<center>登陆密码</center>";s:4:"hide";i:29;s:6:"editor";s:500:" <input type="password" id="pwd" name="pwd" style="width:140px"
						   class="itemAddInput validate[required,minSize[6],maxSize[15]]" /><span class="field_required">*</span></td></tr>
						   <tr class="itemAddTr">
						   <td align="right" class="itemAddTr"><span class="itemAddField"><b>确认密码</b></span>:</td>
						   <td><input type="password" id="check_pwd" name="check_pwd" style="width:140px"
							class="itemAddInput validate[required,minSize[6],maxSize[15],equals[pwd]]" />";s:4:"name";s:3:"pwd";s:5:"width";s:2:"80";}s:9:"real_name";a:5:{s:4:"type";s:7:"varchar";s:4:"size";i:45;s:5:"width";i:80;s:5:"title";s:29:"<center>真实姓名</center>";s:4:"name";s:9:"real_name";}s:3:"tel";a:5:{s:4:"type";s:7:"varchar";s:4:"size";i:12;s:5:"width";i:90;s:5:"title";s:29:"<center>联系电话</center>";s:4:"name";s:3:"tel";}s:5:"email";a:5:{s:4:"type";s:7:"varchar";s:4:"size";i:60;s:5:"width";i:160;s:5:"title";s:22:"<center>EMail</center>";s:4:"name";s:5:"email";}s:7:"address";a:5:{s:4:"type";s:7:"varchar";s:4:"size";i:60;s:5:"width";i:120;s:5:"title";s:29:"<center>家庭地址</center>";s:4:"name";s:7:"address";}s:4:"sort";a:6:{s:4:"type";s:7:"varcahr";s:4:"size";i:12;s:5:"width";i:50;s:5:"title";s:23:"<center>排序</center>";s:4:"hide";i:1;s:4:"name";s:4:"sort";}s:7:"role_id";a:6:{s:4:"type";s:6:"select";s:4:"size";i:10;s:5:"title";s:23:"<center>角色</center>";s:9:"valChange";a:4:{i:1;s:15:"系统管理员";i:2;s:15:"主管工程师";i:3;s:12:"车间人员";i:4;s:9:"段领导";}s:5:"width";i:80;s:4:"name";s:7:"role_id";}s:7:"dept_id";a:6:{s:4:"type";s:3:"int";s:4:"size";i:10;s:5:"title";s:25:"<center>部门ID</center>";s:4:"hide";i:7;s:4:"name";s:7:"dept_id";s:5:"width";s:2:"80";}s:9:"canton_id";a:6:{s:4:"type";s:3:"int";s:4:"size";i:10;s:5:"title";s:29:"<center>所在区域</center>";s:5:"width";i:3000;s:4:"hide";i:7;s:4:"name";s:9:"canton_id";}s:10:"canton_fdn";a:7:{s:5:"title";s:29:"<center>所在部门</center>";s:4:"type";s:6:"canton";s:9:"valChange";a:16:{s:2:"1.";s:16:"郑州通信段|";s:4:"1.2.";s:35:"郑州通信段|郑州通信车间|";s:5:"1.10.";s:41:"郑州通信段|石武高铁通信车间|";s:4:"1.4.";s:35:"郑州通信段|洛阳通信车间|";s:5:"1.11.";s:41:"郑州通信段|郑州综合通信车间|";s:4:"1.9.";s:35:"郑州通信段|郑西高铁车间|";s:5:"1.12.";s:35:"郑州通信段|开封通信车间|";s:5:"1.13.";s:35:"郑州通信段|济源通信车间|";s:5:"1.14.";s:35:"郑州通信段|新乡通信车间|";s:5:"1.15.";s:35:"郑州通信段|南阳通信车间|";s:5:"1.16.";s:35:"郑州通信段|长北通信车间|";s:5:"1.17.";s:35:"郑州通信段|三西通信车间|";s:5:"1.18.";s:41:"郑州通信段|平顶山西通信车间|";s:5:"1.19.";s:41:"郑州通信段|郑州无线通信车间|";s:5:"1.20.";s:41:"郑州通信段|洛阳无线通信车间|";s:5:"1.21.";s:41:"郑州通信段|新乡无线通信车间|";}s:5:"width";i:250;s:6:"frozen";b:1;s:6:"editor";s:576:" <div id="selectCanton"></div>
			<input type="hidden" id="canton_fdn" name="canton_fdn" class="dataOpeSearch likeRight" value="{$objectData.canton_fdn}" />
			<script type="text/javascript">
				$(function(){
					var canton_fdn = $("#canton_fdn").val();
					$.get("/Api/Canton/getSelectSelectSelectAll/",function(data){
						$.selectselectselect(data,"selectCanton",canton_fdn,"0",function(t){
							$("#canton_fdn").val($(t).val());
							$("#selectCanton").find("select").attr("style","width:150px");
							
						});
					},"json");
				});
			</script>";s:4:"name";s:10:"canton_fdn";}s:9:"create_id";a:6:{s:4:"type";s:3:"int";s:4:"size";i:10;s:5:"title";s:26:"<center>创建人</center>";s:4:"hide";i:7;s:4:"name";s:9:"create_id";s:5:"width";s:2:"80";}s:11:"create_time";a:5:{s:4:"type";s:9:"timestamp";s:5:"title";s:29:"<center>创建时间</center>";s:4:"hide";i:7;s:4:"name";s:11:"create_time";s:5:"width";s:2:"80";}}