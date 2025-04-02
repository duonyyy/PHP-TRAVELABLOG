<?php  
$sliders = new sliders($db);

if($_SERVER['REQUEST_METHOD']=='POST'){
    $sliders->title = $_POST['title'];
    $sliders->image = uploadImage($_FILES['image'],"../images/sliders/");
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $sliders->created_at = date("Y-m-d h:i:s",time());
    $sliders->updated_at = date("Y-m-d h:i:s",time());

    if($sliders->create()){
        $message = "New slider added successfully!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Slider</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Add New Slider</h1>
       

        <?php if(!empty($message)): ?>
            <div class="alert alert-<?php echo ($message == "New slider added successfully!") ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-body">
                <form role="form" method="POST" action="index.php?page=sliders_add" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title">Title</label>
                          <input type="text" name="title" class="form-control" id="title" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image" required>
                        <label class="custom-file-label" for="image">Choose file</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
