/**
 * DataOpe的扩展js操作，比如：删除、修改、状态改变等等。
 * */
function dataOpeAdd(initData,dialogTitle){
	//alert('11111');
    $.dialog({
        id:"editObject",
        title:dialogTitle,
        content:'正在加载页面!<img src="' + PUBLIC_URL + '/public/loading.gif" />',
        esc:true,
        lock:true,
        padding:"5",
        ok:function(){
            //alert('ssss');
            if($("#itemAddForm").length<1) return true;
            $("#itemAddForm").attr("action",Y_URL + "/save");
			//alert(URL_URL);
			
            $('#itemAddForm').submit();
            
            return false;
        },
        okValue:"确定",
        cancelValue:"取消",
        cancel:function(){},
        initialize:function(){
            //alert(Y_URL);
            var theThis   	= this;
            $.get(Y_URL + "/add?" + initData,function(html){
                theThis.content(html);
                //需要排除日期类型的输入框(日期类型的输入框在获得焦点后不能弹出日期选择框.)
                $(theThis.dom.main).contents().find(":input:visible").not(".Wdate").eq(0).focus();
            });
        }
    });
}

function dataOpeEdit(id,dialogTitle,modelName){
    // alert('sss');
	var this_post_url	= Y_URL;
	if(dialogTitle=="" || dialogTitle==0 || dialogTitle==undefined) dialogTitle=$("#modelInfo_editTitle").val();
	if(dialogTitle=="" || dialogTitle==0 || dialogTitle==undefined) dialogTitle="修改";
	if(modelName!=undefined) this_post_url	= Y_URL + "/" + modelName;
    $.dialog({
        id:"editObject",
        title:dialogTitle,
        content:'正在加载页面!<img src="' + PUBLIC_URL + '/public/loading.gif" />',
        esc:true,
        padding:"5",
        lock:true,
        ok:function(){
            if($("#itemAddForm").length<1) return true;
            $("#itemAddForm").attr("action",this_post_url + "/save");
            $('#itemAddForm').submit();
        
            return false;
        },
        okValue:"保存",
        cancelValue:"取消",
        cancel:function(){},
        initialize:function(){
            var theThis   	= this;
            //alert(this_post_url);
            $.get(this_post_url + "/edit/" + id,function(html){
                theThis.content(html);
            });
        }
    });
}

function dataOpeDelete(id,msg){
	if(msg==undefined) msg="确定要删除此数据?";
    $.dialog({
        id:"deleteDataOpeItem",
        title:"提醒",
        lock:true,
        content:msg,
        ok:function(){
            _this	= this;
            $.get(Y_URL+"/delete/"+id,function(data){
                if(data[2]){
                    Sigma.GridCache["theDataOpeGrid"].reload();
                }
                _this.time(2000).title("提示").content(data[1]).button({
                    id: 'ok',
                    disabled: true
                },{
                    id:'cancel',
                    value:'关闭'
                });
            },"json");
            return false;
        },
        okValue:"确定",
        cancel:function(){},
        cancelValue:"取消"
    });
}

/**
 * 数据查询函数
 * */
function getDataSearchUrl(){
	var para	= new Object();
    $("input.dataOpeSearch,select.dataOpeSearch").each(function(){
        if($(this).val()=="") return;
        if($(this).attr("type")=="checkbox"){
        	 if($(this).attr("checked")=="checked"){
                 para[$(this).attr("id")]	= $(this).val();
             }
        }else if($(this).attr("type")=="radio"){
            if($(this).attr("checked")=="checked"){
                para[$(this).attr("id")]	= $(this).val();
            }
        }else{
            var tPara	= $(this).val();
            if($(this).hasClass("likeLeft")) tPara	= "%" + tPara;
            if($(this).hasClass("likeRight")) tPara	= tPara + "%";
            para[$(this).attr("id")]	= tPara;
        }
    });
    para = jQuery.param(para);
    return para;
}

/**
 * [dataOpeSearch 搜索函数]
 * @param  {[type]} noAllData [description]
 * @return {[type]}           [description]
 */
function dataOpeSearch(noAllData){
    /*因为 dxGrid是在api的函数内部进行使用的 所以这里要对某些方法进行重新定义，此处会出现代码冗余，以后待优化*/
    var dxGrid = window.new_dxGrid;
    //dxGrid.setBaseURL(Y_URL);
	//alert('dfdfdfdfd111');
    if(noAllData){
    	//console.log(getDataSearchUrl());
    	dxGrid.query(getDataSearchUrl());
		
    }else{
        dxGrid.query("");
    }
    //window.new_dxGrid = null;
}


function resetPasswd(id){
	$.dialog({
        id: 'Prompt',
        fixed: true,
        lock: true,
        title:"重置密码",
        content: [
              '<div style="margin-bottom:5px;font-size:12px">确认重置密码（123456）？</div>'
            ].join(''),
        initialize: function () {
        },
        ok: function () {
        	var _this	= this;
        	$.get(Y_URL + "/resetPassword?i="+id,
        			function(data){
		                _this.content(data.info).time(2000).button({
		                    id: 'ok',
		                    disabled: true
		                },{
		                    id:'cancel',
		                    value:'关闭'
		                });
		        	},"json");
            return false;
        },
        okValue:"确定",
        cancel: function () {},
        cancelValue:"取消"
    });
}

