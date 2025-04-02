<?php  
$settings = new settings($db);

if($_SERVER['REQUEST_METHOD']=='POST'){    

    if($settings->readAll()->rowCount()>0){
        $settings->id = 1;
        $settings->read();
        if(!empty($_FILES['site_logo']['name'])){
            $settings->site_logo = updateImage($_FILES['site_logo'],$settings->site_logo,"../images/");
        }
        if(!empty($_FILES['site_favicon']['name'])){
            $settings->site_favicon = updateImage($_FILES['site_favicon'],$settings->site_favicon,"../images/");
        }
        $settings->site_name = $_POST['site_name'];
        $settings->site_timezone = $_POST['site_timezone'];
        $settings->site_map = $_POST['site_map'];
        $settings->site_footer = $_POST['site_footer'];
        $settings->contact_email = $_POST['contact_email'];
        $settings->contact_phone = $_POST['contact_phone'];
        $settings->contact_address = $_POST['contact_address'];
        
        if($_POST['site_timezone']){
            date_default_timezone_set($_POST['site_timezone']);
        }
        $settings->created_at = date("Y-m-d h:i:s",time());
        $settings->updated_at = date("Y-m-d h:i:s",time());
            $settings->update();
    }else{
        if(!empty($_FILES['site_logo']['name'])){
            $settings->site_logo = uploadImage($_FILES['site_logo'],"../images/");
        }
        if(!empty($_FILES['site_favicon']['name'])){
            $settings->site_favicon = uploadImage($_FILES['site_favicon'],"../images/");
        }
        $settings->site_name = $_POST['site_name'];
        $settings->site_timezone = $_POST['site_timezone'];
        $settings->site_map = $_POST['site_map'];
        $settings->site_footer = $_POST['site_footer'];
        $settings->contact_email = $_POST['contact_email'];
        $settings->contact_phone = $_POST['contact_phone'];
        $settings->contact_address = $_POST['contact_address'];
        
        if($_POST['site_timezone']){
            date_default_timezone_set($_POST['site_timezone']);
        }
        $settings->created_at = date("Y-m-d h:i:s",time());
        $settings->updated_at = date("Y-m-d h:i:s",time());
        $settings->create();
    }
    $message = "Settings page updated successfully!";
}
$settings->id = 1;
$settings->read();
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Settings Page</h1>

    <?php if(!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
           
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body">
            <form role="form" method="POST" action="index.php?page=settings" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="site_name" class="form-label">Site Name</label>
                    <input type="text" class="form-control" id="site_name" name="site_name" value="<?php echo $settings->site_name ?>">
                </div>

                <?php if($settings->site_logo): ?>
                <div class="mb-3">
                    <label>Current Site Logo</label><br>
                    <img src="../images/<?php echo $settings->site_logo; ?>" width="150px" alt="">
                </div>
                <?php endif; ?>
                
                <div class="mb-3">
                    <label for="site_logo" class="form-label">Upload New Site Logo</label>
                    <input type="file" class="form-control" id="site_logo" name="site_logo">
                </div>

                <?php if($settings->site_favicon): ?>
                <div class="mb-3">
                    <label>Current Site Favicon</label><br>
                    <img src="../images/<?php echo $settings->site_favicon; ?>" width="150px" alt="">
                </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="site_favicon" class="form-label">Upload New Site Favicon</label>
                    <input type="file" class="form-control" id="site_favicon" name="site_favicon">
                </div>

                <div class="mb-3">
                    <label for="site_map" class="form-label">Site Map</label>
                    <input type="text" class="form-control" id="site_map" name="site_map" value="<?php echo htmlspecialchars($settings->site_map) ?>">
                </div>

                <div class="mb-3">
                    <label for="site_timezone" class="form-label">Site Timezone</label>
                    <select class="form-control" id="site_timezone" name="site_timezone">
                        <option value="">Select Timezone</option>
                        <?php foreach(setTimezone() as $key => $value): ?>
                        <option value="<?php echo $key ?>" <?php echo ($key == $settings->site_timezone) ? 'selected' : '' ?>><?php echo $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="site_footer" class="form-label">Site Footer</label>
                    <input type="text" class="form-control" id="site_footer" name="site_footer" value="<?php echo $settings->site_footer ?>">
                </div>

                <div class="mb-3">
                    <label for="contact_email" class="form-label">Contact Email</label>
                    <input type="text" class="form-control" id="contact_email" name="contact_email" value="<?php echo $settings->contact_email ?>">
                </div>

                <div class="mb-3">
                    <label for="contact_phone" class="form-label">Contact Phone</label>
                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="<?php echo $settings->contact_phone ?>">
                </div>

                <div class="mb-3">
                    <label for="contact_address" class="form-label">Contact Address</label>
                    <input type="text" class="form-control" id="contact_address" name="contact_address" value="<?php echo $settings->contact_address ?>">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
