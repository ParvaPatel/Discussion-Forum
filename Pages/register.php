<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Discussion Forum</title>
    <link rel="stylesheet" href="../CSS/dbmsNav.css" />
      <link rel="stylesheet" href="../CSS/mini_style.css" />
    <link
      rel="stylesheet"
      media="screen and (max-width: 1480px)"
      href="../CSS/phone.css"
    />
    <!-- Added Phone.css for Media Query  -->
    <link
      href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@600&family=Bree+Serif&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="../Pictures/logo.png" type="image/png" />    <link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="form.css" type="text/css">
  </head>
<body>
    <div class="navbar">
      
        <ul>
          <li class="item"><a href="../index.php">Home</a></li>
          <li class="active"><a href="register.php">Sign Up</a></li>
          <li class="item"><a href="login.php">Login</a></li>
          <li class="item"><a href="aboutUS.php">About Us</a></li>
          <li class="item"><a href="contactUs.php">Contact Us</a></li>
        </ul>
    </div>
    </br>
    <?php

        session_start();
        $_SESSION['message'] = '';
        $mysqli = new mysqli('localhost','root','','forum');
        require 'validate.php';

        
    ?>

    <div class="body-content">
        <div class="module">
            <h1>Create an account</h1>
            <form class="form" action="register.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
            <input type="text" placeholder="User Name" name="username" required />
            <input type="text" placeholder="Name" name="name" required />
            <input type="email" placeholder="Email" name="email" required />
            <input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
            <input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required />
            <div class="avatar"><label>Select your avatar: </label><input type="file" name="avatar" accept="image/*" required /></div>
            <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
            </form>
        </div>
    </div>




    <!-- Start Footer -->
    <footer class="footer-area bg-f">
      <div class="copyright">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <p class="company-name">
                All Rights Reserved. &copy; 2021
                <a href="#">Discussion Forum</a> Design By :
                <a href="#">SVNIT Students</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- End Footer -->
   
  </body>
</html>




















