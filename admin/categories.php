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
                    
                    <div class="col-xs-6"> 
                       <?php 
                            if (isset($_POST['cat_submit'])) {
                                $cat_title = $_POST['cat_title'];
                                
                                if ($cat_title != "" || !empty($cat_title)) {
                                    add_category($cat_title);
                                }
                            } 
                            if (isset($_POST['edit_submit'])) {
                                $edit_title = $_POST['new_title'];
                                $edit_id = $_POST['new_id'];
                                if ($edit_title != "" || !empty($edit_title)) {
                                    update_category($edit_id, $edit_title);
                                }
                            }                        
                        ?>
                        <!-- START: Add/Edit Category Form-->
                        <form action="" method="post">
                           <?php 
                                if (isset($_GET['edit'])) {
                                    $edit_id = $_GET['edit'];
                                    $result = get_category_by_id($edit_id);
                                    $row = mysqli_fetch_assoc($result);
                                    $edit_title = $row['cat_title'];
                                    ?>
                                    <div class="form-group">
                                        <label for="cat-title">Edit Category </label>
                                        <input value="<?php echo $edit_id?>" class="form-control" type="text" name="new_id" readonly>
                                    </div>
                                    <div class="form-group">
<!--                                        <label for="cat-title">Edit Category </label>-->
                                        <input value="<?php echo $edit_title?>" class="form-control" type="text" name="new_title">
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" name="edit_submit" value="Edit Category">
                                    </div>
                            <?php } else {    ?>
                                    <div class="form-group">
                                       <label for="cat-title">Add Category </label>
                                        <input class="form-control" type="text" name="cat_title">
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" name="cat_submit" value="Add Category">
                                    </div>
                            <?php } ?>
                        </form>
                    </div>
                    <!-- END: Add/Edit Category Form-->
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Category Title</th>
                                    <th class="text-center">Delete</th>
                                    <th class="text-center">Modify</th>
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
                                                <td><a href="categories.php?edit=<?php echo $cat_id ?>" >Edit</a></td>
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
