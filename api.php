<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://iata-and-icao-codes.p.rapidapi.com/airlines",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: iata-and-icao-codes.p.rapidapi.com",
		"X-RapidAPI-Key: 7f16f71fc8mshc045929c18f14a1p15855fjsn738c490521da"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}