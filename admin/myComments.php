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

    <div class="body-content">
        <div class="module">
        <?php 
            include '../Pages/utility.php';
            //$_SESSION variables become available on this page
            session_start();
            // $_SESSION['message'] = '';
            // $mysqli = new mysqli('localhost','root','','forum');
            // $username =  $_SESSION['username'];
            // echo $username;
            $username = $_SESSION['username'];
            $str = "SELECT extractUserId('$username') as id";
            $result=ExecuteQuery($str);
            $row = mysqli_fetch_assoc($result);
            $userId = $row['id'];           
            // echo "<h3> PHP List All Session Variables</h3>";
            //     foreach ($_SESSION as $key=>$val)
            //     echo $key." ".$val."<br/>";
            // echo $_SESSION['username'];

            // $str="Select threadId from comments where userid = $userId";
            $str = "SELECT countCommentsByUser($userId) as noComments";
            $result = ExecuteQuery($str);
            $row = mysqli_fetch_assoc($result);
            $noComments = $row['noComments'];

            $str = "SELECT countCommentedThreads($userId) as noThreads";
            $result = ExecuteQuery($str);
            $row = mysqli_fetch_assoc($result);
            $noThreads = $row['noThreads'];


            $str = "CALL viewCommentedThreads($userId)";
            $result=ExecuteQuery($str);

            if($result){
                
                
                echo "<h1>No. of Threads Where you commented : ";
                echo $noThreads;
                echo "</h1>";
                echo "<h1>No. of Comments by You : ";
                echo $noComments;
                echo "</h1>";
                while($row = mysqli_fetch_assoc($result)){
                    $topic = $row['topic'];
                    echo "<h1><a href='threadView.php?id=$row[threadId]'>";
                    echo $topic;
                    echo "</a></h1>";
                    $noRows = $row['votes'];

                    echo "Net Votes : ";
                    echo $noRows;
                    echo "</br>";
                    $summary = $row['summary'];
                    echo $summary;
                    echo "<br/><br/><br/>";
                    $tDateTime = $row['tDateTime'];
                    echo $tDateTime;
                    echo "<br/><br/>";
                    $tag = $row['tag'];
                    echo $tag;
                }
            }else{
                echo "<h1>No. of Threads Where you commented : 0 </h1>";
                echo "<h1>No. of Comments by You : 0 </h1>";
            }
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
