<?php
error_reporting(E_ALL);
function thumb($path, $x, $y = 0)
{
    $t = getimagesize($path) or die('Unknown type of image');
    $width = $t[0];
    $height = $t[1];
    switch ($t[2]) {
        case 1:
            $type = 'GIF';
            $img = imagecreatefromgif($path);
            break;
        case 2:
            $type = 'JPEG';
            $img = imagecreatefromjpeg($path);
            break;
        case 3:
            $type = 'PNG';
            $img = imagecreatefrompng($path);
            break;
    }
    if ($y == 0) {
        $y = $x * ($height / $width);
    }

    header("Content-type: image/" . $type);
    $thumb = imagecreate($x, $y);
    imagecopyresized($thumb, $img, 0, 0, 0, 0, $x, $y, $width, $height);
    $thumb = imagejpeg($thumb);
    return $thumb;
}
$path = $_GET['path'];
$x = $_GET['x'];
$y = $_GET['y'];
if ($path && $x) {
    if($y){
        echo thumb($path, $x, $y);
    }
    else{
        echo thumb($path, $x);
    }

}