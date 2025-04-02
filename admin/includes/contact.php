<?php  
$contact = new contact($db);

if($_SERVER['REQUEST_METHOD']=='POST'){
    $contact->content = $_POST['content'];
    
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $contact->created_at = date("Y-m-d h:i:s",time());
    $contact->updated_at = date("Y-m-d h:i:s",time());

    if($contact->readAll()->rowCount()>0){
        $contact->id = 1;
        $contact->update();
    }else{
        $contact->create();
    }
    $message = "Contact page updated successfully!";
}
$contact->id = 1;
$contact->read();
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Contact Page</h1>

    <?php if(!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body">
            <form role="form" method="POST" action="index.php?page=contact">
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="6"><?php echo htmlspecialchars($contact->content); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
