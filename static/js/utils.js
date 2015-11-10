
(function(MAIN, $){
	
	"use strict";
	
	var self = MAIN.nameSpace.reg("utils"),
		userInfo = null,
		templateCache = {},
		setMap = null;
	
	
	self.isIE = function(version, comparison ){
		var $div = null,
			ieTest = null;
			
	    $div = $('<div style="display:none;"/>').appendTo($('body'));
	    $div.html('<!--[if '+(comparison||'')+' IE '+(version||'')+']><a>&nbsp;</a><![endif]-->');
	    ieTest = $div.find('a').length;
	    $div.remove();
	    
	    return ieTest;
	};
	
	
	self.isPassForm = function($form){
		var validator = null;
		
		validator = $form.data('bs.validator');
		validator.validate();
		
		return !(validator.isIncomplete() || validator.hasErrors());
	};
	
	
	self.showFormMsg = function($info, msg, flag){
        var className = flag ? "alert-success" : "alert-danger";

        $info.removeClass("alert-success");
        $info.removeClass("alert-danger");

        $info.addClass(className);
        $info.html(msg).css("opacity", 1);
	};

	self.isArray = function(someDing){
		return someDing instanceof Array || Object.prototype.toString.apply(someDing) === '[object Array]';
	};

    self.isObject = function(someDing){
        return someDing instanceof Object || Object.prototype.toString.apply(someDing) === '[object Object]';
    };

	self.render = function(templateUrl, dict, func){
		var template = "",
			url = "",
			result = "",
			html = "",
			key = "";
		
		url = templateUrl.charAt(1) === "/" ?  templateUrl : "/" + templateUrl;
		url = MAIN.define.templatesDir + url;
		key = md5(url);
		
		if(MAIN.define.isCacheTemplate && (key in templateCache) ){
			template = templateCache[key];
		}else{	
			result = $.ajax({ url: url, async: false });
			if( result.readyState === 4 &&  result.status === 200  ){
				template = $.trim(result.responseText);
				if(MAIN.define.isCacheTemplate){
					templateCache[key] = template;
				}
			}else{
				throw new Error(result.statusText);
			}
		}
		
		html = Handlebars.compile(template)(dict);
		(typeof func === "function" && func(html));
		return html;
	};
	
	
	self.listToTree = function(list){
		var loop = null,
			tree = [],
			putTree = null,
			loop = null,
			reMase = {},
			i = 0;
		
		loop = function(list, item){
			var i = 0;
			
			for(i=0; i<list.length; i++){
				if(list[i].id === item.parent_id){
					list[i].children = item;
					return;
				}else if(self.isArray(list[i].children)){
					return loop(list[i].children, item);
				}
			}

		};
		
			
		for(i=0; i<list.length; i++){
			if(list[i].parent_id === "0"){
				tree.push(item);
			}
		}
		
		return tree;
	};


	self.filterEmployeeByDepartId = function(departmentData,employeeData, id){
		var arr = [],
			ids = [],
			isPush = false,
			getTree = null,
			loop = null;

		getTree = function(list){
			var arr = [],
				result = null,
				i = 0;

			for(i=0; i<list.length; i++){
				if(list[i].id === id){
					return [list[i]];
				}

				if(list[i].children){
					result = getTree(list[i].children);
					if(result){
						return result;
					}
				}
			}
		};

		loop = function(list){
			$.each(list, function(){
				ids.push(this.id);
				if(this.children){
					loop(this.children);
				}
			});
		};

		loop(getTree(departmentData));

		$.each(employeeData, function(){
			if($.inArray(this.department_id, ids) >= 0){
				arr.push(this);
			}
		});

		return arr;
	};


	self.randint = function(n, m){
		var c = m-n+1;
		return Math.floor(Math.random() * c + n);
	};

	self.failCallBack = function(result){
		$.messager.alert(result.message);
	};

	self.getUserInfo = function(){
		
		if(!userInfo){
			YAN.api.getUserInfo({
				async: false,
				successCallBack: function(result){
					userInfo = result.data;
					//userInfo.is_manager = false;
				},
				failCallBack: function(result){
					$.messager.alert(result.message);
					if(result.message === "未登陆"){
						self.dumpUrl("/");
					}
				}
			});
		}

		return userInfo;
	};

	self.createCookie = function(name, value, days) {
		var expires;

		days = days ? days : YAN.define.cookieDay;

		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			expires = "; expires=" + date.toGMTString();
		} else {
			expires = "";
		}
		document.cookie = name + "=" + value + expires + "; path=/";
	};

	self.getCookie = function(c_name) {
		var c_start = 0,
			c_end = 0;

		if (document.cookie.length > 0) {
			c_start = document.cookie.indexOf(c_name + "=");
			if (c_start != -1) {
				c_start = c_start + c_name.length + 1;
				c_end = document.cookie.indexOf(";", c_start);
				if (c_end == -1) {
					c_end = document.cookie.length;
				}
				return unescape(document.cookie.substring(c_start, c_end));
			}
		}
		return "";
	};

	self.delCookie = function(name) {
		self.createCookie(name,"",-1);
	};

	self.dumpUrl = function(url){
		window.setTimeout(function(){
			window.location.href = url;
		}, YAN.define.dumpTimeout);
	};

	self.dumpReload = function(){
		window.setTimeout(function(){
			window.location.reload();
		}, YAN.define.dumpTimeout);
	};

    self.openNew = function(url,name,left,top,width,height,resizable,scrollbars,location){
        window.open(url,name,'left='+left+',top='+top+',width='+width+',height='+height+',resizable='+resizable+',scrollbars='+scrollbars+',location='+location);
    };
	self.randstr = function(length){
		var key = {

			str : [
				'a','b','c','d','e','f','g','h','i','j','k','l','m',
				'o','p','q','r','s','t','x','u','v','y','z','w','n',
				'0','1','2','3','4','5','6','7','8','9'
			],

			randint : function(n,m){
				var c = m-n+1;
				var num = Math.random() * c + n;
				return	Math.floor(num);
			},

			randStr : function(){
				var _this = this;
				var leng = _this.str.length - 1;
				var randkey = _this.randint(0, leng);
				return _this.str[randkey];
			},

			create : function(len){
				var _this = this;
				var l = len || 10;
				var str = '';

				for(var i = 0 ; i<l ; i++){
					str += _this.randStr();
				}

				return str;
			}

		};

		length = length ? length : 10;

		return key.create(length);
	};


	self.reportSearch = function(op, func){
		YAN.utils.render("other/reportSearchForm.html", op, function(html){
			var $form = null;
			op.$main.html(html);
			$("#start_date, #end_date").each(function(){
				$(this).datetimepicker();
			});
			$form = op.$main.find(">form");
			$form.submit(function(e){
				e.preventDefault();
				func($form.serializeJson());
			});
		});
	};

	self.signSearch = function(op, func){
		YAN.utils.render("other/signSearchForm.html", op, function(html){
			var $form = null;
			op.$main.html(html);
			$("#start_date,#end_date").each(function(){
				$(this).datetimepicker();
			});
			$form = op.$main.find(">form");
			$form.submit(function(e){
				e.preventDefault();
				func($form.serializeJson());
			});
		});
	};

	self.getQuery = function(obj){
		var params = [];
		$.each(obj, function(key){
			if(obj[key]){
				params.push(key+"="+obj[key]);
			}
		});
		return params.join("&");
	};


	self.explortData = function(func){
		$("#exportData").remove();
		YAN.utils.render('other/exportData.html', null, function(html){
			var $main = null;
			$("body").append(html);
			$main = $("#exportData");
			$main.modal("show");
			$("#exportConfirm").click(function(){
				var data = {};
				$main.modal("hide");

				if($("*[name=querytype]:checked")){
					data.start_date = $("#start_date").val();
					data.end_date = $("#end_date").val();
				}

				if(typeof func === "function"){
					func(data);
				}
			});
		});
	};

	self.selectDepart = function(dfValue, func){
		$("#selectDepartmentModal").remove();

		YAN.api.departmentTree({
			successCallBack: function(result){
				YAN.utils.render("other/selectDepartment.html", null, function(html){
					var $select = null,
						$main = null,
						depName = [],
						getName = null,
						splitChar = " > ",
						init = null;

					$("body").append(html);
					$main = $("#selectDepartmentModal");
					$select = $main.find("select");
					getName = function(name){
						if(depName.length>=1){
							return [depName.join(splitChar), name].join(splitChar);
						}else{
							return name;
						}
					};

					init = function(list){
						$.each(list, function(){
							var option = null;
							option = document.createElement("option");
							option.innerHTML = getName(this.name);
							option.value = this.id;
							option.selected = dfValue == this.id ? true : false;
							$select.append(option);

							if(YAN.utils.isArray(this.children)){
								depName.push(this.name);
								init(this.children);
								depName.pop();
							}
						});
					};

					init(result.data);
					$main.modal("show");
					$("#selectDepartmentModalConfirm").click(function(){
						$main.modal("hide");
						if(typeof func === "function"){
							func($select.val());
						}
					});
				});

			},
			failCallBack: YAN.utils.failCallBack
		});
	};
	/*填充下拉框选项*/
    self.selectInit = function(list,id,selectedValue){
        var $select = $("select#"+id);
        $.each(list, function(){
            var option = document.createElement("option");
            option.value = this.id;
            option.innerHTML = this.name;
			option.selected = selectedValue == this.id ? true : false;
            $select.append(option);
        });
    };
    /**初始化顶部导航（top）*/
    self.topMenuInit = function(tabName){
        YAN.api.getMenuList({
            data:null,
            successCallBack:function(result){
                if(YAN.utils.isArray(result.data) || YAN.utils.isObject(result.data)){
                    YAN.utils.render("other/topMenu.html", {
                        list: result.data
                    }, function(html){
                        $("#topMenu").html(html);
                        $("*[tab-name="+tabName+"]").addClass("active");
                    });
                }
            }
        });
    };
    /**初始化顶部&左侧导航（top&left）*/
    self.topLeftMenuInit = function(parentName,tabName,leftName){
        YAN.api.getMenuList({
            data:null,
            successCallBack:function(result){
                if(YAN.utils.isArray(result.data) || YAN.utils.isObject(result.data)){
                    YAN.utils.render("other/topMenu.html", {
                        list: result.data
                    }, function(html){
                        $("#topMenu").html(html);
                        $("*[tab-name="+tabName+"]").addClass("active");
                    });
                    $.each(result.data,function(){
                        if(this.tabName == parentName){
                            YAN.utils.render("other/leftMenu.html", {
                                list: this.child
                            }, function(html){
                                $("#leftMenu").html(html);
                                $(".list-group").find(".list-group-item[name="+leftName+"]").addClass("active");
                            });
                        }
                    });
                }
            }
        });
    };
    /**初始化左侧静态导航*/
    self.leftStaticMenuInit = function(tempUrl,menuTitle){
        if(menuTitle){
            $("#leftMenuTitle").html(menuTitle);
        }else{
            $("#leftMenuTitle").html("面板导航");
        }
        YAN.utils.render(tempUrl,{},function(html){
            $("#leftMenu").html(html);
        });
    }
    //初始化地图
    self.setMap = function(id){
    	// 百度地图API功能
    	var map = new BMap.Map(id);
    	map.addControl(new BMap.NavigationControl());               // 添加平移缩放控件
    	var point = new BMap.Point(YAN.define.mapCenterPosition[0],YAN.define.mapCenterPosition[1]);
    	map.centerAndZoom(point,YAN.define.mapZoom);
    	map.enableScrollWheelZoom();

    	function myFun(result){
    		var cityName = result.name;
    		map.setCenter(cityName);
    	}
    	var myCity = new BMap.LocalCity();
    	myCity.get(myFun);

        map.addEventListener("click", function(e) {
            var myGeo = new BMap.Geocoder();
            var adds =  new BMap.Point(e.point.lng,e.point.lat);
            var marker1 = new BMap.Marker(adds); // 创建标注
            map.clearOverlays();
            map.addOverlay(marker1); // 将标注添加到地图中
            //根据标注获取具体地址写入地址框
            myGeo.getLocation(adds, function(rs){
                var address = rs.address;
                $("input[name='address']").val(address);
            });
            $('#longitude').val(e.point.lng);
            $('#latitude').val(e.point.lat);
        });
    };
    self.employeeView=function(id){
		var employeeListInfo={},
		employeeListActive={},
		employeeListPlan={},
		employeeListReport={};
		YAN.api.employeeViewProfile({
			async:false,
			data: {id:id},
			successCallBack: function(result){
				employeeListInfo=result.data;
			},
			failCallBack: YAN.utils.failCallBack
		});
		YAN.api.employeeViewActive({
			async:false,
			data:{id:id},
			successCallBack:function(result){
				employeeListActive=result.data
			},
			failCallBack:YAN.utils.failCallBack
		});
		YAN.api.employeeViewPlan({
			async:false,
			data:{id:id},
			successCallBack:function(result){
				employeeListPlan=result.data
			},
			failCallBack:YAN.utils.failCallBack
		});
		YAN.api.employeeViewReport({
			async:false,
			data:{id:id},
			successCallBack:function(result){
				employeeListReport=result.data
			},
			failCallBack:YAN.utils.failCallBack
		});
		var table = $("#employeeView_info");
		
		YAN.utils.render("view/employeeView.html", {
                employeeInfo:employeeListInfo,
                employeeActive:employeeListActive,
                employeePlan:employeeListPlan,
                employeeReport:employeeListReport
			}, function(html){
			    table.html(html);
		});
		$("#employeeView").modal("show");
		$("#employeeView").on("click","[actionrule=activeMap]",function(){		
	        var pointArr = $(this).attr('actionid');
	        var num=pointArr.indexOf("-");
	        var longitude=pointArr.substr(0,num);
	        var latitude=pointArr.substr(num+1);
	        var activeMap = new BMap.Map("activeContainer");

	    	activeMap.addControl(new BMap.NavigationControl());               // 添加平移缩放控件
	    	activeMap.enableScrollWheelZoom();    // 添加平移缩放控件
	    	activeMap.clearOverlays();
	      
	        	var point = new BMap.Point(longitude,latitude);
	        	activeMap.centerAndZoom(point,12);
	            //将员工巡视签到位置添加到地图上
	            var ePoint=new BMap.Point(longitude,latitude);
	            var emarker = new BMap.Marker(ePoint);
	            activeMap.addOverlay(emarker);// 将标注添加到地图中            
	            /**文本框形式的标注*/
	            var eopts = {
	          		  position : ePoint,    // 指定文本标注所在的地理位置
	          		  offset   : new BMap.Size(20, -25)    //设置文本偏移量
	          	}
	        $("#activeModal").modal("show");
	        
	    });
		 //		setMap("#activeContainer");
	};
    self.dateFormat = function(time,format){
        if(time == ''){
            var date = new Date();
        }else{
            var date = new Date(time.replace(/-/g,   "/"));
        }
        var year=date.getFullYear();
        var month=date.getMonth() + 1;
        var day=date.getDate();
        var hour = date.getHours();
        var min = date.getMinutes();
        var sec = date.getSeconds();
        month = month>=10?month:'0'+month;
        day = day>=10?day:'0'+day;
        hour = hour>=10?hour:'0'+hour;
        min = min>=10?min:'0'+min;
        sec = sec>=10?sec:'0'+sec;
        if(format == 'Y-m-d'){
            return year + '-' + month + '-' + day;
        }else if(format == 'Y-m-d H'){
            return year + '-' + month + '-' + day + ' ' + hour;
        }else if(format == 'Y-m-d H:i'){
            return year + '-' + month + '-' + day + ' ' + hour + ':' + min;
        }else if(format == 'Y-m-d H:i:s'){
            return year + '-' + month + '-' + day + ' ' + hour + ':' + min + ':' + sec;
        }
    };
    /*
     * 获得时间
     */
    self.formsData=function(){
    	var formsData = {};
        formsData.forms = 1;
        var todayDate = YAN.utils.dateFormat('','Y-m-d');
        if(typeof YAN.define.urlParams.start_date != 'undefined'){
            formsData.start_date = YAN.define.urlParams.start_date;
            $("#start_date").val(YAN.define.urlParams.start_date);
        }else{
            $("#start_date").val(todayDate);
        }
        if(typeof YAN.define.urlParams.end_date != 'undefined'){
            formsData.end_date = YAN.define.urlParams.end_date;
            $("#end_date").val(YAN.define.urlParams.end_date);
        }else{
            $("#end_date").val(todayDate);
        }
        $("#start_date, #end_date").each(function(){
            $(this).datetimepicker({
                pickTime: false,
                defaultDate:$(this).val()
            });
        }); 
        return formsData;
    };
    
})(YAN, jQuery);
