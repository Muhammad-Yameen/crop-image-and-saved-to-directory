$(document).ready(function(){
	console.log('=',"=","=","="," ","=","=","=","="," ","=","=","=","=", " ","=","=","=","="," ","=","=","=","=" ," ","=","=","=","=")
	console.log('='," "," "," "," ","="," "," ","="," ","="," "," ","=", " ","="," "," ","="," ","="," "," "," " ," ","="," "," ","=")
	console.log('='," "," "," "," ","=","=","=","="," ","="," "," ","=", " ","=","=","=","="," ","=","=","=","=" ," ","=","=","=","=")
	console.log('='," "," "," "," ","="," ","="," "," ","="," "," ","=", " ","="," "," "," "," ","="," "," "," " ," ","="," ","="," ")
	console.log('=',"=","=","="," ","="," "," ","="," ","=","=","=","=", " ","="," "," "," "," ","=","=","=","=" ," ","="," "," ","=")

	$('#uploadForm').on('submit',function(event) {
		event.preventDefault();

		var formData = new FormData();
		var filename = $("#userImage").prop("files")[0];
		formData.append('image',filename)

		$.ajax({
			method: this.method,
			url: this.action,
			data: formData,
			cache : false,
			contentType:false,
			processData: false,

		}).done(function( response ) {
			var result = JSON.parse(response);
			if (result[0].status == 200) {
				alertify.confirm().set({'startMaximized':true,labels:{ok:'Crop',cancel:'skip'}}).show(); 
				alertify.confirm('<div class="row"><div class="col-md-12"><img src="'+result[0].path+'" id="cropbox" class="img" /></div><div class="col-md-12"><img src="#" id="cropped_img" style="display: none;"></div><input type="hidden" name="x" id="x"><input type="hidden" name="y" id="y"><input type="hidden" name="w" id="w"><input type="hidden" name="h" id="h"><input type="hidden" name="image" id="image"></div>',()=>{

					let x = $('#x').val();
					let y = $('#y').val();
					let w = $('#w').val();
					let h = $('#h').val();
					let img = $('#image').val();
					let thumb = 'cropped/'+$('#image').val();
					$.get('uploadThumbnails.php?x1='+size.x+'&y1='+size.y+'&w='+size.w+'&h='+size.h+'&img='+img+'&thumb='+thumb,function(s){
						$("#result_img").show();
						$("#result_img").attr('src',s).parent().addClass('thumbnail');
						$('.report').html("<p>Old File  = "+img+"</p><p>New File  = "+s+"</p>").addClass('bgColor');
						alertify.success('Thumbnail Created Successfully');
					});
					$("#uploadForm").trigger("reset");

				},()=>{

					$('.report').html('');
					$("#result_img").show();
					$("#result_img").attr('src',result[0].path).parent().addClass('thumbnail');
					alertify.error('Your original image is in its same condition');
					$("#uploadForm").trigger("reset");

				}).show(); 

				$("#cropbox").attr('src',result[0].path);
				var size;
				$('#cropbox').Jcrop({
					aspectRatio: 0,
					onSelect: function(c){
						$('#x').val(c.x);
						$('#y').val(c.y);
						$('#w').val(c.w);
						$('#h').val(c.h);
						size = {x:c.x,y:c.y,w:c.w,h:c.h};

						$("#cropbox").css("visibility", "visible");     
						var img = $("#cropbox").attr('src');
						$('#image').val(img);
						$("#cropped_img").show();
						$("#cropped_img").attr('src','image-crop.php?x='+size.x+'&y='+size.y+'&w='+size.w+'&h='+size.h+'&img='+img);
						
					}
				});
			}
		});
	});

	$('#userImage').on('change',function(){
		var file = $(this).prop('files')[0].name;
		$('#label').next('span').text(file)
	});

	$('.grid').masonry({
	  // options
	  itemSelector: '.grid-item',
	  columnWidth: 5
	});
});
