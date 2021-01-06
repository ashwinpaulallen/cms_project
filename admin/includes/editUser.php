'<?php 
if(isset($_GET['id'])) {

    $user_id = $_GET['id'];

    $result = get_user_by_id($user_id);

    $row = mysqli_fetch_assoc($result);


?>
<h1 class="page-header">Edit User</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="id">User ID</label>
        <input type="text" class="form-control" value="<?php echo $row['user_id']?>"name="id" readonly>
    </div>
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" value="<?php echo $row['username']?>"name="username">
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
                
    <div class="form-inline">
        <label for="status">Role</label>
        <input type="text" class="form-control" value="<?php echo $row['role'] ?>" readonly>
        <label for="new status"> Change Role to</label>
        <select name="role" class="custom-select" id="inputGroupSelect01">
          <option value="user">Choose Role</option>  
          <option value="admin">Admin</option>  
          <option value="user">Subscriber</option>  
        </select>
    </div>
    
    <div class="form-group">
       <label for="image">Image</label>
        <img width="200" src="../images/<?php echo $row['image']?>">        
    </div>
    <div class="form-group">
        <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
    </div>
</form>


<?php } ?> 

<?php 
    if(isset($_POST['edit_user'])) {
        $user['user_id'] = $_POST['id'];
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
        
        update_user($user);
        
    }

?>   