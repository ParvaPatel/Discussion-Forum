<?php
    include '../Pages/utility.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "df";
        die();
    }
    header("location: home.php");

?>
