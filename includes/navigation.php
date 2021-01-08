
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CMS Project </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php 
                    $result = get_all_category(); 

                    while ($row = mysqli_fetch_assoc($result)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<li> <a href='category.php?id=$cat_id'> ${cat_title} </a></li>";
                    }                
                ?>
                
            </ul>
            <?php 
            if (isset($_SESSION['username'])) {
            ?>    
            <ul class="nav navbar-nav navbar-right">
              <?php if($_SESSION['role'] == 'admin') { ?>
               <li> <a href="admin">Admin</a> </li>
               <?php } ?>
               
               <?php
                if(isset($_SESSION['firstname'])) {
                    if(isset($_GET['id'])) {
                        $p_id = $_GET['id'];
                        $post = get_post_by_id($p_id);
                        $row = mysqli_fetch_assoc($post);
                        if ($_SESSION['firstname'] == $row['post_author']) {
                            echo "<li><a href='admin/posts.php?s=edit_post&id={$p_id}'> Edit Post</a></li>";
                        }
                    }
                }
                
                ?>
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];?> <b class="caret"></b></a>
                <ul class="dropdown-menu sub_nav">
                    <li>
                        <a href="admin/profiles.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <li>
                        <a href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>                
            </ul>
            <?php } ?>
        </div>
<!--
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
-->
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
