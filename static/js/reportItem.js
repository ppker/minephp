(function(){
	"use strict";
	var self = null,
		getTemplate = null,
		addItem = null,
		ct = null,
		items = {};

	items.input = {
		label: "单行文本输入",
		tip: ["单行文本限制为1-20个字符", "主要用于输入姓名、各种名称、标题、地点等只需要一行就可完成的信息"]
	};

	items.textarea = {
		label: "多行文本输入",
		tip: ["多行文本最多可输入2000个字符", "可用于各种日志、描述、总结等适用于较长的信息输入"]
	};

	items.data = {
		label: "选择日期",
		tip: ["用于日期输入，用选择的方式输入日期"]
	};

	items.datetime = {
		label: "选择日期和时间",
		tip: ["用于输入一个具体的时间，精确到时分"]
	};

	items.address = {
		label: "输入地址",
		tip: ["创建省、市、级，详细地址的三级地址输入，并支持与定位结合的快捷输入"]
	};

	items.phone = {
		label: "输入电话",
		tip: ["可输入联系电话，手机号或固定电话皆可", "用于汇报各种联系方式"]
	};

	itmes.quantity = {
		label: "输入数量",
		tip: ["供用户输入数量信息，可指定单位", "可用于费用金额、库存、产品数量等方面的信息"],
		selection: function(o, key){
			var dom = getTemplate("单位"),
				$input = ct("input", "form-control item");
			o.op.$selectContent.append(dom.$row);
			dom.$main.append($input);
		},
		format: function(o, obj){
			obj.unitName = o.op.$selectContent.find(".item").val();
		}
	};

	items.radio = {
		label: "单项选择",
		tip: ["您可以设定可选的选择项，供员工选择一项"],
		selection: function(o, key){
			var _this = this,
				dom = getTemplate("可选项"),
				$btnMain = ct("div", "mt20"),
				$itemsMain = ct("div"),
				$btn = ct("button", "btn btn-xs btn-success");

			$btn.html("添加选项");
			$btnMain.append($btn);
			dom.$main.append($itemsMain);
			dom.$main.append($btnMain);
			o.op.$selectContent.append(dom.$row);
			addItem($itemsMain, false, true);
			$btn.click(function(){
				addItem($itemsMain, true, false);
			});
		},
		format: function(o, obj){
			obj.items = [];
			o.op.$selectContent.find(".item").each(function(){
				var value = $(this).find("input[type=text]").val();
				obj.items.push(value);
				if($(this).find("input[type=checkbox]").is(":checked")){
					obj.defaultVal = value;
				}
			});
		}
	};

	items.checkbox = {
		label: "多项选择",
		tip: ["您可以设定可选的选择项，供员工选择多项"],
		selection: function(o, key){
			var _this = this,
				dom = getTemplate("可选项"),
				$btnMain = ct("div", "mt20"),
				$itemsMain = ct("div"),
				$btn = ct("button", "btn btn-xs btn-success");
			$btn.html("添加选项");
			$btnMain.append($btn);
			dom.$main.append($itemsMain);
			dom.$main.append($btnMain);
			o.op.$selectContent.append(dom.$row);
			addItem($itemsMain, false, false);
			$btn.click(function(){
				addItem($itemsMain, true, false);
			});
		},
		format: function(o, obj){
			obj.items = [];
			obj.defaultVal = [];
			o.op.selectContent.find(".item").each(function(){
				var value = $(this).find("input[type=text]").val();
				obj.items.push(value);
				if($(this).find("input[type=checkbox]").is(":checked")){
					obj.defaultVal.push(value);
				}
			});
		}
	};

	addItem = function($main, isRemove, isDefault){
		var $div = ct("div", "row item"),
			$leftDiv = ct("div", "col-xs-8"),
			$rightDiv = ct("div", "col-xs-4"),
			$input = ct("input", "form-control");
		$input.attr("type", "text");
		$leftDiv.append($input);
		$div.append($leftDiv);
		$div.append($rightDiv);

		if(isRemove){
			(functioin(){
				var $removeBtn = null;
				$removeBtn = ct("button", "btn btn-danger btn-xs");
				$removeBtn.html("移除");
				$rightDiv.append($removeBtn);
				$removeBtn.click(function(){
					$div.remove();
				});
			})();
		}

		if(isDefault){
			(function(){
				var $checkDiv = ct("div", "checkbox"),
					$input = ct("input"),
					$span = ct("span"),
					$label = ct("label", "");

				$input.attr("type", "checkbox");
				$span.append("设为默认选项");
				$label.append($input);
				$label.append($span);
				$checkDiv.append($label);
				$rightDiv.append($checkDiv);
			})();
		}

		$main.append($div);
	};

	ct = function(tagName, className){
		var element = document.createElement(tagName);
		element.className = className ? className : "";
		return $(element);
	}

	getTemplate = function(labelNaae){
		var $row = ct("div", "form-group"),
			$label = ct("label", "control-label col-sm-3"),
			$main = ct("div","col-sm-9");

		$label.html(labelName);
		$row.append($label);
		$row.append($main);
		return {
			$row: $row,
			$label: $label,
			$main: $main
		}
	};

	self = function(op) {
		return new self.fn.init(op);
	};

	self.fn = self.prototype = {
		constructor: self,
		init: function(op){
			var _this = this;
			_this.op = op;
			_this.sort = [];
			_this.jsonMap = {};
			if(_this.op.json && _this.op.json.length >= 1){
				$.each(_this.op.json, function(){
					_this.createItem(this);
				});
			}
			if(op.$select){
				_this.initSelect();
			}
		}
	};

	self.fn.init.prototype = self.fn;

	self.fn.initSelect = (function(){

		var selection = function(_this, key){
			_this.op.$selectTip.html("");
			_this.op.$selectContent.html("");

			if(items[key].items){
				items[key].items = [];
			}

			if(items[key].tip){
				_this.op.$selectTip.html(items[key].tip.join("<br />"));
			}

			if(items[key].selection){
				items[key].selection(_this, key);
			}
		};

		return function(){
			var _this = this;
			$.each(items, function(key){
				var option = document.createElement("option");
				option.innerHTML = this.label;
				option.value = key;
				_this.op.$select.append(option);
			});

			_this.op.$select.change(function(){
				selection(_this, $(this).val());
			});
			selection(_this, _this.op.$select.val());
		}
	})();

	self.fn.getItem = function(callBackFn){
		var _this = this,
			hasError = [],
			o = {};
		if($.trim(_this.op.$itemName.val()) === ""){
			hasError.push("内容项名不能为空");
		}else{
			o.label = _this.op.$itemName.val();
		}

		if(_this.op.$isRequires.filter(":checked").val() === "1"){
			o.isRequire = true;
		}else{
			o.isRequire = false;
		}

		o.type = _this.op.$select.val();
		if(typeof items[o.type].format === "function"){
			items[o,type].format(_this, o);
		}

		if(hasError.length >=1){
			$.messager.alert(hasError.join("<br />"));
			throw new Error(hasError.join(","));
		}else{
			if(typeof callBackFn === "function"){
				callBackFn(o);
			}
		}

		return o;
	}

	self.fn.addItem = function(callBackFn){
		var _this = this;

		_this.getItem(function(data){
			_this.createItem(data);
			if(typeof callBackFn === "function"){
				callBackFn(data);
			}
		});
	};

	self.fn.createItem = function(obj){
		var _this = this,
			key = YAN.utils.randstr();
		_this.jsonMap[key] = obj;
		_this.sort.push(key);

		YAN.utils.render('report/'+obj.type+'.html',{key: key, data:obj}, function(html){
			var $main = null;
			_this.op.$detail.append(html);
			$main = _this.op.$detail.find("*[report-key]:last");
			$main.find("*[data-type=datetime]").datetimepicker();
			$main.find("*[data-type=date]").datetimepicker();

			if(_this.op.isEdit){
				YAN.utils.render('work/reportBtns.html', {}, function(html){
					$main.find(">div:last").html(html);
					$main.find("*[action=up]").click(function(){
						var $self = $(this).closest("*[report-key]");
						$self.prev().before($self);
					});
					$main.find("*[action=down]").click(function(){
						var $self = $(this).closest("*[report-key]");
						$self.next().after($self);
					});

					$main.find("*[action=remove]").click(function(){
						var $self = $(this).closest("*[report-key]");
						$self.fadeOut("fast", function(){
							$(this).remove();
						});
					});	
				});
			}
		});
	};

	self.fn.getJson = function(){
		var _this = this,
			json = [];

		_this.op.$detail.find("*[report-key]").each(function(){
			var key = $(this).attr("report-key");
			json.push(_this.jsonMap[key]);
		});

		return json;
	};

	MAIN.reportItem = self;

})(YAN, jQuery);