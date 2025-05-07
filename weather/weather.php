<?php
$apiKey = '7726c3e2b391a9ae4f58e574d5b6fd6a';
$city = 'Vilnius';
$units = 'metric'; // Use 'imperial' for Fahrenheit

$url = "http://api.openweathermap.org/data/2.5/weather?q=$city&units=$units&appid=$apiKey";
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data) {
    $temperature = $data['main']['temp'];
    $description = $data['weather'][0]['description'];
    echo "The temperature in $city is {$temperature}°C with $description.";
} else {
    echo 'Error fetching weather data.';
}
?>
