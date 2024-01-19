<?php

require_once 'utils.php';

$site_message = "";
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(check_post_parameters()){
        if(makeOrder()){
            $site_message = "<h2>Order successfull</h2><hr>";
        }else{
            $site_message = "<h2>Error...</h2><hr>";
        }
    }else{
        $site_message = "parameters problem";   
    }
}

$site_content = file_get_contents('order-form.html');
$site_content = str_replace('{SITE_MESSAGE}', $site_message, $site_content);
echo $site_content;