<?php  
$blogcategories = new blogcategories($db);

/*Delete blog category*/
if(!empty($_GET['id'])){
    $blogcategories->id = $_GET['id'];
    if($blogcategories->delete()){
        $message = "Deleted successfully!";
    }
}

/*Read all blog categories*/
$stmt_blogcategories = $blogcategories->readAll();
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Blogs Categories</h1>
    
     <?php if (!empty($message)): ?>
            <div class="alert alert-<?php echo ($message == "Deleted successfully!") ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                
            </div>
        <?php endif; ?>
    <div class="card mb-4">
        <div class="card-header">
            <div class="panel-heading">
                <a href="index.php?page=blogcategories_add" class="btn btn-primary btn-sm">Create</a>
            </div>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Created</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rows = $stmt_blogcategories->fetch()) { ?>
                        <tr>
                            <td class="text-center"><?php echo $rows['id']; ?></td>
                            <td class="text-center"><?php echo $rows['title']; ?></td>
                            <td style="text-align: center;">
                                    <div class="form-check">
                                        <label>
                                            <input type="checkbox" <?php echo $rows['status']?"checked":"" ?>>
                                        </label>
                                    </div>
                                </td>
                            <td class="text-center"><?php echo $rows['created_at']; ?></td>
                            <td class="text-center">
                                <a href="index.php?page=blogcategories_edit&id=<?php echo $rows['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?page=blogcategories&id=<?php echo $rows['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
