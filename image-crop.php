<?php
require 'usefull.php';
$useFul = new UseFullFunctions();

$img_r = $useFul->imagecreatefromfile($_GET['img']);//imagecreatefromjpeg($_GET['img']);
$dst_r = imagecreatetruecolor( $_GET['w'], $_GET['h'] );

//imagecopyresampled($dst_r, $img_r, 0, 0, $_GET['x'], $_GET['y'], $_GET['w'], $_GET['h'], $_GET['w'],$_GET['h']);

imagecopy(
	$dst_r, $img_r,
	0, 0, $_GET['x'], $_GET['y'],
	$_GET['w'], $_GET['h']
);
header('Content-type: image/jpeg');
imagejpeg($dst_r,null,100);
exit;
?>