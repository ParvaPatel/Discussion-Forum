<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Discussion Forum</title>
    <link rel="stylesheet" href="../CSS/style.css" />
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
    <nav id="navbar">
      <div id="logo">
        <img
          src="Pictures/logo.png"
          alt="Forum Logo"
          height="75px"
          width="100px"
        />
      </div>

      <div class="list_item">
        <ul>
          <li class="item"><a href="home.php">Home</a></li>
          <li class="item"><a href="myThreads.php">My Thread</a></li>
          <li class="item"><a href="myComments.php">My Comments</a></li>
          <li class="item"><a href="addThread.php">Add Thread</a></li>
          <li class="item"><a href="aboutUS.php">About Us</a></li>
          <li class="item"><a href="contactUs.php">Contact Us</a></li>
        </ul>
      </div>
    </nav>
    
    <?php 
        session_start();
        $_SESSION['message']='';
        // $_SESSION['threadId']=$_GET[id];
        $mysqli = new mysqli('localhost','root','','forum');
        require 'updateCommentValidate.php'; 
        
        $username =  $_SESSION['username'];         
        $str = "SELECT id from users where username = '$username'";
        $result=ExecuteQuery($str);
        $row = mysqli_fetch_assoc($result);
        $userId = $row['id'];

        $commentId = $_GET['id'];

        $sql = "SELECT * FROM comments where userId = $userId and commentId = $commentId";

        $result = ExecuteQuery($sql);
        $row = mysqli_fetch_assoc($result);
        $description = $row['description'];
        
        // echo $description;
        // die();
    ?>
        



    <div class="body-content">
        <div class="module">
            <h1>Update this Comment</h1>
            <form class="form" action="updateCommentYes.php?id=<?php echo $commentId;?>" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
            <input type="text" placeholder="Description" name="description" value = "<?php echo $row['description'];?>" required />
            <input type="submit" value="Update  Comment" name="updateComment" class="btn btn-block btn-primary" />

            <input type="hidden" value="<?php echo $_GET["id"] ?>" name="commentId"  />
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
