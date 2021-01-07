<?php

function get_all_comments() {
    $query = "SELECT * FROM comments";
    global $connection; 
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to retrieve all posts from database' . mysqli_error($connection));
    }
    
    return $result;
}

function get_all_approved_comments() {
    $query = "SELECT * FROM comments WHERE comment_status = 'approved'";
    global $connection; 
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to retrieve all posts from database' . mysqli_error($connection));
    }
    
    return $result;
}

function get_all_unapproved_comments() {
    $query = "SELECT * FROM comments WHERE comment_status != 'approved'";
    global $connection; 
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to retrieve all posts from database' . mysqli_error($connection));
    }
    
    return $result;
}

function get_comments_by_postid($post_id) {
    $query = "SELECT * FROM comments WHERE comment_post_id = '{$post_id}' ";
    $query .= "AND comment_status = 'approved' ORDER BY comment_id DESC";
    global $connection; 
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to retrieve all posts from database' . mysqli_error($connection));
    }
    
    return $result;
}

function add_comment($comment) {
    $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_date, comment_status) ";
    $query .= "VALUE ('{$comment['post_id']}', '{$comment['author']}', '{$comment['email']}', '{$comment['content']}', now(), 'new')";
    global $connection;
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Unable to Add New category to database' . mysqli_error($connection));
    }
}

function remove_comment($comment_id) {
    $query = "DELETE FROM comments WHERE comment_id = '{$comment_id}'";
    global $connection;
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Unable to Delete Post to database' . mysqli_error($connection));
    } else {
        header("Location: comments.php");
    }
}

function approve_comment($comment_id) {
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = '{$comment_id}'";
    global $connection;
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Unable to Delete Post to database' . mysqli_error($connection));
    } else {
        header("Location: comments.php");
    }
}

function unapprove_comment($comment_id) {
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = '{$comment_id}'";
    global $connection;
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Unable to Delete Post to database' . mysqli_error($connection));
    } else {
        header("Location: comments.php");
    }
}

?>