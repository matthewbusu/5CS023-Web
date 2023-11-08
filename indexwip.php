<?php
  session_start();

  // Check if the user is authenticated
  if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
      exit();
  }
  
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) 
  {
    die("Connection failed: " . $conn->connect_error);
  }

  $userId = $_COOKIE['user_id'];

  $sqlUser = "SELECT name, surname, email, password FROM users where user_id = '$userId'";

  $result = $conn->query($sqlUser);


  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $name = $row["name"];
      $surname = $row["surname"];
    
  } else {
      
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
              <a class="nav-link active" aria-current="page"  href="Index_Blogger.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="news.html">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="blogger.html">Write Blog</a>
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
    <div class="container" style="width: 50%">
      <br>
      <div>
        <h3>
          <small class="text-body-secondary"> Welcome to Travel Blog <?php echo $name; $surname; ?>, enjoy your stay and respect other bloggers.</small>
        </h3>
      </div>
      <br>
      <form action="search.php" method="post">
        <div class="form-floating mb-3">
          <input class="form-control" id="floatingInput" name="searchTerm">
          <label for="floatingInput">Enter Search here!</label><br>
          <button type="submit" class="btn btn-light">Search</button>
        </div>
      </form>    
  
      
      <?php
        $sql = "SELECT blog.blog_id, blog.title, blog.blog, blog.filename, users.name, users.surname FROM users, blog WHERE blog.user_id = users.user_id ORDER BY blog.blog_id DESC ";

        $result = $conn->query($sql);
        
        

        if ($result->num_rows > 0)
        
        
        {  
          while ($row = $result->fetch_assoc()) 
          
          
            {
              echo "
              <div class='mb-2 p-2 bg-light text-dark justify-content-center'>
                <div class='row'>
                  <div class='col-2 d-flex justify-content-center'>
                   <img src='/img/po.jpg' style='height: 95px' class='img-thumbnail'>
                  </div>
                  <div class='col-4'>
                    <figure>
                      <blockquote class='blockquote'>
                        <p>". $row["name"] ." ".  $row["surname"] ."</p>
                      </blockquote>
                      <figcaption class='blockquote-footer'>
                        To Travel to see the <cite title='Source Title'>World</cite>
                      </figcaption>
                    </figure> 
                  </div>
                  <div class='col'> 
                    <p class='display-6'>" . $row["title"] . "</p>
                  </div>
                </div><br>
                Blog: <textarea class='form-control' style='height: 150px' readonly>" . $row["blog"] . "</textarea><br>
                <div class='d-flex justify-content-center'>
                  <img src='img/" . $row["filename"] . "' class='d-block w-50 h-50 d-flex justify-content-center' alt='blog image'>  
                </div>
              </div>
              
              
              
              
              
              
              
              
              
              ";
            }
        } else 
            {
              echo "No blogs found.";
            }
        $conn->close();
      ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>
