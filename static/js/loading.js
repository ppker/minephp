(function(MAIN, $){
	"use strict";
	var self = MAIN.nameSpace.reg("loading"),
		id = "loading",
		$id = '#' + id;
	self.show = function(){
		var bg = null,
			content = null,
			winHeight = $(window).height();
			content = null;

		if($($id).length >= 1){
			$($id).show();
		}else{
			bg = document.createElement("div");
			bg.id = id;
			bg.style.cssText = [
				"position: fixed",
				"background: #FFF",
				"opacity: 0.7",
				"left: 0",
				"top: 0",
				"display: none",
				"z-index: 99999999",
				"window: 100%",
				"height: " + winHeight + "px"
			].join(";");

			content = document.createElement("img");
			content.className = "pscc";
			content.src = MAIN.define.loadingImg;
			bg.appendChild(content);
			$("body").append(bg);

			$(bg).show();
		}
	};

	self.hide = function(){
		$($id).fadeOut();
	};
	
})(YAN, jQuery);