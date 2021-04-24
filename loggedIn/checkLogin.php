<?php
    include '../Pages/utility.php';
    
    session_start();
    // echo $_SESSION['loggedin'];
    // die();
    if($_SESSION['loggedin']== false){
        header("location: ../Pages/login.php");
    }
?>
