<?php
$page = 'files'; 
require 'header.php';
$path = "uploads/";
if(file_exists($path)):


$files = array_diff(scandir($path), array('.', '..'));
$files = array_values($files);
?>
<div class="row hide" id="bluck_delete_row" >
	<div class="col-md-12">
	<button class="btn btn-default" id="bluck-delete">DELETE</button>
	</div>
</div>
<div class="row grid laz">
	<?php 
	if(!$files){
		?>
	<div class="alert alert-danger">
		<b>Oops!</b> Files Not Found	
	</div>

	<?php
	}
	foreach ($files as $key => $file): ?>
	
		<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 grid-item" style="padding-bottom: 30px;">
			<label for="file<?= $key;?>">
				<input type="checkbox" style="display: none;" name="checkbox" id="file<?= $key;?>" value="<?php echo $file?>">
				<img  class="img img-responsive img-rounded" src="<?php echo $path.$file; ?>">
			<div class="btns">
				
				<a class="btn btn-default m-2" download href="<?php echo $path.$file; ?>" >
					<i class="fa fa-download"></i>
				</a>

				<a class="btn btn-default m-2" href="<?php echo $path.$file; ?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
					<i class="fa fa-link"></i>
				</a>

				
				<button class="btn btn-default btn-thumbnail m-2" id="btn-thumbnail" data-index="<?php echo $key;?>" data-path="<?php echo $path.$file; ?>"><i class="fa fa-image"></i></button>
				
				<button class="btn btn-default delete-thumbnail m-2" id="btn-thumbnail" data-index="<?php echo $key;?>" data-path="<?php echo $path.$file; ?>"><i class="fa fa-trash"></i></button>
			</div>
			</label>
			
		</div>
		
	<?php endforeach; 
else:
	?>
	<div class="alert alert-info">
	Directory Not Found	
	</div>

	<?php
endif;?>
</div>
<?php require 'footer.php'; ?>

<script type="text/javascript">
	$('.btn-thumbnail').on('click',function(){
		alertify.alert().set({'startMaximized':true}).show();
		var path = $(this).data('path');
		alertify.alert().setContent(path).show();
	});
	$('.delete-thumbnail').on('click',function(){
		var path = $(this).data('path');
		var index = $(this).data('index');
		alertify.confirm('Confirmation', 'are you sure want to delete?', ()=>{ 
			var formData = new FormData();
			formData.append('path',path);
			ajax_Request('POST',"delete_file.php",formData);
			$(this).parent().parent().remove();
			alertify.success('File deleted successfully') 
		}, 
		()=>{ 
			alertify.error('Cancel')
		});
	
	});
	
	var filter_options=[];
	$("input[type='checkbox']").click(function(){
	var checkboxes = $("input[type='checkbox']:checked").length;
        
          var val=$(this).val().trim();
          val = "uploads/"+val;

            if(this.checked)
            {
              filter_options.push(val);
		    }
		    else
		    {
		        var index=filter_options.indexOf(val);
		        if(index > -1)
		        {
		          filter_options.splice(index, 1);
		        }
		        for(var i = 0; i < filter_options.length; i++) {
		          if(filter_options[i] == val) {
		              filter_options.splice(i, 1);
		              break;
		          }
		      }
		  }
		  if(checkboxes){
			$('#bluck_delete_row').addClass('show');
		  }
		  else{
		  	$('#bluck_delete_row').removeClass('show');
		  }

	});
	$('#bluck-delete').on('click',function(){
		alertify.confirm('Confirmation', 'are you sure want to delete?', ()=>{ 
			var formData = new FormData();
			formData.append('files' , filter_options);
			const data = ajax_Request('POST','bulk_delete_file.php',formData);
			alertify.success(data);
		},()=> {
			alertify.error('cancel');
		});
	});
	 $(function() {
  $('.lazy').Lazy({
        // your configuration goes here
        scrollDirection: 'vertical',
        effect: 'fadeIn',
        visibleOnly: false,
        onError: function(element) {
            console.log('error loading ' + element.data('src'));
        },
        beforeLoad: function(element) {
        	console.log('beforeLoad');	
            // called before an elements gets handled
        },
        afterLoad: function(element) {
        	console.log('afterLoad');	
            // called after an element was successfully handled
        },
        onError: function(element) {
        	console.log('onError');	
            // called whenever an element could not be handled
        },
        onFinishedAll: function() {
        	console.log('onFinishedAll');	
            // called once all elements was handled
        }
    });
});
</script>