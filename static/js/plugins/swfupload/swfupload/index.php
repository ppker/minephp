<%@ page session="true" pageEncoding="UTF-8" contentType="text/html; charset=UTF-8" %>
<!DOCTYPE html>
<html>
<head>
<title>SWFUpload Demos - Simple Demo</title>
<link href="css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="swfupload/swfupload.js"></script>
<script type="text/javascript" src="js/swfupload.queue.js"></script>
<script type="text/javascript" src="js/fileprogress.js"></script>
<script type="text/javascript" src="js/handlers.js"></script>
<script type="text/javascript">
		var swfu;
		
		var queryString = function() {
			// This function is anonymous, is executed immediately and
			// the return value is assigned to QueryString!
			var query_string = {},
				query = self.location.search.substring(1),
				i = 0,
				pair = [],
				arr = [],
				vars = query.split("&");
				
			for (i; i < vars.length; i++) {
				pair = vars[i].split("=");
				// If first entry with this name
				if ( typeof query_string[pair[0]] === "undefined") {
					query_string[pair[0]] = pair[1];
					// If second entry with this name
				} else if ( typeof query_string[pair[0]] === "string") {
					arr = [query_string[pair[0]], pair[1]];
					query_string[pair[0]] = arr;
					// If third or later entry with this name
				} else {
					query_string[pair[0]].push(pair[1]);
				}
			}
			return query_string;
		}();

		window.onload = function() {
			var settings = {
				use_query_string : true,
				flash_url : "swfupload/swfupload.swf",
				upload_url: "http://www.uinnova.cn/Upload",
				post_params: {
					"type": queryString.type,
					"sessionid" : "<%=session.getId() %>",
					"userid" : window.parent.USERINFO.userid
				},
				file_size_limit : "50 MB",
				file_types : "*.gif;*.png;*.jpg;*.jpeg;*.bmp",
				file_types_description : "All Files",
				file_upload_limit : 100,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings
				button_image_url: "images/TestImageNoText_65x29.png",
				button_width: "65",
				button_height: "29",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: '<span class="theFont">选择</span>',
				button_text_style: ".theFont { font-size: 16; }",
				button_text_left_padding: 12,
				button_text_top_padding: 3,
				
				// The event handler functions are defined in handlers.js
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
			};

			swfu = new SWFUpload(settings);
	     };
	</script>
</head>
<body>
<div id="content">

			<form id="form1" action="" method="post" enctype="multipart/form-data">
				<div class="fieldset flash" id="fsUploadProgress">
					<span class="legend">上传队列</span>
				</div>
				<div id="divStatus">
					0 Files Uploaded
				</div>
				<div>
					<span id="spanButtonPlaceHolder" style="background:blue;"></span>
					<input id="btnCancel" type="button" value="Cancel All Uploads" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
				</div>

			</form>
		</div>
</body>
</html>

