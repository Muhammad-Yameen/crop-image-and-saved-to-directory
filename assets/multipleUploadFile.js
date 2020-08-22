/*
* 
* Multiple File upload in Php 
*
*/

$(document).ready(function(){
	$('#multipleUploadForm').on('submit',function(event) {
		event.preventDefault();
		var files = $("#images").prop("files");
		var formData = new FormData($(this)[0]);
		var response =  ajax_Request('POST',"multipleUploadForm.php",formData);
	});
});