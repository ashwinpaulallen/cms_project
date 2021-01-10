<div class="col-md-4">
    

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="index.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" name="search_submit" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>
    <?php if (!isset($_SESSION['username'])) { ?>
    <div class="well">
        <h4>Login/Registration</h4>
        <h6><?php echo $message; ?></h6>
        <form action="" method="post">
           <div class="form-group">
<!--                <label for="username">Username</label>-->
                <input name="username" type="text" class="form-control" placeholder="Enter Username">
           </div>

            <div class="form-group">
               <input name="password" type="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" name="login_submit" type="submit" > Login </button>
                <a class="btn btn-primary" href="registration.php">Registration</a>
            </div>
        </form>
    </div>
    <?php }?>
    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php 
                    
                        $result = get_all_category();
                    
                        while ($row = mysqli_fetch_assoc($result)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            echo "<li> <a href='category.php?id=$cat_id'> ${cat_title} </a></li>";
                        } 
                    
                    ?>
                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "sidewidget.php"; ?>

</div>