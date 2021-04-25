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
    <?php 
        session_start();
        // require 'checkLogin.php';
        if($_SESSION['loggedin'] == false){
          header("location: ../Pages/login.php");
        }
        require 'updateThreadValidate.php'; 
        $_SESSION['message']='';

        $username =  $_SESSION['username'];         
        $str = "SELECT extractUserId('$username') as id";
        $result=ExecuteQuery($str);
        $row = mysqli_fetch_assoc($result);
        $userId = $row['id'];  

        $threadId = $_GET['id'];

        // $sql = "SELECT * FROM threads where userId = $userId and threadId = $threadId";
        $sql = "CALL preUpdateViewThread($userId,$threadId)";
        $result = ExecuteQuery($sql);
        
        $row = mysqli_fetch_assoc($result);
        // $topic = $row['topic'];
        // $summary = $row['summary'];
        // $tag = $row['tag'];
        // echo $topic;
        // echo $summary;
        // echo $tag;
        // die();
        ?>
    

        <div class="body-content">
        <div class="module">
            <h1>Update this Thread</h1>
            <form class="form" action="updateThreadYes.php?id=<?php echo $threadId;?>" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
            <input type="text" placeholder="topic" name="topic" value = "<?php echo $row['topic'];?>" required />
            <input type="text" placeholder="Summary" name="summary" value = "<?php echo $row['summary'];?>" required />
            <input type="text" placeholder="Tag" name="tag" value = "<?php echo $row['tag'];?>" required />
            <input type="submit" value="Update this Thread" name="updateThread" class="btn btn-block btn-primary" />
            </form>
            <!-- <textarea name="summary" placeholder="Summary" form="usrform">Enter text here...</textarea> -->
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
