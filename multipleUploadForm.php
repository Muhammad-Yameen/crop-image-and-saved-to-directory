<?php
require 'usefull.php';
$useFul = new UseFullFunctions();

$config = [
		'field_name' 	=> 'images',
		'directory'  	=> 'uploads',
		'maxsize' 	 	=> '1000000',
		'allow_files' 	=> 'jpg|png|jpeg|zip',
		'dimensions' 	=> [
			"width" 	=> 200,
			"height" 	=> 200
		],
	];

$files  = $useFul->uploadFileMultiple($config,true);
echo json_encode($files);
exit;