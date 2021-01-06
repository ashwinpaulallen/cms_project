<?php
    include "db.php";
    if(isset($_POST['login_submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $result = validate_login($username, $password);
        
        if ($result != null) {
            $row = mysqli_fetch_assoc($result);
            echo " Welcome: " . $row['first_name'];
        } else {
            header("Location: ../index.php");
        }
    } 
?>