<?php

session_start();


// Check if the user is authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    exit();
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_COOKIE['user_id'];

$sql = "SELECT name, surname, email, password FROM users where user_id = '$userId'";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $surname = $row["surname"];
    $email = $row["email"];
    $password = $row["password"];
    
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
    <div class="container">
    <div class="p-3 mb-2 bg-light text-dark">
        <form class="row g-3" action="update.php" method="post">
          <div class="col-12">
            <label for="inputName" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Name" name="name" required value="<?php echo $name; ?>">
          </div>
          <div class="col-12">
            <label for="inputSurname" class="form-label">Surname</label>
            <input type="text" class="form-control" id="surname" placeholder="Surname" required name="surname" value="<?php echo $surname; ?>">
          </div>
          <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required value="<?php echo $email; ?>">
          </div>
          <div class="col-md-12">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              Change Details
            </button>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Change Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Check that your new details are correct and press Confirm. 
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Confirm</button>
                  </div>
                </div>
              </div>
            </div>
          </div>  
        </form>
      </div>
      <div class="p-3 mb-2 bg-light text-dark">
        <form class="row g-3" action="chpassword.php" method="post">
          <div class="col-md-12">
            <label for="inputPassword4" class="form-label">Old Password</label>
            <input type="password" class="form-control" id="password" name="oldpassword" required>
          </div>
          <div class="col-md-12">
            <label for="inputPassword4" class="form-label">New Password</label>
            <input type="password" class="form-control" id="password" name="newpassword" required>
          </div>
          <div class="col-md-12">
            <label for="inputPassword4" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="password" name="confirmpassword" required>
          </div>
          <div class="col-md-12">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              Change Password
            </button>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Change Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Confirm Password! 
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Confirm</button>
                  </div>
                </div>
              </div>
            </div>
          </div>  
        </form>
      </div>  
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>