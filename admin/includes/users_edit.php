<?php  
$users = new users($db);

if($_GET['id']){
    $users->id = $_GET['id'];
    $users->read();
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $users->name = $_POST['name'];
    $users->username = $_POST['username'];
    $users->password = sha1($_POST['password']);
    $users->phone = $_POST['phone'];
    $users->email = $_POST['email'];
    $users->role = $_POST['role'];
    $users->status = $_POST['status']=="on"?1:0;
    $users->email_verified = "verified";

    if(!empty($_FILES['image']['name'])){
        if($users->image){
            $upload_file_name = updateImage($_FILES['image'],$users->image,"../images/users/");
        }else{
            $upload_file_name = uploadImage($_FILES['image'],"../images/users/");
        }
        $users->image = $upload_file_name;
    }

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $users->updated_at = date("Y-m-d h:i:s",time());

    if($users->update()){
        $message = "User updated successfully!";
    }
}

?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit User</h1>
    

    <?php if(!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="index.php?page=users_edit&id=<?php echo $users->id; ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $users->id; ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $users->name; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $users->username; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $users->phone; ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $users->email; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" class="form-control">
                        <option value="0" <?php echo $users->role == 0 ? "selected" : ""; ?>>User</option>
                        <option value="1" <?php echo $users->role == 1 ? "selected" : ""; ?>>Mod</option>
                        <option value="2" <?php echo $users->role == 2 ? "selected" : ""; ?>>Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Current Image</label><br>
                    <?php if($users->image): ?>
                        <img src="../images/users/<?php echo $users->image; ?>" width="100" alt="Current Image"><br><br>
                    <?php endif; ?>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="checkbox" id="status" name="status" <?php echo $users->status == 1 ? "checked" : ""; ?>>
                    <label for="status" class="form-check-label">Active</label>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
