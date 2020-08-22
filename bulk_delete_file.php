<?php 
$array = $_POST['files'];
$files = explode(',', $array);


foreach ($files as $key => $path) {
	$result = @unlink($path);
}
if( $result ) {
	echo "success";;
}else{
	echo "fail";
}
