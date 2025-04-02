<?php  
$users = new users($db);

/*Delete user*/
if(!empty($_GET['id'])){
    $users->id = $_GET['id'];
    $users->read();

    if($users->image){
        deleteImage($users->image,"../images/users/");
    }

    if($users->delete()){
        $message = "Deleted successfully!";
    }
}

/*Read all users*/
$stmt_users = $users->readAll();
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Users</h1>
   

    <?php if(!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header">
            <a class="btn btn-primary btn-sm float-end" href="index.php?page=users_add">Add</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover text-center" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($rows = $stmt_users->fetch()): ?>
                        <tr class="odd gradeX">
                            <td><?php echo $rows['id']; ?></td>
                            <td>
                                <img src="<?php echo "../images/users/".$rows['image']; ?>" width="80px" alt="">
                            </td>
                            <td><?php echo $rows['name']; ?></td>
                            <td><?php echo $rows['username']; ?></td>
                            <td><?php echo userRole($rows['role']); ?></td>
                            <td style="text-align: center;">
                                    <div class="form-check">
                                        <label>
                                            <input type="checkbox" <?php echo $rows['status']?"checked":"" ?>>
                                        </label>
                                    </div>
                                </td>
                            <td><?php echo $rows['created_at']; ?></td>
                            <td>
                                <a href="index.php?page=users_edit&id=<?php echo $rows['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?page=users&id=<?php echo $rows['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
