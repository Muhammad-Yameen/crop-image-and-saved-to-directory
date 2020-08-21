<?php
/*
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* 1.removes files and non-empty directories function  = rrmdir  *
* 	$dir = 'depth1/depth2/depth3';								*
* 	rrmdir($dir);												*
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* 2.copies files and non-empty directories						*
*	$src = 'depth1/depth2/file.txt';							*
* 	$dir = 'depth1/depth2/depth3/newfile.txt';					*
* 	rcopy($src,$dir);											*
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* 3.Find closest word from your given data 						*
* 	$word = 'raffid'; expected output = radish													*
*	$words  = array('apple','pineapple','banana','orange',		*
*                   'radish','carrot','pea','bean','potato');	*
*   echo closestWord($words, strtolower($word), 5);               *
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*/


class UseFullFunctions
{
	
	function __construct()
	{
		
	}
	//1. removes files and non-empty directories
	function rrmdir($dir) {
	  if (is_dir($dir)) {
	    $files = scandir($dir);
	    foreach ($files as $file)
	    if ($file != "." && $file != "..") rrmdir("$dir/$file");
	    rmdir($dir);
	  }
	  else if (file_exists($dir)) unlink($dir);
	}
	// 2. copies files and non-empty directories
	function rcopy($src, $dst) {
	  if (file_exists($dst)) rrmdir($dst);
	  if (is_dir($src)) {
	    mkdir($dst);
	    $files = scandir($src);
	    foreach ($files as $file)
	    if ($file != "." && $file != "..") rcopy("$src/$file", "$dst/$file");
	  }
	  else if (file_exists($src)) copy($src, $dst);
	}
	//3.Find closest word from your given data 	
	function closestWord($words, $input, $sensitivity){
        $shortest = -1;
        foreach ($words as $word) {
            $lev = levenshtein($input, $word);
            if ($lev == 0) {
                $closest = $word;
                $shortest = 0;
                break;
            }
            if ($lev <= $shortest || $shortest < 0) {
                $closest  = $word;
                $shortest = $lev;
            }
        }
        if($shortest <= $sensitivity){
            return $closest;
        } else {
            return 0;
        }
    }
    function makeDir($dir = '')
    {
    	$result = false;
    	if(!empty($dir)){
    		if(!is_dir($dir)){
    			mkdir($dir,0777,true);
    			$result = true;
    		}
    		$result = true;
    	}
    	return $result;
    }
    function validateFile($allow_files = '',$url = '')
    {
    	if(empty($allow_files) || empty($url)){
    		return true;
    	}
    	if(preg_match("/\.($allow_files)$/", $url)) {
		return true;	
		}
		return false;
    }
    function uploadFile($config,$isImage = false)
    {
        $field_name = $config['field_name'];
        $dir        = $config['directory'];
        $allowFiles = $config['allow_files'];
        $maxsize    = $config['maxsize'];

        $result = [];
        try {
            if( $_FILES && !empty( $_FILES[$field_name] ) && $_FILES[$field_name]['error'] == 0){
                $file           = $_FILES[$field_name];
                $target_file    = $dir.'/'.basename($file['name']);
                $tempe_file     = $file['tmp_name'];
                $validation = $this->validateFile($allowFiles,$target_file);
                if($validation){
                    $extension      = strtolower ( pathinfo ( $target_file , PATHINFO_EXTENSION ) );
                    $size           = $file['size']; 
                    if($size > $maxsize){
                        $result[] = ['status'=>401,'path'=>'','message'=>'Size must be '.$maxsize.' Kb'];
                        return $result;
                    }
                    $isCreate       = $this->makeDir($dir);
                    if($isCreate){
                        move_uploaded_file($tempe_file, $target_file);
                        $result[] = ['status'=>200,'path'=>$target_file,'message'=>'SuccessFully Added to Directory'];
                    }else{
                        $result[] = ['status'=>401,'path'=>'','message'=>'Something went wrong.Directory Not Created'];
                    }
                }else{
                        $result[] = ['status'=>401,'path'=>'','message'=>'File type Not allowed'];
                }
                if( $isImage )
                {
                    $dimenssions = @getimagesize($file["tmp_name"]);
                }
            }else{
                    $result[] = ['status'=>400,'path'=>'','message'=>'File Not Found'];
            }
        } catch (Exception $e) {
            $result[] = $e;
        }
        return $result;
    }
    function uploadFileMultiple($config,$isImage = false)
    {
        $field_name = $config['field_name'];
        $dir        = $config['directory'];
        $allowFiles = $config['allow_files'];
        $maxsize    = $config['maxsize'];

        $result = [];
        try {
            $files = $this->getMultiple_FILES();
            foreach ($files[$field_name] as $key => $file) {
                    if( $file && !empty( $file ) && $file['error'] == 0){
                        $target_file    = $dir.'/'.basename($file['name']);
                        $tempe_file     = $file['tmp_name'];
                        $validation = $this->validateFile($allowFiles,$target_file);
                        if($validation){
                            $extension      = strtolower ( pathinfo ( $target_file , PATHINFO_EXTENSION ) );
                            $size           = $file['size']; 
                            if($size > $maxsize){
                                $result[] = ['status'=>401,'path'=>'','message'=>'Size must be '.$maxsize.' Kb'];
                                return $result;
                            }
                            $isCreate       = $this->makeDir($dir);
                            if($isCreate){
                                move_uploaded_file($tempe_file, $target_file);
                                $result[] = ['status'=>200,'path'=>$target_file,'message'=>'SuccessFully Added to Directory'];
                            }else{
                                $result[] = ['status'=>401,'path'=>'','message'=>'Something went wrong.Directory Not Created'];
                            }
                        }else{
                            $result[] = ['status'=>401,'path'=>'','message'=>'File type Not allowed'];
                        }
                        if( $isImage )
                        {
                            $dimenssions = @getimagesize($file["tmp_name"]);
                        }           
                }else{
                        $result[] = ['status'=>400,'path'=>'','message'=>'File Not Found'];
                }
            }
        } catch (Exception $e) {
            $result[] = $e;
        }
        return $result;
    }
    // image resource create from file 
    function imagecreatefromfile( $filename ) {
        if (!file_exists($filename)) {
            throw new InvalidArgumentException('File "'.$filename.'" not found.');
        }
        switch ( strtolower( pathinfo( $filename, PATHINFO_EXTENSION ))) {
            case 'jpeg':
            case 'jpg':
                return imagecreatefromjpeg($filename);
            break;

            case 'png':
                return imagecreatefrompng($filename);
            break;

            case 'gif':
                return imagecreatefromgif($filename);
            break;

            default:
                throw new InvalidArgumentException('File "'.$filename.'" is not valid jpg, png or gif image.');
            break;
        }
    }

    function getMultiple_FILES() {
    $_FILE = array();
        foreach($_FILES as $name => $file) {
            foreach($file as $property => $keys) {
                foreach($keys as $key => $value) {
                    $_FILE[$name][$key][$property] = $value;
                }
            }
        }
        return $_FILE;
    }
}