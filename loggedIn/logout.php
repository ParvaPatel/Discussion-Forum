<?php
    include '../Pages/utility.php';
    
    session_start();
    unset($_SESSION['username']);
    $_SESSION['loggedin'] = false;


        
        

    header("location: ../Pages/login.php");
?>
