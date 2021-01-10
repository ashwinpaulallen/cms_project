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

function get_randSalt() {
    $query = "SELECT randSalt FROM users";
    global $connection;
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to Get Post from database' . mysqli_error($connection));
    }
    
    while ($row = mysqli_fetch_assoc($result)) {
        $randSalt = $row['randSalt'];
        if(!empty($randSalt)) {
            break;
        }
    }
    
    return $randSalt;
}

function add_user($user) {
    $randSalt = get_randSalt();
    $password = crypt($user['password'], $randSalt);
    
    $query = "INSERT INTO users(username, password, first_name, last_name, role, email, created_date, image) VALUES";
    $query .= "('{$user['username']}','{$password}','{$user['first_name']}','{$user['last_name']}','{$user['role']}','{$user['email']}',now(),'{$user['image']}')";
    
    global $connection; 
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to add User to database' . mysqli_error($connection));
    } else {
        header("Location: users.php");
    }
}

function add_new_user($user){
    global $connection; 
    
    $user['firstname'] = mysqli_escape_string($connection, $user['firstname']);
    $user['lastname'] = mysqli_escape_string($connection, $user['lastname']);
    $user['email'] = mysqli_escape_string($connection, $user['email']);
    $user['password'] = mysqli_escape_string($connection, $user['password']);
    $user['username'] = mysqli_escape_string($connection, $user['username']);
    
    $randSalt = get_randSalt();

    $password = crypt($user['password'], $randSalt);
    
    $query = "INSERT INTO users(username, password, first_name, last_name, email, created_date) VALUES";
    $query .= "('{$user['username']}','$password', '{$user['firstname']}', '{$user['lastname']}', '{$user['email']}', now())";
    
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Unable to add User to database' . mysqli_error($connection));
    } else {
        header("Location: index.php");
    }
}

function update_user($user) {
    $randSalt = get_randSalt();
    $password = crypt($user['password'], $randSalt);
    
    $query = "UPDATE users SET ";
    $query .= "username = '{$user['username']}', ";
    $query .= "password = '{$password}', ";
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
    $randSalt = get_randSalt();
    $password = crypt($user['password'], $randSalt);
    
    $query = "UPDATE users SET ";
    $query .= "password = '{$password}', ";
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
    
    $query = "SELECT * FROM users WHERE username = '{$username}'";
    
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Unable to Get User Details from database' . mysqli_error($connection));
    }
    
    $count = mysqli_num_rows($result);
    
    if ($count == 0) {
        return null;
    } else {
        $row = mysqli_fetch_assoc($result);
        $randSalt = $row['randSalt'];
        $encrypt_password = crypt($password, $randSalt);

        if ($encrypt_password == $row['password']) {
            return $row;
        } else {
            function_alert('Invalid Username/Password!!');
            return null;
        }
    }
    
    return null;
}

?>