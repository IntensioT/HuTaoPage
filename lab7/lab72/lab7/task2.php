<?php
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}

include('simple_html_dom.php');
$url="http://wallpaperswide.com";
$dumpDir="downloads/";
deleteDirectory("downloads");
mkdir("downloads/");
$html=file_get_html($url);
$i = 0;
foreach($html->find("a") as $a){
    $href = $a->href;
    if(!$href || strlen($href) == 1){
        $href="";
        continue;
    }
    $dirName=$a->plaintext;
    if (!file_exists($dumpDir.$dirName)) {
        mkdir("{$dumpDir}{$dirName}", 0700);
    }
    $link="{$url}{$href}";
    echo $link . "  ";
    $link=file_get_html($link);
    $dir = $dumpDir.$dirName;
    foreach($link->find("img") as $img){
        $src=$img->src;
        $filename=substr($img->src,strrpos($img->src,"/")+1);
        if (strtolower(substr($src, 0, 5)) != 'http:' && strtolower(substr($src, 0, 6)) != 'https:') $src = $url.$src;
            file_put_contents("{$dir}/{$filename}", file_get_contents($src));
    }
    $link->clear();
    unset($link);
    $i ++;
    if ($i > 7) {
        break;
    }
}
$html->clear();
unset($html);

?>
