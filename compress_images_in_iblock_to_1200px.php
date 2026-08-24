<?php

//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

set_time_limit(60 * 60 * 12);

//Сжатие изображений
class SimpleImage {
    var $image;
    var $image_type;
    function load($filename) {
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if( $this->image_type == IMAGETYPE_JPEG ) {
            $this->image = imagecreatefromjpeg($filename);
        } elseif( $this->image_type == IMAGETYPE_GIF ) {
            $this->image = imagecreatefromgif($filename);
        } elseif( $this->image_type == IMAGETYPE_PNG ) {
            $this->image = imagecreatefrompng($filename);
        }
    }
    function save($filename, $compression=75, $image_type=IMAGETYPE_JPEG,  $permissions=null) {
        // do this or they'll all go to jpeg
        $image_type=$this->image_type;
        if( $image_type == IMAGETYPE_JPEG ) {
            imagejpeg($this->image,$filename,$compression);
        } elseif( $image_type == IMAGETYPE_GIF ) {
            imagegif($this->image,$filename);
        } elseif( $image_type == IMAGETYPE_PNG ) {
        // need this for transparent png to work
            imagealphablending($this->image, false);
            imagesavealpha($this->image,true);
            imagepng($this->image,$filename);
        }
        
        if( $permissions != null) {
            chmod($filename,$permissions);
        }
    }

    function output($image_type=IMAGETYPE_JPEG) {
        if( $image_type == IMAGETYPE_JPEG ) {
            imagejpeg($this->image);
        } elseif( $image_type == IMAGETYPE_GIF ) {
            imagegif($this->image);
        } elseif( $image_type == IMAGETYPE_PNG ) {
            imagepng($this->image);
        }
    }

    function getWidth() {
        return imagesx($this->image);
    }

    function getHeight() {
        return imagesy($this->image);
    }

    function resizeToHeight($height) {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width,$height);
    }

    function resizeToWidth($width) {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        return $this->resize($width, $height);
    }

    function scale($scale) {
        $width = $this->getWidth() * $scale/100;
        $height = $this->getheight() * $scale/100;
        $this->resize($width,$height);
    }
    
    function resize($width, $height, $forcesize='n') {
        //echo $width . $height;
    /* optional. if file is smaller, do not resize. */
        $real_width = intval($this->getWidth());
        $real_height = intval($this->getHeight());

        /* if ($real_height > $real_width) {
            $real_width_tmp = $real_width;
            $real_height_tmp = $real_height;

            $real_width = $real_height_tmp;
            $real_height = $real_width_tmp;
        } */

        if ($forcesize === 'n') {
            //var_dump( intval($width), intval($this->getWidth()) );
            //var_dump(intval($width) < $real_width, intval($width), $real_width);
            if (intval($width) >= $real_width ){
                //var_dump($width, ">", $this->getWidth(), $height, ">", $this->getHeight());
                
                $width = $this->getWidth();
                $height = $this->getHeight();
                //echo "Размер {$real_width}x{$real_height} уже меньше или равен {$width}x{$height} <br>";
                //return False;

                
            } else {
                
            }
        }
        //echo "Размеры: ", $width . $height;
        $new_image = imagecreatetruecolor($width, $height);
        /* Check if this image is PNG or GIF, then set if Transparent*/
        if(($this->image_type == IMAGETYPE_GIF) || ($this->image_type==IMAGETYPE_PNG)){
            imagealphablending($new_image, false);
            imagesavealpha($new_image,true);
            $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
            imagefilledrectangle($new_image, 0, 0, $width, $height, $transparent);
        }
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $real_width, $real_height);
        
        $this->image = $new_image;
    }
}

function compress_image($source_url, $destination_url, $width=1600, $compression=75) {
    $image = new SimpleImage();
    $image->load($source_url);

    if ( $image->resizeToWidth((int)$width) !== False ) {
        $image->save($destination_url, $compression);
    } 
}

function getDirContents($dir, &$results = array()){
    $files = scandir($dir);

    foreach($files as $key => $value){
        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
        if(!is_dir($path)) {         
            if (in_array(mime_content_type($path), array("image/jpeg", "image/pjpeg", "image/png"))) $results[] = $path;
            } else if($value != "." && $value != "..") {
                getDirContents($path, $results);
            //if (filetype($path) == 'file') {
                //$results[] = $path;
            //}
        }
    }
    return $results;
}

function CompressImages($dir_path) {
    //$rd = $_SERVER["DOCUMENT_ROOT"];
    $starttime = time();
	//echo($starttime);
    //$files = getDirContents($rd.'/upload/iblock');
    //$files = getDirContents($rd.'/testFolder');
    $files = getDirContents($dir_path);
    foreach ($files as $file) {
        //print(1);
        if (is_writable($file)) {
            //print( $file . "   ----   ");
            compress_image($file, $file, 1200, 90);
        } else {
            print( $file . "   ----   Нет доступа на запись <br>");            
        }
        
    }
    $endtime = time();
    echo "Затрачено " . ($endtime - $starttime) . " секунд";
    return "CompressImages();";
}

//Конец сжатия изображений
print('Start in ' . date('Y.m.d H.i.s', time()) . '\n');
CompressImages('/var/www/ucp.by/data/www/ucp.by/upload/medialibrary');
print('End in ' . date('Y.m.d H.i.s', time()) . '\n');