
<h1 class="page-header">All Posts</h1>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
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
            <th class="text-center">Delete</th>                        
        </tr>
    </thead>
    <tbody class="text-center">
        <?php 
        $result = get_all_posts();

        if ($result != null) {
            while ($row = mysqli_fetch_assoc($result)) {
                $post_id = $row['post_id'];
                $post_cat_id = $row['post_cat_id'];
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
            <th class="text-center"><?php echo $post_id ?></th>
            <th class="text-center"><?php echo $post_cat_id ?></th>
            <th class="text-center"><?php echo $post_title ?></th>
            <th class="text-center"><?php echo $post_author ?></th>
            <th class="text-center"><?php echo $post_date ?></th>
            <th class="text-center"><img width="100" src="../images/<?php echo $post_image ?>"></th>
            <th class="text-center" width="200"><?php echo $post_content ?></th>
            <th class="text-center"><?php echo $post_tags ?></th>
            <th class="text-center"><?php echo $post_comment_count ?></th>
            <th class="text-center"><?php echo $post_status ?></th>
            <td><a href="posts.php?delete=<?php echo $post_id ?>" >Remove</a></td>

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