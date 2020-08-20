<?php
require 'usefull.php';
$useFul = new UseFullFunctions();
$image= $_GET['img'];
$useFul->makeDir(dirname($_GET['thumb']));

list( $width,$height ) = getimagesize( $image );

//Get the new coordinates to crop the image.
$x1 = $_GET["x1"];
$y1 = $_GET["y1"];
$w = $_GET["w"];
$h = $_GET["h"];

$imgratio=$width/$height; //calculate the image ratio
if ($imgratio>1){
	$newwidth = $w;
	$newheight = $w/$imgratio;
}else{
	$newheight = $w;
	$newwidth = $w*$imgratio;
}

//$thumb = imagecreatetruecolor( $newwidth, $newheight );
//$source = $useFul->imagecreatefromfile($image);
/*  imagecopyresized($thumb, $source, 0, 0, $x1, $y1, $newwidth, $newheight, $width, $height);
imagejpeg($thumb,$image,100); 
*/


$im = $useFul->imagecreatefromfile($image);
$dest = imagecreatetruecolor($w,$h);

imagecopyresampled($dest,$im,0,0,$x1,$y1,$w,$h,$w,$h);
imagejpeg($dest,$_GET['thumb'], 100);
echo $_GET['thumb'];
exit();

