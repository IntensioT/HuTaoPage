<!DOCTYPE html>
<html>
<head>
 <title>Image Downloader</title>
</head>
<body>
 <h1>Image Downloader</h1>
 <form method="post">
  <label for="url">URL:</label>
  <input type="text" name="url" id="url">
  <input type="submit" value="Download">
 </form>

 <?php
 if(isset($_POST['url'])) {
  $url = $_POST['url'];
  $html = file_get_contents($url);

  preg_match_all('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $html, $matches);

  foreach ($matches['src'] as $image_url) {
   if(strpos($image_url, 'http') !== 0) {
    $image_url = $url . '/' . $image_url;
   }

   $parts = parse_url($image_url);
   $path_parts = pathinfo($parts['path']);
   $dirname = $path_parts['dirname'];
   $basename = $path_parts['basename'];

   if(!is_dir($dirname)) {
    mkdir($dirname, 0777, true);
   }

   file_put_contents('/var/www/lab7/lab7/lms/saved/' . $dirname . '/' . $basename, file_get_contents($image_url));
   echo '<p>Downloaded: ' . $image_url . '</p>';
  }
 }
 ?>
</body>
</html>