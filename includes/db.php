<?php 

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "cms";

foreach($db as $key => $value) {
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$connection) {
    die( 'Unable to Connect to Database');
}

function get_all_category() {

    $query = "SELECT * FROM categories";
    global $connection;
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to retrieve all category from database' . mysqli.error($connection));
    }
    
    return $result;

}

function add_category($cat_title) {
    $query = "INSERT INTO categories(cat_title) VALUE ('{$cat_title}')";
    global $connection;
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Unable to Add New category to database' . mysqli.error($connection));
    }
    
}

function remove_category($cat_id) {
    $query = "DELETE FROM categories WHERE cat_id = '{$cat_id}'";
    global $connection;
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Unable to Delete category to database' . mysqli.error($connection));
    } else {
        header("Location: categories.php");
    }
}

function get_all_posts() {


    $query = "SELECT * FROM posts";
    global $connection; 
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to retrieve all posts from database' . mysqli.error($connection));
    }
    
    return $result;
}

function search_blog($search) {
    
    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
    global $connection; 
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Unable to search data from database' . mysqli.error($connection));
    }
    
    return $result;
}
?>