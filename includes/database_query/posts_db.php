<?php

function get_all_posts() {
    $query = "SELECT * FROM posts";
    global $connection; 
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to retrieve all posts from database' . mysqli_error($connection));
    }
    
    return $result;
}

function get_all_approved_posts() {
    $query = "SELECT * FROM posts WHERE post_status = 'approved'";
    global $connection; 
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to retrieve all posts from database' . mysqli_error($connection));
    }
    
    return $result;
}

function get_all_unapproved_posts() {
    $query = "SELECT * FROM posts WHERE post_status != 'approved'";
    global $connection; 
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to retrieve all posts from database' . mysqli_error($connection));
    }
    
    return $result;
}

function get_post_by_id($post_id) {
    $query = "SELECT * FROM posts WHERE post_id = '{$post_id}'";
    global $connection;
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to Get Post from database' . mysqli_error($connection));
    }
    
    return $result;
}

function get_posts_by_cat($cat_id) {
    $query = "SELECT * FROM posts WHERE post_cat_id = '{$cat_id}' AND post_status = 'approved'";
    global $connection;
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to Get Post from database' . mysqli_error($connection));
    }
    
    return $result;
}

function add_post($post) {
    $query = "INSERT INTO posts(post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES";
    $query .= "('{$post['cat_id']}','{$post['title']}','{$post['author']}',now(),'{$post['image']}','{$post['content']}','{$post['tags']}','{$post['comment_count']}','{$post['status']}')";
    
    global $connection; 
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die('Unable to add post to database' . mysqli_error($connection));
    } else {
        header("Location: posts.php");
    }
}

function update_status($post_id, $post_status) {
    $query = "UPDATE posts SET post_status = '{$post_status}' WHERE post_id = '{$post_id}'";
    global $connection;
    $result = mysqli_query($connection, $query);
    if(!$result) {
        die('Unable to Update post status in database ' . mysqli_error($connection));
    } else {
       header("Location: posts.php");
    }
}

function update_post($post) {
    if (empty($post['image'])) {
        $cur_post = get_post_by_id($post['post_id']);
        $row = mysqli_fetch_assoc($cur_post);
        
        $post_image = $row['post_image'];
    } else {
        $post_image = $post['image'];
    }
    
    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post['title']}', ";
    $query .= "post_cat_id = '{$post['cat_id']}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post['author']}', ";
    $query .= "post_status = '{$post['status']}', ";
    $query .= "post_tags = '{$post['tags']}', ";
    $query .= "post_content = '{$post['content']}', ";
    $query .= "post_comment_count = 0, ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = '{$post['post_id']}'";

    global $connection;
    $result = mysqli_query($connection, $query);
    if(!$result) {
        die('Unable to Update post in database' . mysqli_error($connection));
    } else {
       header("Location: posts.php");
    }
}

function update_comment_count($post_id) {
    $query = "UPDATE posts SET ";
    $query .= "post_comment_count = post_comment_count +1 WHERE post_id = '{$post_id}'";
    
    global $connection;
    $result = mysqli_query($connection, $query);
    if(!$result) {
        die('Unable to Update post in database' . mysqli_error($connection));
    }
}

function remove_post($post_id) {
    $query = "DELETE FROM posts WHERE post_id = '{$post_id}'";
    global $connection;
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Unable to Delete Post to database' . mysqli_error($connection));
    } else {
        header("Location: posts.php");
    }
}

?>