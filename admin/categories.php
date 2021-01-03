<?php include "includes/header.php"; ?>

<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Admin Console
                        <small>Author</small>
                    </h1>
                    <!-- START: Add Category Form-->
                    <div class="col-xs-6"> 
                       <?php 
                            if (isset($_POST['cat_submit'])) {
                                $cat_title = $_POST['cat_title'];
                                
                                if ($cat_title != "" || !empty($cat_title)) {
                                    add_category($cat_title);
                                }
                            }                        
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                               <label for="cat-title">Category Name</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="cat_submit" value="Add Category">
                            </div>
                        </form>
                    </div>
                    <!-- END: Add Category Form-->
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Category Title</th>
                                    <th class="text-center">Delete</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                               <?php 
                                    $result = get_all_category();
                                    if ($result != null) {
                                        $count = mysqli_num_rows($result);
                                        if ($count == 0){
                                            echo "<h1>No Category found</h1>";
                                        }
                                    }

                                    if ($result != null) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];
                                ?>
                                            <tr >
                                                <td><?php echo $cat_id ?></td>
                                                <td><?php echo $cat_title ?></td>
                                                <td><a href="categories.php?delete=<?php echo $cat_id ?>" >Remove</a></td>
                                            </tr>
                                            <?php 
                                        }
                                    } 
                                ?>
                                
                                <?php
                                    if(isset($_GET['delete'])) {
                                        $delete_id = $_GET['delete'];
                                        remove_category($delete_id);
                                    }
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    
    <?php include "includes/footer.php"; ?>
