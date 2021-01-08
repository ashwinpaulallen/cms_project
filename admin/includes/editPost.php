<?php 
if(isset($_GET['id'])) {

    $post_id = $_GET['id'];

    $result = get_post_by_id($post_id);

    $row = mysqli_fetch_assoc($result);


?>
<h1 class="page-header">Edit Post</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="id">Post ID</label>
        <input type="text" class="form-control" value="<?php echo $row['post_id']?>"name="id" readonly>
    </div>
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" value="<?php echo $row['post_title']?>"name="title">
    </div>
    <div class="form-group">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Category</label>
        
        <select class="custom-select form-control" id="inputGroupSelect01" name="cat_id" >
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
        <input type="text" class="form-control" value="<?php echo $row['post_author'] ?>" name="author">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" class="custom-select form-control" id="inputGroupSelect01">
          <option value="<?php echo $row['post_status'] ?>"><?php echo $row['post_status'] ?></option>
          <?php
          if ($row['post_status'] == 'approved')  {
                   echo "<option value='rejected'>Reject</option>";  
           } else if ($row['post_status'] == 'rejected'){
                echo "<option value='approved'>Approve</option>"; 

           } else {
                echo "<option value='rejected'>Reject</option>";  
                echo "<option value='approved'>Approve</option>";
          }
            ?>
        </select>

    </div>
    <label for="image">Image</label>
    <div class="form-group">
        
        <img width="200" src="../images/<?php echo $row['post_image']?>">        
    </div>
    <div class="form-group">
        <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
        <label for="tags">Tags</label>
        <input type="text" class="form-control" value="<?php echo $row['post_tags'] ?>" name="tags">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control"  name="content" cols="30" rows="10" id="body"><?php echo $row['post_content'] ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_post" value="Update Post">
    </div>
</form>


<?php } ?> 

<?php 
    if(isset($_POST['edit_post'])) {
        $post['post_id'] = $_POST['id'];
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
        
        update_post($post);
        
    }

?>   