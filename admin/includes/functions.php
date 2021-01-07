<?php

function get_category_title_by_id($cat_id) {
    $title = '';
    $result = get_category_by_id($cat_id);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['cat_title'];
        return $title;
    }
   if ($result == null) { 
       echo "row not found";
   }
    return $title;
} 

function get_user_count() {
    $result = get_all_users();
    $count=mysqli_num_rows($result);
    return $count;
}

function get_post_count() {
    $result = get_all_posts();
    
    $count=mysqli_num_rows($result);
    
    return $count;
}

function get_comment_count() {
    $result = get_all_comments();
    $count=mysqli_num_rows($result);
    return $count;
}

function get_category_count() {
    $result = get_all_category();
    $count=mysqli_num_rows($result);
    return $count;
}
?>