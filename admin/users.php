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
                        $s = '';
                        if(isset($_GET['s'])) {
                            $s = $_GET['s'];
                        }
                    
                        switch($s) {
                            case 'add_user':
                                include "includes/addUser.php";
                                break;
                            case 'edit_user':
                                include "includes/editUser.php";
                                break;
                            default:
                                include "includes/viewAllUsers.php";
                                break;
                        }
                    ?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    
    <?php include "includes/footer.php"; ?>
