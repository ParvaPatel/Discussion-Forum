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
    <link rel="stylesheet" href="../CSS/box.css" type="text/css"/>  

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
          <li class="active"><a href="myThreads.php">My Thread</a></li>
          <li class="item"><a href="myComments.php">My Comments</a></li>
          <li class="item"><a href="addThread.php">Add Thread</a></li>
          <li class="item"><a href="aboutUS.php">About Us</a></li>
          <li class="item"><a href="contactUs.php">Contact Us</a></li>
          <li class="item"><a href="profile.php">Profile</a></li>
          <li class="item"><a href="logout.php">Logout</a></li>

        </ul>
      <!-- </div> -->
    </nav>
    </br></br>
    <!-- <div class="body-content">
        <div class="module"> -->
        <?php 
            include '../Pages/utility.php';
            //$_SESSION variables become available on this page
            session_start();
            if($_SESSION['loggedin'] == false){
              header("location: ../Pages/login.php");
            }
            // $_SESSION['message'] = '';
            // $mysqli = new mysqli('localhost','root','','forum');
            // $username =  $_SESSION['username'];
            // echo $username;
            $username = $_SESSION['username'];
            // $str = "SELECT id from users where username = '$username'";
            $str = "SELECT extractUserId('$username') as id";
            $result=ExecuteQuery($str);
            $row = mysqli_fetch_assoc($result);
            $userId = $row['id'];            
            // echo "<h3> PHP List All Session Variables</h3>";
            //     foreach ($_SESSION as $key=>$val)
            //     echo $key." ".$val."<br/>";
            // echo $_SESSION['username'];
            // $str = "SELECT * from threads where userId = $userId";
            $str = "CALL viewMyThreads($userId)";
            $result=ExecuteQuery($str);
            if($result){

              $str = "SELECT countThreadsByUser($userId) as noRows";
              $temp= ExecuteQuery($str);
              $temp2 = mysqli_fetch_assoc($temp);
              // print_r ($temp2['total']);
              $noRows = $temp2['noRows'];

              // $noRows = mysqli_num_rows($result);
              echo "</br><div class=alert alert-success'>No. of Threads Posted : ";
              echo $noRows;
              echo "</div>";
              
              echo "</h1>";
                  while($row = mysqli_fetch_assoc($result)){
                    $userId = $row['userId'];
                    $str = "SELECT extractUsername($userId) as username";
                    $res=ExecuteQuery($str);
                    $temp = mysqli_fetch_assoc($res);
                    $username = $temp['username'];
                    // echo $username;
                    // die();
                    echo "<div class='comment-thread'>
                      <div class='comment' id='comment-1'>
                          <div class='comment-heading'>
                              <div class='comment-voting'>
                                  <a href = 'vote.php?vote=up&id=$row[threadId]'> 
                                  <button type='button'>
                                      <span aria-hidden='true'>&#9650;</span>
                                      <span class='sr-only'>Vote up</span>
                                  </button>
                                  </a>
                                  <a href = 'vote.php?vote=down&id=$row[threadId]'>
                                  <button type='button'>
                                      <span aria-hidden='true'>&#9660;</span>
                                      <span class='sr-only'>Vote down</span>
                                  </button>
                                  </a>
                              </div>
                              <div class='comment-info'>
      
                                <div class='s-1'>
      
                                  <a href='threadView.php?id=$row[threadId]' class='comment-author'>";
                    echo $row['topic'];
                    echo "</a> 
                    
                      <div class='n-1'>";
                      echo $row['tDateTime'];
                      echo "</div>
                      </div>
                    
                    
                    
                    
                    <div class='m-0'> Net votes :   (";
                    echo $row['votes'];
                    echo ")         &bull;        No. of Answers :   (";
                    echo $row['noAnswers'];
                    echo ")         &bull;        Views:   (";
                    echo $row['views'];
                    echo")</div>
                                  
                              </div>
                          </div>
                          <div class='comment-body'>
                              <p>";
                    echo $row['summary'];
                    echo"</p> <a href='deleteThread.php?id=$row[threadId]' >
                              <button type='button'>Delete</button></a>
                              <a href='updateThread.php?id=$row[threadId]' >
                              <button type='button'>Update</button></a>
                              <button type='button' class='colorTag'>";
                    echo $row['tag'];
                    echo "</button>
                              <div class='author'>
                              <a href = 'profileOpen.php?userId=$row[userId]' >";
                    echo $username;          
                    echo " </a>  </div>
                                
                          </div>
                      </div>
                    </div>";      
                    echo "<p></p>";
                  }
            }else{
                echo "<h1>No. of Threads Posted : 0 </h1>";
            }
        ?>
    <!-- </div>
    </div> -->

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
