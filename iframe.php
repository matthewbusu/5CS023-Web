<?php
 
 session_start();

 // Check if the user is authenticated
 if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
     exit();
 }
 
$searchTerm = $_POST['searchTerm'];
$country = str_replace(' ', '%20', $searchTerm);


$api_url = "https://restcountries.com/v3.1/name/{$country}";

$json_data = file_get_contents($api_url);
$countries = json_decode($json_data, true);

if ($searchTerm != NULL){
  if (!empty($countries) && is_array($countries)) {
    
    $name = $countries[0]['name']['common'];
	  $car = $countries[0]['car']['side'];
	  $flags = $countries[0]['flags']['png'];
    $region = $countries[0]['region'];
	  $area = $countries[0]['area'];
    $languages = implode(", ", $countries[0]['languages']); 
    $capital = implode(", ", $countries[0]['capital']);
    $subregion = $countries[0]['subregion'];
    $population = $countries[0]['population'];
    $timezones = implode(", ", $countries[0]['timezones']); 
    $maps = implode(", ", $countries[0]['maps']);
    $flagDescription = $countries[0]['flags']['alt'];
    $lat = $countries[0]['latlng'][0];
    $lng = $countries[0]['latlng'][1];
   
  } else {
      echo "Error retrieving data from the API.";
  }

}
else {
      
  header("Location: countryInfo.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widt=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-success" data-bs-theme="dark">
      <div class="container-fluid" >
        <a class="navbar-brand" href="#" >Travel Blog Site</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page"  href="Index_Blogger.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="countryInfo.php">Country Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="blogger.php">Write Blog</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                My Profile
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="myblogs.php">My Blogs</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="account.php">My Account</a></li>
              </ul>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <a href="logout.php" button class="btn btn-success" type="submit">Log Out</a>
          </form>
        </div>
      </div>
    </nav>
    <div class="container">
      <br>
      <div>
        <h3>
          <small class="text-body-secondary"> Let us know where your next destination is and we'll give you some tips!.</small>
        </h3>
      </div>
      <br>
      <form action="iframe.php" method="post" onsubmit="return validateSearchForm()">
        <div class="form-floating mb-3">
            <input class="form-control" id="floatingInput" name="searchTerm">
            <label for="floatingInput">Enter your destination here!</label><br>
            <button type="submit" class="btn btn-light">Search</button>
        </div>
      </form>
      <div class="container">
        <div class="p-3 mb-2 bg-light text-dark">
          <form class="row gy-2 gx-3 align-items-center">
            <div class="col-6">
                <label for="inputName" class="form-label">Name: </label>
                <input class="form-control" type="text" value="<?php echo $name;?>" aria-label="readonly input example" readonly>
            </div>
            <div class="col-6">
                <label for="inputName" class="form-label">Region: </label>
                <input class="form-control" type="text" value="<?php echo $region;?>" aria-label="readonly input example" readonly>
            </div>
            <div class="col-6">
                <label for="inputName" class="form-label">Language: </label>
                <input class="form-control" type="text" value="<?php echo $languages;?>" aria-label="readonly input example" readonly>
            </div>
            <div class="col-6">
                <label for="inputName" class="form-label">Sub Region: </label>
                <input class="form-control" type="text" value="<?php echo $subregion;?>" aria-label="readonly input example" readonly>
            </div>
            <div class="col-6">
                <label for="inputName" class="form-label">Capital City: </label>
                <input class="form-control" type="text" value="<?php echo $capital;?>" aria-label="readonly input example" readonly>
            </div>
            <div class="col-6">
                <label for="inputName" class="form-label">Area in Sqm: </label>
                <input class="form-control" type="text" value="<?php echo $area;?>" aria-label="readonly input example" readonly>
            </div>
            <div class="col-6">
                <label for="inputName" class="form-label">Population: </label>
                <input class="form-control" type="text" value="<?php echo $population;?>" aria-label="readonly input example" readonly>
            </div>
            <div class="col-6">
                <label for="inputName" class="form-label">Time Zone: </label>
                <input class="form-control" type="text" value="<?php echo $timezones;?>" aria-label="readonly input example" readonly>
            </div>
            <div class="col-12">
                <label for="inputName" class="form-label">Map URL: </label>
                <input class="form-control" type="text" value=<?php echo $maps;?> aria-label="readonly input example" readonly>
            </div>
            <div class="col-12">
                <label for="inputName" class="form-label">Flag: </label>
                <img src="<?php echo $flags;?>" class="img-thumbnail" alt="Flag">
            </div>
            <div class="col-12">
                <label for="inputName" class="form-label">Flag Description: </label>
                <input class="form-control" type="text" value="<?php echo $flagDescription;?>" aria-label="readonly input example" readonly>
            </div>
            <label for="inputName" class="form-label">Google Maps Location: </label>
            <iframe
                width="600"
                height="450"
                frameborder="0" style="border:0"
                src="https://www.google.com/maps/embed/v1/view?key=AIzaSyA_x-MqLZVyYffeazga41toBoY70vQ3f8A&center=<?php echo $lat; ?>,<?php echo $lng; ?>&zoom=15"
                allowfullscreen>
            </iframe>
          </form>
      </div>
      <div>
      <?php 
          $coun = 'malta';

          $curl = curl_init();

          curl_setopt_array($curl, [
              CURLOPT_URL => "https://world-scuba-diving-sites-api.p.rapidapi.com/api/divesite?country=" . urlencode($coun),
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

                  echo "
                  <div class='p-3 mb-2 bg-light text-dark'>
                    <form class='row gy-2 gx-3 align-items-center'>
                      <div class='col-6'>
                          <label for='inputName' class='form-label'>Name: </label>
                          <input class='form-control' type='text' value=". $scubaName . " aria-label='readonly input example' readonly>
                      </div>
                      <div class='col-6'>
                          <label for='inputName' class='form-label'>Region: </label>
                          <input class='form-control' type='text' value=". $scubaRegion ." aria-label='readonly input example' readonly>
                      </div>
                      <iframe
                width='600'
                height='450'
                frameborder='0' style='border:0'
                src='https://www.google.com/maps/embed/v1/view?key=AIzaSyA_x-MqLZVyYffeazga41toBoY70vQ3f8A&center=". $scubaLat . ",". $lng . "&zoom=15'
                allowfullscreen>
            </iframe>
          </form>"
                    
                    ;

                  } 
                  
                
                  } else {
                      echo "No Dive Sites Found";
                  }
          ?>




      </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="script.js"></script>
    <script>
        function validateSearchForm() {
            var searchTerm = document.getElementById('floatingInput').value;

            
            var regex = /^[a-zA-Z0-9 ]*$/;

            if (!regex.test(searchTerm)) {
                alert("Please only enter Text, symbols are not permitted in the search field.");
                return false; 
            }

            return true; 
        }
    </script>
</body>
</html>
