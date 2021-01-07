<?php

function get_all_category() {

    $query = "SELECT * FROM categories";
    global $connection;
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to retrieve all category from database' . mysqli_error($connection));
    }
    
    return $result;

}

function get_category_by_id($cat_id) {
    $query = "SELECT * FROM categories WHERE cat_id = '{$cat_id}'";
    global $connection;
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to retrieve all category from database' . mysqli_error($connection));
    }
    
    return $result;
}

function add_category($cat_title) {
    $query = "INSERT INTO categories(cat_title) VALUE ('{$cat_title}')";
    global $connection;
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Unable to Add New category to database' . mysqli_error($connection));
    }
    
}

function update_category($cat_id, $cat_title) {
    $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = '{$cat_id}'";
    global $connection;
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Unable to Update category in database' . mysqli_error($connection));
    } else {
        header("Location: categories.php");
    }
}

function remove_category($cat_id) {
    $query = "DELETE FROM categories WHERE cat_id = '{$cat_id}'";
    global $connection;
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Unable to Delete category to database' . mysqli_error($connection));
    } else {
        header("Location: categories.php");
    }
}

?>