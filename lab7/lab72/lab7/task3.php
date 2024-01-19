<?php
$weather="";
$tempArr=[];
if(isset($_GET["city"])){
    $urlContent= file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&units=metric&appid=67c7b650985884d025a03aa46189006f");
    $forecastArray=json_decode($urlContent,true);
    if($forecastArray['cod']==200){
        $tempArr[]=$forecastArray['main']['temp'];
    }
    $urlContent= file_get_contents("https://api.weatherbit.io/v2.0/current?city=".$_GET['city']."&key=d673ba719ab5419f874a0edb4d8e81f9&include=minutely");
    $forecastArray=json_decode($urlContent,true);
    $tempArr[]=$forecastArray["data"][0]['temp'];

    $urlContent= file_get_contents("https://api.weatherapi.com/v1/current.json?key=9b99114183494ba8b05155145222604&q=".$_GET['city']);
    $forecastArray=json_decode($urlContent,true);
    $tempArr[]=$forecastArray["current"]["temp_c"];

    $urlContent= file_get_contents("https://api.tomorrow.io/v4/timelines?location=".$_GET['city']."&fields=temperature&timesteps=1h&units=metric&apikey=ECYOtyV5jlObuatyW683vc44UWzFGlAp");
    $forecastArray=json_decode($urlContent,true);
    $tempArr[]=$forecastArray["data"]["timelines"][0]["intervals"][0]["values"]["temperature"];
    
    $sum = 0;
    foreach($tempArr as $temperature){
        $sum+=$temperature;
    }
    $temperature=$sum/4;
    $weather="The weather in ".$_GET['city']." is {$temperature}";
}
else{
    $error="City name is incorret";
}

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Weather App</title>
  </head>
  <body>
    <div class="container" id="mainDiv">
      <form>
        <label for="city" class="form-label">Input a city name</label>
        <input type="text" class="form-control" name="city" id="city">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
    <div id="forecastDiv">
        <?php 
        if($weather){
            echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
        } 
        else if ($error)
        {
            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';  
        }
   
        ?>
        </div>
    </div>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

   
  </body>
</html>