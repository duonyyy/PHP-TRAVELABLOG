<?php  
$socials = new socials($db);

if($_SERVER['REQUEST_METHOD']=='POST'){
    $socials->title = $_POST['title'];
    $socials->icon = $_POST['icon'];
    $socials->url = $_POST['url'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $socials->created_at = date("Y-m-d h:i:s",time());
    $socials->updated_at = date("Y-m-d h:i:s",time());

    if($socials->create()){
        $message = "New social link added successfully!";
    }
}

?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Add New Social Link</h1>
   

    <?php if(!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="index.php?page=socials_add">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="icon" class="form-label">Icon</label>
                    <input type="text" class="form-control" id="icon" name="icon" required>
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">URL</label>
                    <input type="text" class="form-control" id="url" name="url" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
