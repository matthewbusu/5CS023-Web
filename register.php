<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widt=device-width, initial-scale=1.0">
    <title>Travel Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-success" data-bs-theme="dark">
    <div class="container-fluid" >
      <a class="navbar-brand" href="Index.html" >Travel Blog Site</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page"  href="Index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="register.php">Register</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
        <a href="login.html" button class="btn btn-success" type="submit">Log In</a>
        </form>
      </div>
    </div>
  </nav>
  <?php
    require_once 'access.php';
        if (isset($_COOKIE['success'] )){
          $cookie = $_COOKIE['success'];
            if ($cookie == 1){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Password</strong>  must be at least $passwordMinlength characters long.
                    <a href='register.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
                </div>
                 ";

            }
            elseif ($cookie == 2){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Password</strong> must contain at least one uppercase letter.
                    <a href='register.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
                </div>
                ";
            }
            elseif ($cookie == 3){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Password</strong> must contain at least one lowercase letter.
                    <a href='register.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
                </div>
                ";
            }
            elseif ($cookie == 4){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Password</strong> must contain at least one Number.
                    <a href='register.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
                </div>
                ";
            }
            elseif ($cookie == 5){
                echo "
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Registration Successful!</strong> Please log in and enjoy you time blogging with us.
                    <a href='login.html'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
                </div>
                ";
            }
            elseif ($cookie == 6){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Error</strong> There was a problem saving your data, please try again.
                    <a href='register.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
                </div>
                ";
            }
            elseif ($cookie == 7){
                echo "     
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Error!</strong> Sorry, there was an error uploading your file.
                    <a href='register.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
                </div>
                ";
            }
            elseif ($cookie == 8){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Error!</strong> Sorry, there was an error uploading your file.
                    <a href='register.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
                </div>
                ";
            }
            elseif ($cookie == 9){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Sorry</strong> User is already registered with Travel Blog.
                    <a href='register.php'><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></a>
                </div>
                ";
            }
            
            setcookie('success', "", time()+3600, '/');

        }   
    ?>
  <div class="container"><br>
    <div class="p-3 mb-2 bg-light text-dark">
      <h2>Register Account with Travel Blog</h2><br>
        <p>Welcome to our community! 🎉 We're excited to have you on board. Fill in your details below and Click the registration to complete your sign-up and start exploring the amazing features we have for you.</p><br>
      <form class="row g-3" action="connect.php" method="post" enctype="multipart/form-data">
        <div class="col-6">
          <label for="inputName" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
        </div>
        <div class="col-6">
          <label for="inputSurname" class="form-label">Surname</label>
          <input type="text" class="form-control" id="surname" placeholder="Surname" name="surname" required>
        </div>
        <div class="col-12">
          <label for="inputSurname" class="form-label">Type your Favorite Quote</label>
          <input type="text" class="form-control" id="quote" placeholder="Quote" name="quote" required>
        </div>
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="col-md-6">
          <label for="inputPassword4" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="input-group mb-3">
          <label class="input-group-text" for="inputGroupFile01">Profile Photo</label>
          <input type="file" class="form-control" id="inputGroupFile01" name="image" accept="image/*" required>
        </div>
        <div class="col-12">
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" >
            Register
          </button>
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Confirm Registration</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Make Sure that you have insereted the correct details. 
                  Your password should be more than 8 characters long and include Lowercase, Uppercase, Symbol and a Number.  
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
