<?php
    include '../Pages/utility.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // print_r( $_POST ); die();
        
          
        $topic = $mysqli->real_escape_string($_POST['topic']);
        $summary = $mysqli->real_escape_string($_POST['summary']);
        $tag = $mysqli->real_escape_string($_POST['tag']);
        // echo "<h3> PHP List All Session Variables</h3>";
        // foreach ($_SESSION as $key=>$val)
        // echo $key." ".$val."<br/>";
        // print_r("sdfdfdf" );
        // print_r($_SERVER['username'] ); die();
        $username =  $_SESSION['username'];
         
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

        // $str="INSERT INTO threads ( topic,summary, tag, userId,votes,views,noAnswers) "
        // . "VALUES ('$topic' ,'$summary', '$tag', '$userId',0,0,0)";
        $str = "CALL addNewThread('$topic','$summary','$tag',$userId)";
        $result=ExecuteQuery($str);

        header("location: home.php");
    }
?>
