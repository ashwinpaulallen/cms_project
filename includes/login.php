<?php

$login_result = validate_login($username, $password);

if ($login_result != null) {
    if(!isset($_SESSION)) {
        session_start();   
    }
    print_r($result);
    $_SESSION['username'] = $login_result['username'];
    $_SESSION['firstname'] = $login_result['first_name'];
    $_SESSION['lastname'] = $login_result['last_name'];
    $_SESSION['role'] = $login_result['role'];

    if ($login_result['role'] == 'admin') {
        header("Location: admin");
    } else {
        header("Location: index.php");
    } 
} else {
    $message = 'Invalid Username/Password';
}
 
?>