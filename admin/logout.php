<?php
    include '../Pages/utility.php';
    
    session_start();
    // echo $_SESSION['username'];
    // echo $_SESSION['loggedin'];
    // die();
    unset($_SESSION['username']);
    $_SESSION['loggedin'] = false;


        
        

    header("location: ../Pages/login.php");
?>
