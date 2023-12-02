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

$divesites = json_decode($response, true);


if (isset($divesites['data']) && is_array($divesites['data'])) {

    for ($i = 0; $i < 5 && $i < count($divesites['data']); $i++) {
        $scubaName = $divesites['data'][$i]['name'];
        $scubeRegion = $divesites['data'][$i]['region'];
        $scubaLat = $divesites['data'][$i]['lat'];
        $scubaLng = $divesites['data'][$i]['lng'];

        echo $scubeRegion;
        echo $scubaName;
        echo $scubaLat;
        echo $scubaLng;


        } 
        
      
        } else {
            echo "No Dive Sites Found";
        }
?>