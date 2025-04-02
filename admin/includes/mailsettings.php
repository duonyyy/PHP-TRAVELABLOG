<?php  
$mailsettings = new mailsettings($db);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $mailsettings->email = $_POST['email'];
    $mailsettings->mail_server = $_POST['mail_server'];
    $mailsettings->mail_username = $_POST['mail_username'];
    $mailsettings->mail_password = $_POST['mail_password'];
    $mailsettings->mail_port = $_POST['mail_port'];
    
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $mailsettings->created_at = date("Y-m-d H:i:s", time());
    $mailsettings->updated_at = date("Y-m-d H:i:s", time());

    if($mailsettings->readAll()->rowCount() > 0){
        $mailsettings->id = 1;        
        $mailsettings->update();
    } else {
        $mailsettings->create();
    }
    $message = "Mail settings page updated successfully!";
}
$mailsettings->id = 1;
$mailsettings->read();
?>
<div class="container-fluid">
    <h1 class="mt-4">Mail Settings Page</h1>
    <?php if(!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
            
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="index.php?page=mailsettings">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" id="email" value="<?php echo $mailsettings->email ?>">
                        </div>
                        <div class="mb-3">
                            <label for="mail_server" class="form-label">Mail Server</label>
                            <input type="text" name="mail_server" class="form-control" id="mail_server" value="<?php echo $mailsettings->mail_server ?>">
                        </div>
                        <div class="mb-3">
                            <label for="mail_username" class="form-label">Mail Username</label>
                            <input type="text" name="mail_username" class="form-control" id="mail_username" value="<?php echo $mailsettings->mail_username ?>">
                        </div>
                        <div class="mb-3">
                            <label for="mail_password" class="form-label">Mail Password</label>
                            <input type="password" name="mail_password" class="form-control" id="mail_password" value="<?php echo $mailsettings->mail_password ?>">
                        </div>
                        <div class="mb-3">
                            <label for="mail_port" class="form-label">Mail Port</label>
                            <input type="text" name="mail_port" class="form-control" id="mail_port" value="<?php echo $mailsettings->mail_port ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
