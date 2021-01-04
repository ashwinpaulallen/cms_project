<?php 
if(isset($_POST['new_post'])) {
    $post['cat_id'] = $_POST['cat_id'];
    $post['title'] = $_POST['title'];
    $post['author'] = $_POST['author'];
    $post_image = $_FILES['image']['name'];
    $post['image'] = $post_image;
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post['content'] = $_POST['content'];
    $post['tags'] = $_POST['tags'];
    $post['comment_count'] = 0;
    $post['status'] = $_POST['status'];
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
   
    add_post($post);
    
}

?>
<h1 class="page-header">Add Post</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Category</label>
        
        <select class="custom-select" id="inputGroupSelect01" name="cat_id" >
            <?php 
                $cat_result = get_all_category();
                
                while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                    echo "<option value='{$cat_row['cat_id']}'> {$cat_row['cat_title']} </option>";
                
                }
            ?>
        </select>
        </div>
    </div>
    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <input type="text" class="form-control" name="status">
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
        <label for="tags">Tags</label>
        <input type="text" class="form-control" name="tags">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <input type="text" class="form-control" name="content">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="new_post" value="Publish Post">
    </div>
</form>