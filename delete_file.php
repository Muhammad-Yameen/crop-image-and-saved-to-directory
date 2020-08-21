<?php 

if(isset($_GET)){
	echo $_POST['path'];
	$result = @unlink($_POST['path']);
	if( $result ) {
		echo "success";
	}else{
		echo "cannot find path";
	}
}else{
	echo 'fail';
}