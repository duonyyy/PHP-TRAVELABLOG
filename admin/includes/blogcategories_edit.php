<?php  
$blogcategories = new blogcategories($db);

if($_GET['id']){
    $blogcategories->id = $_GET['id'];
    $blogcategories->read();

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $blogcategories->title = $_POST['title'];
    $blogcategories->status = isset($_POST['status'])=='on'?1:0;
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $blogcategories->updated_at = date("Y-m-d h:i:s",time());

    if($blogcategories->update()){
        $message = "Blog category updated successfully!";
    }
}

?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Blog Category</h1>
   

    <div class="row">
        <div class="col-md-12">
            <?php if(!empty($message)): ?>
                <div class="alert alert-<?php echo isset($message) ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            
            <div class="card mb-4">
                <div class="card-body">
                    <form role="form" method="POST" action="index.php?page=blogcategories_edit&id=<?php echo $_GET['id']; ?>">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" id="title" value="<?php echo htmlspecialchars($blogcategories->title); ?>">
                        </div>
                        
                        <div class="mb-3 form-check">
                             <label for="">Status</label>
                                            <input type="checkbox" name="status" <?php echo $blogcategories->status == 1?"checked":"" ?>>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
