
(function($){
	$.fn.serializeJson = function()
	{
	    var o = {};
	    var a = this.serializeArray();
	    //console.log(a);alert('ddaa');
	    $.each(a, function() {
	        if (o[this.name] !== undefined) {
	            if (!o[this.name].push) {
	                o[this.name] = [o[this.name]];
	            }
	            o[this.name].push(this.value || '');
	        } else {
	            o[this.name] = this.value || '';
	        }
	    });
	  	
	    return o;
	};
		
	
	
})(jQuery);
