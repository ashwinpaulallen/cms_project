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

function get_admin_count() {
    $result = get_all_admin();
    $count=mysqli_num_rows($result);
    return $count;
}

function get_user_count() {
    $result = get_all_users();
    $count=mysqli_num_rows($result);
    return $count;
}

function get_subscriber_count() {
    $result = get_all_subscribers();
    $count=mysqli_num_rows($result);
    return $count;
}

function get_post_count() {
    $result = get_all_posts();
    
    $count=mysqli_num_rows($result);
    
    return $count;
}

function get_approved_post_count() {
    $result = get_all_approved_posts();
    
    $count=mysqli_num_rows($result);
    
    return $count;
}

function get_unapproved_post_count() {
    $result = get_all_unapproved_posts();
    
    $count=mysqli_num_rows($result);
    
    return $count;
}

function get_comment_count() {
    $result = get_all_comments();
    $count=mysqli_num_rows($result);
    return $count;
}

function get_approved_comment_count() {
    $result = get_all_approved_comments();
    
    $count=mysqli_num_rows($result);
    
    return $count;
}

function get_unapproved_comment_count() {
    $result = get_all_unapproved_comments();
    
    $count=mysqli_num_rows($result);
    
    return $count;
}

function get_category_count() {
    $result = get_all_category();
    $count=mysqli_num_rows($result);
    return $count;
}

function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');</script>"; 
} 
?>