/**
 * 上传文件 for  add  edit
 * acceptFileTypes : fileType,
 * uploadTemplateId : uploadTemplateId,
 * templatesContainer : tmplContainer,
 * */
function uploadFile(fileObject,options){
	option	= $.extend(options,{
		url:APP_URL + "/Basic/upload_file",
		dataType : 'json',
		autoUpload : true,
		fileInput:$(fileObject).find("input[type='file']"),
		singleFileUploads : true,
		forceIframeTransport:true,
        uploadTemplateId: 'template-upload',
        downloadTemplateId: 'template-download'
		});
	//alert(fileupload);
	fileObject.fileupload(option);
}
/**
 * 打开剪切头像对话框
 * */
function showUploadPhoto(img,input){
    $.dialog({
        id:"upload_cut_photo",
        title:"上传头像",
        lock:true,
        ok:function(){
        	var xyz	= $("#selectXY");
        	if(xyz.text()==""){
        		showDialog("提醒","请先上传头像文件!");
        		return false;
        	}
        	if(xyz.width()==0 || xyz.height()==0){
        		showDialog("提醒","请先选择头像区域!");
        		return false;
        	}
        	var _this	= this;
            $.ajax({
                type : "POST",
                url : APP_URL + "/Basic/cut_img",
                data : {"img":xyz.text(),
        		 "width":xyz.width(),"height":xyz.height(),
        		 "left":xyz.css("marginLeft"),
        		 "top":xyz.css("marginTop")},
                success : function(data){
	            	if(data.status){
	            		img.attr("src",APP_URL + "/" + (data.data.url).substring(1));
	            		input.val(data.data.file);
                        _this.content(data.info).time(2000).button({
                            id: 'ok',
                            disabled: true
                        },{
                            id:'cancel',
                            value:'关闭'
                        });
	            	}else{
	            		showDialog("错误",data.info);
	            	}
	            },
                dataType : "json"
            });
            return false;
        },
        okValue:"确认裁剪并提交",
        cancel:function(){},
        cancelValue:"取消",
        initialize:function(){
            var theThis   	= this;
            $.get(Y_URL + "/Basic/upload_photo",function(html){
                theThis.content(html);
            });
        }
    });
}

/**
 * 将html中的url全部下载 
 */
function downLoadAllFile(obj){
	var url	= $(obj).find(a[download]);
	$(url).each(function(index,a){
	    window.open($(a).attr("href"));
	});
}


/**
 * 将textTo对象与数据列表绑定。。在选择改变时，也改变此值
 */
(function($){
  $(function(){
    $("input.textTo[type='hidden']").each(function(i,textTo){
      toId  = $(textTo).attr("id");
      if(toId.charAt(0)=="i"){      //radio checkbox 的值
        $(textTo).val($(toId + ":checked").attr("text"));
        $(toId).change(function(){
          $(textTo).val($(this).attr("text"));
        });
      }else if(toId.charAt(0)=="s"){      //select的值
        $(textTo).val($(toId).val()==""?"":$(toId).find('option:selected').text());
        $(toId).change(function(){
          if($(this).val()=="")
            $(textTo).val("");
          else
            $(textTo).val($(this).find('option:selected').text());
        });
      }
    });
  });
})(jQuery);

/**处理多选select值*/
function _dataope_onSetChange(obj){
    var _this=$(obj);
    var ret=[];
    _this.find("option").each(function(idx, e){
        if($(e).attr("selected")){
            ret.push($(e).attr("value"));
        }
    });
    _this.next('input').val(ret.join(","));
    return false;
}

/**处理多选项(checkbox)值*/
function _dataope_onCheckChange(obj){
    var _this=$(obj);
    var ret=[];
    var p=_this.parentsUntil(".checkset").parent();
    p.find(".checkitem").each(function(idx, e){
        if($(e).attr("checked")){
            ret.push($(e).attr("value"));
        }
    });
    p.find(".checksetval").val(ret.join(","));
    return false;
}



//
function ajaxValidationCallback(status, form, json, options){
	if (status === true) {
		form.submit();
	}
}
//数据验证后，自动执行此操作。
function formSubmitComplete(form, r){
	if(r){
	    //触发savedata事件,用于支持fckeditor保存数据.
	    $('#itemAddForm').find(":input").trigger("savedata");
	    var theThis		= $.dialog.get('editObject');
	    
	    //alert($("#itemAddForm").attr("action")); /Api/Account/save
	    
	    $.ajax({
	        type : "POST",
	        url : $("#itemAddForm").attr("action"),
	        data : $("#itemAddForm").serialize(),
	        success : function(msg) {
                // console.log(msg);
	            if (msg[2] == 0) {
	                showDialog("提示",msg[1]);
	            } else {
	            	if(Sigma.GridCache["theDataOpeGrid"]){
	            		//alert('ssssss1');
	            		if(window.xtz==true) location.reload(); 
	            		else Sigma.GridCache["theDataOpeGrid"].reload();
	            	}
	                theThis.content(msg[1]).time(2000).button({
	                    id: 'ok',
	                    disabled: true
	                },{
	                    id:'cancel',
	                    value:'关闭'
	                });
	            }
	        },
	        dataType : "json"
	    });
	}
	return false;
}