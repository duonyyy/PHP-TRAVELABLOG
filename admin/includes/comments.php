<?php  
$comments = new comments($db);

/*Delete comment*/
if(!empty($_GET['id'])){
    $comments->id = $_GET['id'];
    if($comments->delete()){
        $message = "Deleted successfully!";
    }
}

/*Read all comments*/
$stmt_categories = $comments->readAll();
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Comments</h1>
    

    <?php if(!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
   
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover text-center" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Comment</th>
                            <th>Id Parent Comment</th>
                            <th>Id Blog</th>
                            <th>Email</th>
                            <th style="text-align: center;">Created Date</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($rows = $stmt_categories->fetch()): ?>
                        <tr class="odd gradeX">
                            <td><?php echo $rows['id']; ?></td>
                            <td><?php echo $rows['comment']; ?></td>
                            <td><?php echo $rows['id_parent_comment']; ?></td>
                            <td><?php echo $rows['id_blog']; ?></td>
                            <td><?php echo $rows['email']; ?></td>
                            <td class="text-center"><?php echo $rows['created_at']; ?></td>
                            <td class="text-center">
                                <a href="index.php?page=comments&id=<?php echo $rows['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
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
