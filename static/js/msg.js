(function(MAIN){
	"use strict";

	var self = MAIN.nameSpace.reg("msg");

	self.ajaxLocked = "错误：Ajax请求锁定中...";
	self.confirmDeleteRole = "删除后不可恢复，确认删除此角色吗?";
	self.confirmDeleteTaskTitle = "删除任务";
	self.paramError = "错误：参数错误！";
	self.addDepartment = "部门添加";
	self.editDepartment = "部门编辑";
	self.actionTips = "操作提示";
	self.uploadError = "请先创建相册后再上传图片";
	self.noSelectedDepartment = "至少选择一个部门";
	self.noSelectedEmployee = "至少要选择一个员工";
	self.noSelectedUploadFile = "错误：没有选择上传文件";
	self.noSelectImg = "至少选择一张图片后再操作";
	self.noSelectAlbum = "没有多余的相册可选，请先创建相册后再操作";
	self.uploadSuccess = "上传成功！";
	self.signMapLabelTitle = "错误：没有填写回复内容";
	self.addAdmin = "添加管理员";
	self.startDownload = "点击此处下载";
	self.noExistEmployee = "员工不存在";
	self.noExistAdminRole = "此员工不是管理着角色";
	self.noRepeatAdmin = "不能添加重复的管理员";
	self.editAdmin= "权限修改";
})(YAN);