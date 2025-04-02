<?php  
$links = new links($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $links->title = $_POST['title'];
    $links->url = $_POST['url'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $links->created_at = date("Y-m-d H:i:s");
    $links->updated_at = date("Y-m-d H:i:s");

    if ($links->create()) {
        $message = "New link menu added successfully!";
    }
}
?>
<div class="container-fluid px-4">
     <h1 class="mt-4">Links Menu</h1>
   

    <?php if (!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
            
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body">
            <form role="form" method="POST" action="index.php?page=links_add">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">URL</label>
                    <input type="url" class="form-control" id="url" name="url" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
