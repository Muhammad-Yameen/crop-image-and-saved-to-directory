<?php 

if(isset($_POST)){
	$result = @unlink($_POST['path']);
	if( $result ) {
		echo "success";
	}else{
		echo "cannot find path";
	}
}else{
	echo 'fail';
}