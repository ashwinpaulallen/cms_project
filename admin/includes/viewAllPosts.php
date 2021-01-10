<?php

if(isset($_POST['checkBoxArray'])) {
    foreach($_POST['checkBoxArray'] as $checkBoxValue) {
        echo $checkBoxValue;
        $bulk_status = $_POST['bulk_status'];
        update_status($checkBoxValue, $bulk_status);
    }
        
}

?>


<h1 class="page-header">All Posts</h1>
<form action="" method="post">
    <table class="table table-bordered table-hover">
       <div id="bulkOptionsContainer" class="col-xs-4 form-group">
           <select class="form-control" name="bulk_status" id="">
               <option value="">Select Option</option>
               <option value="approved">Publish</option>
               <option value="Draft">Draft</option>
               <option value="rejected">Reject</option>
           </select>
        </div>
           <div class="col-xs-4 form-group">
               <input type="submit" class="btn btn-success" value="Apply">
               <a class="btn btn-primary" href="posts.php?s=add_post">Add New</a>
           </div>
        <thead>
            <tr>
                <th class="text-center"><input type="checkbox" id="selectAllBoxes"></th>
                <th class="text-center">ID</th>
                <th class="text-center">Category ID</th>
                <th class="text-center">Title</th>
                <th class="text-center">Author</th>
                <th class="text-center">Date</th>
                <th class="text-center">Image</th>
                <th class="text-center">Content</th>
                <th class="text-center">Tags</th>
                <th class="text-center">Comments Count</th>
                <th class="text-center">Status</th>   
                <th class="text-center">Modify</th>  
                <th class="text-center">Delete</th>                                              
            </tr>
        </thead>
        <tbody class="text-center">
            <?php 
            $result = get_all_posts();

            if ($result != null) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $post_id = $row['post_id'];
                    $post_cat_id = get_category_title_by_id($row['post_cat_id']);
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];            
                    $post_tags = $row['post_tags'];            
                    $post_comment_count = $row['post_comment_count'];            
                    $post_status = $row['post_status'];

            ?>
            <tr >
                <th class="text-center"><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id ?>"></th>
                <th class="text-center"><?php echo $post_id ?></th>
                <th class="text-center"><?php echo $post_cat_id ?></th>
                <th class="text-center"><a href="../post.php?id=<?php echo $post_id ?>"><?php echo $post_title ?> </a></th>
                <th class="text-center"><?php echo $post_author ?></th>
                <th class="text-center"><?php echo $post_date ?></th>
                <th class="text-center"><img width="100" src="../images/<?php echo $post_image ?>"></th>
                <th class="text-center" width="200"><?php echo $post_content ?></th>
                <th class="text-center"><?php echo $post_tags ?></th>
                <th class="text-center"><?php echo $post_comment_count ?></th>
                <th class="text-center"><?php echo $post_status ?></th>
                <td><a href="posts.php?s=edit_post&id=<?php echo $post_id ?>" >Edit</a></td>
                <td><a onClick="javascript: return confirm('Confirm Delete');" href="posts.php?delete=<?php echo $post_id ?>" >Remove</a></td>


            </tr>
            <?php }
            }
            ?>

            <?php
            if(isset($_GET['delete'])) {
                $delete_id = $_GET['delete'];
                remove_post($delete_id);
            }

            ?>
        </tbody>
    </table>
</form>