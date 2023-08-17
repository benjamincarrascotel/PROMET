(function($) {
	//fancyfileuplod
	$('#demo').FancyFileUpload({
	params : {
		 action : 'fileuploader'
		},
		//limite tamaño maximo file
		maxfilesize : 999999999
	});
})(jQuery);