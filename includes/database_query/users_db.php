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

function get_all_admin() {

    $query = "SELECT * FROM users WHERE role = 'admin'";
    global $connection;
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to retrieve all category from database' . mysqli_error($connection));
    }
    
    return $result;
}

function get_all_subscribers() {

    $query = "SELECT * FROM users WHERE role != 'admin'";
    global $connection;
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to retrieve all category from database' . mysqli_error($connection));
    }
    
    return $result;
}

function get_user_by_id($user_id) {
    $query = "SELECT * FROM users WHERE user_id = '{$user_id}'";
    global $connection;
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to Get Post from database' . mysqli_error($connection));
    }
    
    return $result;
}

function get_user_by_username($username) {
    $query = "SELECT * FROM users WHERE username = '{$username}'";
    global $connection;
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to Get Post from database' . mysqli_error($connection));
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

function update_user($user) {
    
    $query = "UPDATE users SET ";
    $query .= "username = '{$user['username']}', ";
    $query .= "password = '{$user['password']}', ";
    $query .= "first_name = '{$user['first_name']}', ";
    $query .= "last_name = '{$user['last_name']}', ";
    $query .= "role = '{$user['role']}', ";
    $query .= "email = '{$user['email']}' ";
    $query .= "WHERE user_id = '{$user['user_id']}'";

    global $connection;
    $result = mysqli_query($connection, $query);
    if(!$result) {
        die('Unable to Update post in database' . mysqli_error($connection));
    } else {
       header("Location: users.php");
    }
}

function update_user_profile($user) {
    if (empty($user['image'])) {
        $cur_user = get_user_by_username($user['username']);
        $row = mysqli_fetch_assoc($cur_user);
        
        $user_image = $row['image'];
    } else {
        $user_image = $user['image'];
    }
    
    $query = "UPDATE users SET ";
    $query .= "password = '{$user['password']}', ";
    $query .= "first_name = '{$user['first_name']}', ";
    $query .= "last_name = '{$user['last_name']}', ";
    $query .= "email = '{$user['email']}', ";
    $query .= "image = '{$user_image}' ";
    $query .= "WHERE username = '{$user['username']}'";

    global $connection;
    $result = mysqli_query($connection, $query);
    if(!$result) {
        die('Unable to Update post in database' . mysqli_error($connection));
    } else {
       header("Location: profiles.php");
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

function validate_login($username, $password) {
    global $connection;
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    
     $query = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'";
    
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Unable to Delete Post to database' . mysqli_error($connection));
    }
    
    $count = mysqli_num_rows($result);
    
    if ($count == 0) {
        return null;
    }
    
    return $result;
}

?>