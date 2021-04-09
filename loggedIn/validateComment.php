<?php
    include '../Pages/utility.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // print_r( $_POST ); die();
        
          
        $description = $mysqli->real_escape_string($_POST['description']);
        $threadId = $mysqli->real_escape_string($_POST['threadId']);
        // echo "<h3> PHP List All Session Variables</h3>";
        // foreach ($_SESSION as $key=>$val)
        // echo $key." ".$val."<br/>";
        // print_r("sdfdfdf" );
        // print_r($_SERVER['username'] ); die();
        $username =  $_SESSION['username'];
        // print_r($username);
         
        $str = "SELECT id from users where username = '$username'";
        $result=ExecuteQuery($str);
        // $no_rows = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        $userId = $row['id'];
        // print_r($userId);
        // if($no_rows > 0){
        //      while($row = mysqli_fetch_assoc($result)){
        //      echo "ID :{$row['id']} <br> ".
        //      "--------------------------------<br>";
        //      } //end of while
        //  }
        // print_r($description);
        // print_r($threadId);
        // die();
        $str="INSERT INTO comments ( description, userId,threadId,votes) "
        . "VALUES ('$description' , '$userId',$threadId,0)";
        $result=ExecuteQuery($str);

        header("location: threadView.php?id=$threadId");
    }
?>
