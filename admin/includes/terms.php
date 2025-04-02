<?php  
$terms = new terms($db);

if($_SERVER['REQUEST_METHOD']=='POST'){
    $terms->content = $_POST['content'];
    
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $terms->created_at = date("Y-m-d h:i:s",time());
    $terms->updated_at = date("Y-m-d h:i:s",time());

    if($terms->readAll()->rowCount()>0){
        $terms->id = 1;      
        $terms->update();
    }else{
        $terms->create();
    }
    $message = "Terms page updated successfully!";
}
$terms->id = 1;
$terms->read();
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Terms Page</h1>

    <?php if(!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
            
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body">
            <form role="form" method="POST" action="index.php?page=terms">
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="10"><?php echo htmlspecialchars($terms->content); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
