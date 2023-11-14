<?php


$country = 'argentina';
$api_url = "https://restcountries.com/v3.1/name/{$country}";

$json_data = file_get_contents($api_url);
$countries = json_decode($json_data, true);


if (!empty($countries) && is_array($countries)) {
    
    $name = $countries[0]['name']['common'];
	$car = $countries[0]['car']['side'];
	$flags = $countries[0]['flags']['png'];
	$flagdes = $countries[0]['flags']['alt'];
    $region = $countries[0]['region'];
	$area = $countries[0]['area'];
    $languages = implode(", ", $countries[0]['languages']); 
    $capital = implode(", ", $countries[0]['capital']);
    $subregion = $countries[0]['subregion'];
    $population = $countries[0]['population'];
    $timezones = implode(", ", $countries[0]['timezones']); 
    $maps = implode(", ", $countries[0]['maps']);
    $lat = $countries[0]['latlng'][0];
    $lng = $countries[0]['latlng'][1];
	

  
    echo "Name: $name<br>";
    echo "Region: $region<br>";
	echo "Car Drive Side: $car<br>";
    echo "Languages: $languages<br>";
    echo "Capital: $capital<br>";
    echo "Subregion: $subregion<br>";
    echo "Population: $population<br>";
	echo "Area: $area sqm <br>";
    echo "Timezones: $timezones<br>";
    echo "Maps: $maps<br>";
	echo "Flags: $flags<br>";
	echo "Description $lng<br>";
    echo "Description $lat<br>";
	

   
} else {
    echo "Error retrieving data from the API.";
}



?>