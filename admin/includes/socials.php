<?php  
$socials = new socials($db);

/*Delete social link*/
if(!empty($_GET['id'])){
    $socials->id = $_GET['id'];
    if($socials->delete()){
        $message = "Deleted successfully!";
    }
}

/*Read all social links*/
$stmt_socials = $socials->readAll();
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Social Links</h1>

    <?php if(!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
           
        </div>
    <?php endif; ?>
   
    <div class="card mb-4">
        <div class="card-header">
            <a class="btn btn-primary btn-sm" href="index.php?page=socials_add">Add New Social Link</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th style="text-align: center;">Icon</th>
                            <th>URL</th>
                            <th style="text-align: center;">Created Date</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($rows = $stmt_socials->fetch()): ?>
                        <tr class="odd gradeX">
                            <td><?php echo $rows['id'] ?></td>
                            <td><?php echo $rows['title'] ?></td>
                            <td style="text-align: center;">
                                <?php echo $rows['icon'] ?>                                        
                            </td>
                            <td>
                                <a href="<?php echo $rows['url'] ?>" target="_blank"><?php echo $rows['url'] ?></a>                                        
                            </td>
                            <td class="center" style="text-align: center;"><?php echo $rows['created_at'] ?></td>
                            <td class="center" style="text-align: center;">
                                <a href="index.php?page=socials_edit&id=<?php echo $rows['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?page=socials&id=<?php echo $rows['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this social link?');">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>