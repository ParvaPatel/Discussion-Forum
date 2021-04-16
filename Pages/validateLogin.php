<?php
    include 'utility.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $mysqli->real_escape_string($_POST['username']);
        $email = $mysqli->real_escape_string($_POST['email']);
        //md5 hash password for security
        $password = md5($_POST['password']);
        // $str="SELECT * FROM users where username = '$username' and email = '$email' and password = '$password'";
        $str = "SELECT loginUser('$username','$email','$password') as noRows";
        $result=ExecuteQuery($str);
        // $no_rows = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $noRows = $row['noRows'];
        // echo $noRows;
        // die();
        if($noRows < 1){
            $_SESSION['message'] = 'Invalid Credentials';  
        }
        
        else{   
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;
            if($username == 'admin'){
                header("location: ../admin/home.php");
            }else{
                header("location: ../loggedIn/home.php");
            }
        }
    }   
?>