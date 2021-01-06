<?php include "functions.php" ?>
<h1 class="page-header">All Users</h1>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">First Name</th>
            <th class="text-center">Last Name</th>
            <th class="text-center">Username</th>
            <th class="text-center">Email</th>
            <th class="text-center">Role</th>
            <th class="text-center">Created</th>
            <th class="text-center">Image</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>                        
            </tr>
    </thead>
    <tbody class="text-center">
        <?php 
        $result = get_all_users();

        if ($result != null) {
            while ($row = mysqli_fetch_assoc($result)) {
                $user_id = $row['user_id'];
                $user_first_name = $row['first_name'];
                $user_last_name = $row['last_name'];
                $user_username = $row['username'];
                $user_email = $row['email'];            
                $user_role = $row['role'];            
                $user_created_date = $row['created_date'];            
                $user_image = $row['image'];
                
        ?>
        <tr >
            <th class="text-center"><?php echo $user_id ?></th>
            <th class="text-center"><?php echo $user_first_name ?></th>
            <th class="text-center"><?php echo $user_last_name ?></th>
            <th class="text-center"><?php echo $user_username ?></th>
            <th class="text-center"><?php echo $user_email ?></th>
            <th class="text-center"><?php echo $user_role ?></th>
            <th class="text-center"><?php echo $user_created_date ?></th>
            <th class="text-center"><img width="100" src="../images/<?php echo $user_image ?>"></th>
            <td><a href="users.php?s=edit_user&id=<?php echo $user_id ?>" >Edit</a></td>
            <td><a href="users.php?delete=<?php echo $user_id ?>" >Remove</a></td>

        </tr>
        <?php }
        }
        ?>

        <?php
        if(isset($_GET['delete'])) {
            $delete_id = $_GET['delete'];
            remove_user($delete_id);
        }
        if(isset($_GET['approve'])) {
            $id = $_GET['approve'];
            approve_comment($id);
            
        }if(isset($_GET['unapprove'])) {
            $id = $_GET['unapprove'];
            unapprove_comment($id);
        }

        ?>
    </tbody>
</table>