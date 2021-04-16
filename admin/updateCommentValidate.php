<?php
    include '../Pages/utility.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        

        $description = $_POST['description'];
        
        
        
        // $topic = $mysqli->real_escape_string($_POST['topic']);
        // $summary = $mysqli->real_escape_string($_POST['summary']);
        // $tag = $mysqli->real_escape_string($_POST['tag']);
        $commentId = $_GET['id'];

        $username =  $_SESSION['username'];
         
        // $str = "SELECT id from users where username = '$username'";
        // $result=ExecuteQuery($str);
        // $row = mysqli_fetch_assoc($result);
        // $userId = $row['id'];
        

        // echo $description;
        // echo $commentId;
        // echo $userId;
        // die();

        // $str="UPDATE comments SET description = '$description'  where commentId = $commentId";
        $str = "CALL updateComment($commentId,'$description')";
        $result=ExecuteQuery($str);

        header("location: myComments.php");
    }
?>
