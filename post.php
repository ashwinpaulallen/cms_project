<?php  include "includes/header.php" ?>
<!-- Navigation -->
<?php include "includes/db.php" ?>
<?php  include "includes/navigation.php"?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            
            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>
            <?php 
                if(isset($_POST['create_comment'])){
                    $comment['post_id'] = $_GET['id'];
                    $comment['author'] = $_POST['author'];
                    $comment['email'] = $_POST['email'];
                    $comment['content'] = $_POST['content'];
                    if (!empty($comment['email']) && !empty($comment['author']) && !empty($comment['content'])) {                    
                        add_comment($comment);
                        update_comment_count($comment['post_id']);
                    } else {
                        function_alert("Fields cannot be Empty!!!");
                    }
                }
            
            ?>
            <!--  Blog Post -->
            <?php 
                if (isset($_GET['id'])) {
                    $post_id = $_GET['id'];
                    $result = get_post_by_id($post_id);
                }

                if ($result != null) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];            
                        ?>
                    
                    <h2>
                        <a href="#"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <hr>     
                    <?php
                    } 
                }
            ?>
            <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" role="form" method="post">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" class="form-control" name="author">
                        </div><div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea class="form-control" rows="3" name="content"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php 
                    if (isset($_GET['id'])) {
                        $post_id = $_GET['id'];
                        $comments = get_comments_by_postid($post_id);
                    }
                    while ($comment = mysqli_fetch_assoc($comments)){
                        $comment_author = $comment['comment_author'];
                        $comment_date = $comment['comment_date'];
                        $comment_content = $comment['comment_content'];
            
            
                    ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"> <?php echo $comment_author;?>
                            <small><?php echo $comment_date;?></small>
                        </h4>
                            <?php echo $comment_content;?>
                    </div>
                </div>
                <?php } ?>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php  include "includes/sidebar.php"?>
    </div>
    <!-- /.row -->
    <hr>
    <?php  include "includes/footer.php"?>
