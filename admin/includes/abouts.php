<?php
$about = new about($db);
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $about->content = $_POST['content'];
    $about->footer = $_POST['footer'];

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $current_time = date("Y-m-d H:i:s");

    $about->created_at = $current_time;
    $about->updated_at = $current_time;

    if ($about->readAll()->rowCount() > 0) {
        $about->id = 1;
        $about->update();
    } else {
        $about->create();
    }
    $message = "About page updated successfully!";
}

$about->id = 1;
$about->read();
?>
<div class="container-fluid px-4">
    <h1 class="mt-4 text-primary">About Page</h1>

    <?php if (!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
           
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body">
            <form role="form" method="POST" action="index.php?page=about">
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="6"><?php echo htmlspecialchars($about->content); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="footer" class="form-label">Footer</label>
                    <textarea class="form-control" id="footer" name="footer" rows="3"><?php echo htmlspecialchars($about->footer); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
