<?php  
$socials = new socials($db);

if($_GET['id']){
    $socials->id = $_GET['id'];
    $socials->read();
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $socials->title = $_POST['title'];
    $socials->icon = $_POST['icon'];
    $socials->url = $_POST['url'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $socials->updated_at = date("Y-m-d h:i:s",time());

    if($socials->update()){
        $message = "Social link updated successfully!";
    }
}

?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Social Link</h1>
   

    <?php if(!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="index.php?page=socials_edit&id=<?php echo $_GET['id'] ?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $socials->title ?>">
                </div>
                <div class="mb-3">
                    <label for="icon" class="form-label">Icon</label>
                    <input type="text" class="form-control" id="icon" name="icon" value="<?php echo htmlspecialchars($socials->icon) ?>">
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">URL</label>
                   <input class="form-control" name="url" value="<?php echo $socials->url ?>">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
