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


function search_blog($search) {
    
    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
    global $connection; 
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Unable to search data from database' . mysqli_error($connection));
    }
    
    return $result;
}

include_once "database_query/posts_db.php";
include_once "database_query/categories_db.php";
include_once "database_query/comments_db.php";
include_once "database_query/users_db.php";

?>