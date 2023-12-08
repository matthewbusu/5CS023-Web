<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widt=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div> DIve Sites </div>
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

        
$string_with_ampersand = "This & that";
$scubaNameNoAnd = str_replace('&', 'and', $scubaName);




        echo "<div class='accordion-item'>
        <h2 class='accordion-header'>
          <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapseTwo$i' aria-expanded='false' aria-controls='flush-collapseTwo'>
          $scubaNameNoAnd, $scubeRegion
          </button>
        </h2>
        <div id='flush-collapseTwo$i' class='accordion-collapse collapse' data-bs-parent='#accordionFlushExample'>
          <div class='accordion-body'><iframe
            width='600'
            height='450'
            frameborder='0' style='border:0'
            src='https://www.google.com/maps/embed/v1/place?key=AIzaSyA_x-MqLZVyYffeazga41toBoY70vQ3f8A&q=$scubaNameNoAnd&zoom=150'
            
            allowfullscreen>
        </iframe></div>
        </div><br>";


        } 
        
      
        } else {
            echo "No Dive Sites Found";
        }
?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>