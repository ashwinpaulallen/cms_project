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

function get_all_posts() {
    $query = "SELECT * FROM posts";
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
    $query = "SELECT * FROM posts WHERE post_cat_id = '{$cat_id}'";
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

function update_post($post) {
    echo $post['image'];
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

function search_blog($search) {
    
    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
    global $connection; 
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Unable to search data from database' . mysqli_error($connection));
    }
    
    return $result;
}
?>