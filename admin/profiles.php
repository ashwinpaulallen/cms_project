<?php include "includes/header.php"; ?>

<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>
    
    <?php 
    if(isset($_POST['edit_user'])) {
        $user['first_name'] = $_POST['first_name'];
        $user['last_name'] = $_POST['last_name'];
        $user['email'] = $_POST['email'];
        $user['username'] = $_POST['username'];
        $user['password'] = $_POST['password'];
        $user_image = $_FILES['image']['name'];
        $user['image'] = $user_image;
        $user_image_temp = $_FILES['image']['tmp_name'];
    
        move_uploaded_file($user_image_temp, "../images/$user_image");
        
        update_user_profile($user);
        
    }
    ?>
    <div id="page-wrapper">

        <div class="container-fluid">
            <?php
                $userName = $_SESSION['username'];
                $result = get_user_by_username($userName);
            
                $row = mysqli_fetch_assoc($result);
            
            ?>
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">Profile Page</h1>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <img width="200" src="../images/<?php echo $row['image']?>">        
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="form-group">
                            <label for="title">Username</label>
                            <input type="text" class="form-control" value="<?php echo $row['username']?>"name="username" readonly>
                        </div>
                        <div class="form-group">
                            <label for="title">Password</label>
                            <input type="password" class="form-control" value="<?php echo $row['password']?>"name="password">
                        </div>
                        <div class="form-group">
                            <label for="author">First Name</label>
                            <input type="text" class="form-control" value="<?php echo $row['first_name'] ?>" name="first_name">
                        </div>
                        <div class="form-group">
                            <label for="author">Last Name</label>
                            <input type="text" class="form-control" value="<?php echo $row['last_name'] ?>" name="last_name">
                        </div>
                        <div class="form-group">
                            <label for="author">Email</label>
                            <input type="text" class="form-control" value="<?php echo $row['email'] ?>" name="email">
                        </div>

                        
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="edit_user" value="Update Profile">
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/footer.php"; ?>
