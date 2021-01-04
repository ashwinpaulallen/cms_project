<?php include "functions.php" ?>
<h1 class="page-header">All Comments</h1>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Post ID</th>
            <th class="text-center">Author</th>
            <th class="text-center">Email</th>
            <th class="text-center">Content</th>
            <th class="text-center">Date</th>
            <th class="text-center">Status</th>
            <th class="text-center">Approve</th>
            <th class="text-center">UnApprove</th>
            <th class="text-center">Delete</th>                        
            </tr>
    </thead>
    <tbody class="text-center">
        <?php 
        $result = get_all_comments();

        if ($result != null) {
            while ($row = mysqli_fetch_assoc($result)) {
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_email = $row['comment_email'];
                $comment_content = $row['comment_content'];            
                $comment_date = $row['comment_date'];            
                $comment_status = $row['comment_status'];

        ?>
        <tr >
            <th class="text-center"><?php echo $comment_id ?></th>
            <th class="text-center"><?php echo $comment_post_id ?></th>
            <th class="text-center"><?php echo $comment_author ?></th>
            <th class="text-center"><?php echo $comment_email ?></th>
            <th class="text-center"><?php echo $comment_content ?></th>
            <th class="text-center"><?php echo $comment_date ?></th>
            <th class="text-center"><?php echo $comment_status ?></th>
            <td><a href="comments.php?s=edit_post&id=<?php echo $comment_id ?>" >Approve</a></td>
            <td><a href="comments.php?s=edit_post&id=<?php echo $comment_id ?>" >UnApprove</a></td>
            <td><a href="comments.php?delete=<?php echo $comment_id ?>" >Remove</a></td>

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