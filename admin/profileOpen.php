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
    <link rel="stylesheet" href="../CSS/threadViewBox.css" type="text/css">
    <link rel="stylesheet" href="../CSS/profile.css" type="text/css">
    

  </head>
<!--body-->
<body>
    <nav class="navbar">
      <!-- <div id="logo">
        <img
          src="Pictures/logo.png"
          alt="Forum Logo"
          height="75px"
          width="100px"
        />
      </div>

      <div class="list_item"> -->
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
      <!-- </div> -->
    </nav>
    </br></br></br></br></br></br>
    <!-- <div class="body-content">
        <div class="module"> -->
        <?php 
        // require 'checkLogin.php';
        session_start();
        include '../Pages/utility.php';
        if($_SESSION['loggedin'] == false){
          header("location: ../Pages/login.php");
        }
            $userId = $_GET['userId'];
            // $str = "SELECT extractUsername($userId) as username";
            // $res=ExecuteQuery($str);
            // $temp = mysqli_fetch_assoc($res);
            // $username = $temp['username'];

            $str = "CALL getUserDetails($userId)";
            $res=ExecuteQuery($str);
            $temp = mysqli_fetch_assoc($res);

            $avatar = "../Pages/";
            $path = $temp['avatar'];
            $avatarPath = $avatar.$path;
            
            $str = "SELECT countThreadsByUser($userId) as noRows";
            $cur= ExecuteQuery($str);
            $temp2 = mysqli_fetch_assoc($cur);
              // print_r ($temp2['total']);
            $noThreads = $temp2['noRows'];
            $str = "SELECT countCommentsByUser($userId) as noRows";
            $cur= ExecuteQuery($str);
            $temp2 = mysqli_fetch_assoc($cur);
            $noComments = $temp2['noRows'];
        ?>

        <div class = "profilePic">
            
            <img src = '<?= $avatarPath ?>' alt = "Profile Pic" width="150px" height="150px" >
            <h1><?= $temp['username']?></h1>
            <div class="alert alert-success">No. of Threads Posted = <?=$noThreads?></div>
            <div class="alert alert-success">No. of Comments Posted = <?=$noComments?></div>
            
        </div>
    <!-- </div>
    </div> -->
    </br></br></br></br>
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




