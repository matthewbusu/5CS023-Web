<?php

require_once 'access.php';
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
                <a class="nav-link" aria-current="page"  href="Index_Blogger.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="news.html">News</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="blogger.html">Write Blog</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
        
          <form action="search.php" method="post">
            <div class="form-floating mb-3 ">
              <input class="form-control" id="floatingInput" name="searchTerm">
              <label for="floatingInput">Enter Search here!</label><br>
              <button type="submit" class="btn btn-light">Search</button>
            </div>
          </form>    
      
          <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "test";
        
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $encodedCookie = $_COOKIE['user_id'];
            $encryptedValue = base64_decode($encodedCookie);
            $userId = openssl_decrypt($encryptedValue, 'aes-256-cbc', $encryptKey, 0, $encryptIV);
            
            $sql = "SELECT blog_id, title, blog, filename FROM blog where user_id = '$userId'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {  
               // echo "<ul>";
                
                while ($row = $result->fetch_assoc()) 
                {
                    echo "<div class='mb-2 p-2 bg-light text-dark'>";
                    echo "Title: <input class='form-control' type='text' value='" . $row["title"] . "' aria-label='readonly input example' readonly><br>";    
                    echo "Blog: <textarea class='form-control' style='height: 150px' readonly>" . $row["blog"] . "</textarea><br>";
                    echo "<img src='img/" . $row["filename"] . "' class='d-block w-50 h-50' alt='blog image'><br>";
                    echo "<form action='delete.php' method='POST'>";
                    echo "<input class='form-control' type='hidden' value='" . $row["blog_id"] . "' aria-label='readonly input example' readonly name='blog_id'>";
                    echo "<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>Delete </button>";
                    echo  " <div class='modal fade' id='staticBackdrop' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h1 class='modal-title fs-5' id='staticBackdropLabel'>Confirm Delete</h1>
                                  <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                  Are you sure you want to Delete this Blog?
                                </div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>No</button>
                                  <button type='submit' class='btn btn-danger'>Yes, Delete</button>
                                </div>
                              </div>
                            </div>
                          </div>";   
                    echo "</form>";
                    echo "</div>";
                    
                  }
                
               // echo "</ul>";
            } else {
                echo "No blogs found.";
            }
            
            $conn->close();
          ?>
      
      </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>
