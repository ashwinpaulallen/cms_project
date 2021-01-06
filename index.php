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
                <?php
                    if(isset($_SESSION['firstname'])) {
                        echo "<small>Welcome " . $_SESSION['firstname'] . "</small> ";
                    } else {
                        echo "<small>Secondary Text</small>";
                    }
                ?>
            </h1>

            <!-- First Blog Post -->
            <?php 
                if (isset($_POST['search_submit'])) {
                    $search = $_POST['search'];
                    $result = search_blog($search);
                    
                } else { 
                    $result = get_all_approved_posts();
                }
                    
                if ($result != null) {
                    $count = mysqli_num_rows($result);
                    if ($count == 0){
                        echo "<h1>No Posts found</h1>";
                    }
                }

                if ($result != null) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,100);            
                        ?>
                    
                    <h2>
                        <a href="post.php?id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="post.php?id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <hr>     
                    <?php
                    } 
                }
            ?>
        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php  include "includes/sidebar.php"?>
    </div>
    <!-- /.row -->
    <hr>
    <?php  include "includes/footer.php"?>
