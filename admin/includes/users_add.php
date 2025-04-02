<?php  
$users = new users($db);

if($_SERVER['REQUEST_METHOD']=='POST'){
    $users->name = $_POST['name'];
    $users->username = $_POST['username'];
    $users->password = sha1($_POST['password']);
    $users->phone = $_POST['phone'];
    $users->email = $_POST['email'];
    $users->role = $_POST['role'];
    $users->status = 1;
    $users->email_verified = "verified";

    if(!empty($_FILES['image']['name'])){
        $upload_file_name = uploadImage($_FILES['image'],"../images/users/");
        $users->image = $upload_file_name;
    }

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $users->created_at = date("Y-m-d h:i:s",time());
    $users->updated_at = date("Y-m-d h:i:s",time());

    if($users->create()){
        $message = "New user added successfully!";
    }
}

?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Add New User</h1>
   

    <?php if(!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="index.php?page=users_add" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                     <select name="role" class="form-control">
                        <option value="0">User</option>
                        <option value="1">Mod</option>
                        <option value="2">Admin</option>
                    </select>   
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image"> 
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
