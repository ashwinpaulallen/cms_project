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

function cat_nav_bar() {
    
    $query = "SELECT * FROM categories";
    global $connection;
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to retrieve data from database' . mysqli.error($connection));
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $cat_title = $row['cat_title'];
        echo "<li> <a href='#'> ${cat_title} </a></li>";
    }
    
}


?>