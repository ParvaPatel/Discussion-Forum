<?php
    include '../Pages/utility.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        

        $topic = $_POST['topic'];
        $summary = $_POST['summary'];
        $tag = $_POST['tag'];
        
        
        // $topic = $mysqli->real_escape_string($_POST['topic']);
        // $summary = $mysqli->real_escape_string($_POST['summary']);
        // $tag = $mysqli->real_escape_string($_POST['tag']);
        $threadId = $_GET['id'];

        $username =  $_SESSION['username'];
         
        $str = "SELECT extractUserId('$username') as id";
        $result=ExecuteQuery($str);
        $row = mysqli_fetch_assoc($result);
        $userId = $row['id']; 

        // echo $topic;
        // echo $summary;
        // echo $tag;
        // echo $userId;
        // echo $threadId;
        // die();

        // $str="UPDATE threads SET topic = '$topic' , summary = '$summary' , tag = '$tag' where threadId = $threadId";
        $str = "CALL updateThread($threadId,'$topic','$summary','$tag')";
        $result=ExecuteQuery($str);

        header("location: threadView.php?id=$threadId");
    }
?>
