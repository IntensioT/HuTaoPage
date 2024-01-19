<!DOCTYPE html>
<html>
<head>
    <title>Погода</title>
</head>
<body>
  <h2>Погода</h2>
  <form method="post">
    <fieldset>
        <legend>Оставьте сообщение:</legend>
        Город:<br>
        <input type="text" name="city" required><br>
        <input type="submit" name="submit" value="Искать">
    </fieldset>
  </form>

<?php

function getWeatherForecastRambler($url) {
    //echo $url;
    $html = file_get_contents($url[0]);
    if($html === false){
        $html = file_get_contents($url[1]);
    }

    //$temperature = array();
    preg_match_all('/<div class="HhSR GyfK">[0-9]+/i', $html, $temperature);
    //var_dump($temperature);
    $temperatureRes = substr($temperature[0][0],strrpos($temperature[0][0], '>')+1, 2);

    echo "<p>Сайт Rambler - $temperatureRes градусов Цельсия</p>";

    return $temperatureRes;
}

function getWeatherForecastOpenWeather($url) {   
    //echo $url[0]; 
    error_reporting(E_ALL);

    $data = @file_get_contents($url[0]);
    if($data){
        $dataJson = json_decode($data);
        //var_dump($dataJson);
        $temperatureRes = $dataJson->main->temp;
        echo "<p>Сайт OpenWeather - $temperatureRes градусов Цельсия</p>";
    }else{
        echo "<p>Сайт OpenWeather - недоступен</p>";
    }

    return $temperatureRes;
}

function getWeatherForecastYandex($url) {

    $opts = array(
        'http'=>array(
          'method'=>"GET",
          'header' => "X-Yandex-API-Key:f263a4ae-9dd7-44ae-8db6-e60f0c52a430"."\r\n"
          )
      );
      $context = stream_context_create($opts);
      $f=file_get_contents($url[0],false,$context);

      $f=json_decode($f);
      $t=$f->forecasts;
      //var_dump($t[1] -> parts -> day);
      $temperatureRes = $t[1] -> parts -> day -> temp_avg;
      echo "<p>Сайт Yandex - $temperatureRes градусов Цельсия</p>";     
    return $temperatureRes;
}

function getWeatherForecastMeteo($url) {

    //echo $url;
    $html = file_get_contents($url[0]);

    //$temperature = array();
    preg_match_all("/\+[0-9]+/i", $html, $temperature);
    //var_dump($temperature);
    $temperatureRes = substr($temperature[0][12],1);
    $temperatureRes = ($temperatureRes + substr($temperature[0][13],1))/2;
    echo "<p>Сайт Meteo.by - $temperatureRes градусов Цельсия</p>";

    return $temperatureRes;
}

if(isset($_POST['city'])){
    
    $city = $_POST['city'];
    // API ключ
    $apiKey = "fe57b721fd47b8600afac45a7829c1ea";
    $weatherSites = array(
        'Rambler' => ["https://weather.rambler.ru/v-".$city."e/tomorrow/","https://weather.rambler.ru/v-".$city."/tomorrow/"],
        'Meteo' => ["https://meteo.by/print/$city/"],
        'OpenWeather' => ["http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&lang=ru&cnt=2&mode=json&units=metric&appid=" . $apiKey],
        'Yandex' => ["https://api.weather.yandex.ru/v2/forecast/?lat=53.902735&lon=27.555691&limit=2&lang=ru_RU"],
    );

    $temperatures = array();
    foreach ($weatherSites as $site => $url) {
        $call = "getWeatherForecast".$site;
        //echo $call;
        $temperature = $call($url);
        $temperatures[] = $temperature;
    }

    $averageTemperature = array_sum($temperatures) / count($temperatures);

    echo "<h3>Прогноз погоды для города $city на завтра:</h3>\n";
    echo "<p>Средняя температура: $averageTemperature градусов Цельсия</p>\n";
}
?>
</body>
</html>

