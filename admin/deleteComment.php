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
    <link rel="icon" href="../Pictures/logo.png" type="image/png" />
    <link rel="stylesheet" href="../CSS/preloader.css" />
    <link rel="stylesheet" href="../Pages/form.css" type="text/css"><!--css for preloader and news letter-->
  </head>
<!--body-->
<body>
    <nav class="navbar">
      
        <ul>
          <li class="item"><a href="home.php">Home</a></li>
          <li class="item"><a href="myThreads.php">My Thread</a></li>
          <li class="item"><a href="myComments.php">My Comments</a></li>
          <li class="item"><a href="addThread.php">Add Thread</a></li>
          <li class="item"><a href="aboutUS.php">About Us</a></li>
          <li class="item"><a href="contactUs.php">Contact Us</a></li>
          <li class="item"><a href="profile.php">Profile</a></li>
          <li class="item"><a href="logout.php">Logout</a></li>

        </ul>
    </nav>
    </br>
    <div class="body-content">
        <div class="module">
        <?php 
        // require 'checkLogin.php';
        include '../Pages/utility.php';
            //$_SESSION variables become available on this page
            session_start();
            if($_SESSION['loggedin'] == false){
              header("location: ../Pages/login.php");
            }
            echo "<h1>Are you sure you want to delete this Comment ? <h1>";
            echo "<a href = 'deleteCommentYes.php?id=$_GET[id]'>Yes</a>";
            echo "<a href = 'myComments.php'>     No</a>";
            
            
             
        ?>
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
