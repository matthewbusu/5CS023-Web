<?php
 
 session_start();

 // Check if the user is authenticated
 if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
     exit();
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
              <a class="nav-link active" aria-current="page"  href="indexBlogger.php">Home</a>
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
            <label for="floatingInput">Enter Search here!</label><br>
            <button type="submit" class="btn btn-light">Search</button>
        </div>
      </form>
       
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
