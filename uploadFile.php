<?php
require 'usefull.php';
$useFul = new UseFullFunctions();

	$result = '';
	if( method_exists( $useFul , "uploadFile" ) ) {
		$config = [
			'field_name' 	=> 'image',
			'directory'  	=> 'uploads',
			'maxsize' 	 	=> '1000000',
			'allow_files' 	=> 'jpg|png|jpeg|zip',
			'dimensions' 	=> [
				"width" 	=> 200,
				"height" 	=> 200
			],
		];
	 	$result  = $useFul->uploadFile($config,true);	
	}
echo   json_encode($result);
exit();