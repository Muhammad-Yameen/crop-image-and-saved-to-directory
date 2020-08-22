function ajax_Request(method='GET',action,formData){
	$.ajax({
		method: method,
		url: action,
		data: formData,
		cache : false,
		contentType:false,
		processData: false,
		success: ( result ) =>{
			return result;
		},
		error:(error)=>{
			return error;
		}
	});
}