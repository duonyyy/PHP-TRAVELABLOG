<?php  
$subscribers = new subscribers($db);

/*Delete subscriber*/
if (!empty($_GET['id'])) {
    $subscribers->id = $_GET['id'];
    if ($subscribers->delete()) {
        $message = "Deleted successfully!";
    } else {
        $message = "Failed to delete the subscriber.";
    }
}

/*Read all subscribers*/
$stmt_categories = $subscribers->readAll();
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Subscribers</h1>
   

    <?php if (!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $message ?>
           
        </div>
    <?php endif; ?>
   
    <div class="card mb-4">
        <div class="card-header">
            <a class="btn btn-primary btn-sm" href="index.php?page=subscribers_add">Send Email to All Subscribers</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Email</th>
                            <th>Verified Token</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Created Date</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($rows = $stmt_categories->fetch()): ?>
                            <tr>
                                <td><?php echo $rows['id'] ?></td>
                                <td><?php echo $rows['email'] ?></td>
                                <td><?php echo $rows['verified_token'] ?></td>
                                <td style="text-align: center;">
                                    <div class="form-check">
                                        <label>
                                            <input type="checkbox" <?php echo $rows['status']?"checked":"" ?>>
                                        </label>
                                    </div>
                                </td>
                                <td style="text-align: center;"><?php echo $rows['created_at'] ?></td>
                                <td style="text-align: center;">
                                    <a href="index.php?page=subscribers&id=<?php echo $rows['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>