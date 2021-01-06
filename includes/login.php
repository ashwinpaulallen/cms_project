<?php
    include "db.php";
    session_start();
    if(isset($_POST['login_submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $result = validate_login($username, $password);
        
        if ($result != null) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            $_SESSION['firstname'] = $row['first_name'];
            $_SESSION['lastname'] = $row['last_name'];
            $_SESSION['role'] = $row['role'];
            
            if ($row['role'] == 'admin') {
                header("Location: ../admin");
            } else {
                header("Location: ../index.php");
            }
        } else {
            header("Location: ../index.php");
        }
    } 
?>