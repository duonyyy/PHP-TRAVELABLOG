<?php  
$blogcategories = new blogcategories($db);

if($_SERVER['REQUEST_METHOD']=='POST'){
    $blogcategories->title = $_POST['title'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $blogcategories->created_at = date("Y-m-d h:i:s",time());
    $blogcategories->updated_at = date("Y-m-d h:i:s",time());

    if($blogcategories->create()){
        $message = "New blog category added successfully!";
    }
}

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Create Blog Category</h1>
    

    <?php if(!empty($message)): ?>
        <div class="alert alert-<?php echo isset($message) ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body">
            <form role="form" method="POST" action="index.php?page=blogcategories_add">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
