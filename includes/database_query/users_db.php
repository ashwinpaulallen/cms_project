<?php
    function get_all_users() {

    $query = "SELECT * FROM users";
    global $connection;
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to retrieve all category from database' . mysqli_error($connection));
    }
    
    return $result;
}

function add_user($user) {
    $query = "INSERT INTO users(username, password, first_name, last_name, role, email, created_date, image) VALUES";
    $query .= "('{$user['username']}','{$user['password']}','{$user['first_name']}','{$user['last_name']}','{$user['role']}','{$user['email']}',now(),'{$user['image']}')";
    
    global $connection; 
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to add post to database' . mysqli_error($connection));
    } else {
        header("Location: users.php");
    }
}

function remove_user($user_id) {
    $query = "DELETE FROM users WHERE user_id = '{$user_id}'";
    global $connection;
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Unable to Delete Post to database' . mysqli_error($connection));
    } else {
        header("Location: users.php");
    }
}


?>