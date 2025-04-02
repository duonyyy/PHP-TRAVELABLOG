<?php  
$links = new links($db);

/* Delete link menu */
if (!empty($_GET['id'])) {
    $links->id = $_GET['id'];
    if ($links->delete()) {
        $message = "Deleted successfully!";
    }
}

/* Read all links menu */
$stmt_links = $links->readAll();
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Links Menu</h1>
   
    <?php if (!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header">
            <a class="btn btn-primary btn-sm" href="index.php?page=links_add">Add</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>URL</th>
                            <th style="text-align: center;">Created Date</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $stmt_links->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']) ?></td>
                                <td><?php echo htmlspecialchars($row['title']) ?></td>
                                <td><?php echo htmlspecialchars($row['url']) ?></td>
                                <td style="text-align: center;"><?php echo htmlspecialchars($row['created_at']) ?></td>
                                <td style="text-align: center;">
                                    <a href="index.php?page=links_edit&id=<?php echo $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="index.php?page=links&id=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

