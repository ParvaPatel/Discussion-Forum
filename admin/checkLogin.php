<?php
    include '../Pages/utility.php';
    
    session_start();
    // echo $_SESSION['loggedin'];
    // die();
    if($_SESSION['loggedin'] == false){
        header("location: ../Pages/login.php");
    }else{
        echo "ff";
        // header("location: {$_SERVER['HTTP_REFERER']}");
    }
    // echo "Dfdf";
    // die();
?>
