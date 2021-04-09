<?php
    include 'utility.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $mysqli->real_escape_string($_POST['username']);
        $email = $mysqli->real_escape_string($_POST['email']);
        //md5 hash password for security
        $password = md5($_POST['password']);
        $str="SELECT * FROM users where username = '$username' and email = '$email' and password = '$password'";
        $result=ExecuteQuery($str);
        $no_rows = mysqli_num_rows($result);
        // print_r($password);
        // print_r($username);
        // print_r($email);
        // print_r($result);
        // die();
        if($no_rows < 1){
            $_SESSION['message'] = 'Invalid Credentials';
            // print_r("In a Invalid");
            // while($usersData = mysqli_fetch_array($result)){
            //     print_r($usersData);
            // }
            // die();  
        }
        
        else{
            // print_r("In a Valid");
            // while($usersData = mysqli_fetch_array($result)){
            //     print_r($usersData);
            // }
            // die(); 
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;
            // print_r($_SESSION['username']);
            // print_r($_SESSION['loggedin']);
            // die();
            header("location: ../loggedIn/home.php");

        }
    }
           
?>
<!-- 25f9e794323b453885f5181f1b624d0b -->