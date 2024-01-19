<?php
error_reporting(E_ERROR | E_PARSE);
include('simple_html_dom.php');
if(isset($_POST["ok"])){
    $files = glob('downloads/*');
    foreach($files as $file){
        if(is_file($file)) {
            unlink($file);
        }
    }
    $url = $_POST["url"];
    $destDir = "downloads/";
    $isOk = true;
    try{
        $html = file_get_html($url);
    } catch (Exception $e) {
        $isOk = false;
        $e->getMessage();
        echo "issue with file_get_html()";
        echo $e->getMessage();
    }
    if ($isOk && $html) {
        foreach($html->find("img") as $img){
            $src = $img->src;
            $filename=substr($img->src,strrpos($img->src,"/")+1);
            if (strtolower(substr($src, 0, 5)) != 'http:' && strtolower(substr($src, 0, 6)) != 'https:') $src = $url.$src;
                file_put_contents($destDir.$filename, file_get_contents($src));
        }
        $html->clear();
    } else {
        echo "Error, html var is null";
    } 
    unset($html);
}

?>
<!doctype html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    

    <title>Task 1 lab 7</title>
  </head>
  <body>
    <div class="container" id="mainDiv"> 
      <form method="post">
  <div class="mb-3">
    <input style="margin-top: 15px;" type="text" class="form-control" name="url" placeholder="Введите ссылку">
  </div>
  <button type="submit" name="ok">Ввести</button>
</form>
</div> 
    </div>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>