<?php

$country = "malta"; 

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://world-scuba-diving-sites-api.p.rapidapi.com/api/divesite?country=" . urlencode($country),
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: world-scuba-diving-sites-api.p.rapidapi.com",
		"X-RapidAPI-Key: 7f16f71fc8mshc045929c18f14a1p15855fjsn738c490521da"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
    //echo $response;

    $divesites = json_decode($response, true);

    //var_dump($divesites);

    if (!empty($divesites) && is_array($divesites)) {
        // Check if the array key exists before accessing it
        if (isset($divesites[7]['region'])) {
            echo 'First diving site name: ' . $divesites[7]['region'];
        } else {
            echo 'The "region" key is not present in the first diving site.';
        }
    } else {
        echo 'No diving sites found.';
    }

}

?>
