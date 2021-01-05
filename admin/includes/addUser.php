<?php 
if(isset($_POST['new_user'])) {
    $user['first_name'] = $_POST['first_name'];
    $user['last_name'] = $_POST['last_name'];
    $user['email'] = $_POST['email'];
    $user['username'] = $_POST['username'];
    $user['password'] = $_POST['password'];
    $user_image = $_FILES['image']['name'];
    $user['image'] = $user_image;
    $user_image_temp = $_FILES['image']['tmp_name'];
    $user['role'] = $_POST['role'];
    
    move_uploaded_file($user_image_temp, "../images/$user_image");
   
    add_user($user);
    
}

?>
<h1 class="page-header">Add User</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" name="first_name">
    </div>
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" name="last_name">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
        <label for="role">role</label>
        <input type="text" class="form-control" name="role">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="new_user" value="Add User">
    </div>
</form>