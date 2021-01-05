<?php include "includes/header.php"; ?>

<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    
                    <?php 
//                        $s = '';
//                        if(isset($_GET['s'])) {
//                            $s = $_GET['s'];
//                        }
//                    
//                        switch($s) {
//                            case 'add_post':
//                                include "includes/addPost.php";
//                                break;
//                            case 'edit_post':
//                                include "includes/editPost.php";
//                                break;
//                            default:
                                include "includes/viewAllComments.php";
//                                break;
//                        }
                    ?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    
    <?php include "includes/footer.php"; ?>
