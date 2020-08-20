<?php
require 'header.php';
$path = "uploads/";
$files = array_diff(scandir($path), array('.', '..'));
?>

<div class="row grid">
	<?php foreach ($files as $key => $file): ?>
	
		<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 grid-item" style="padding-bottom: 30px;">
			<a class="example-image-link" href="<?php echo $path.$file; ?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img src="<?php echo $path.$file; ?>" class="img img-responsive img-rounded"></a>
			<button class="btn btn-default btn-thumbnail" id="btn-thumbnail" data-path="<?php echo $path.$file; ?>">Thumbnails</button>
		</div>
		
	<?php endforeach; ?>
</div>
<?php require 'footer.php'; ?>

<script type="text/javascript">
	$('.btn-thumbnail').on('click',function(){
		alertify.alert().set({'startMaximized':true}).show();
		var path = $(this).data('path');
		alertify.alert().setContent(path).show();
	});
</script>