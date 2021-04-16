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
         
        $str = "SELECT extractUserId('$username') as id";
        $result=ExecuteQuery($str);
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
        // print_r($userId);
        // die();
        // $str="INSERT INTO comments ( description, userId,threadId,votes) "
        // . "VALUES ('$description' , $userId,$threadId,0)";
        $str = "CALL addNewComment('$description' , $userId,$threadId)";
        $result=ExecuteQuery($str);

        header("location: threadView.php?id=$threadId");
    }
?>
