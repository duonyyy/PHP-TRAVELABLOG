<?php
$blogcategories = new blogcategories($db);
$stmt_category = $blogcategories->readAll();

$blogs = new blogs($db);

if($_GET['id']){
    $blogs->id = $_GET['id'];
    $blogs->read();
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    
    $blogs->id_user = $_SESSION['user_id'];

    $blogs->title = $_POST['title'];
    $blogs->content = $_POST['content'];
    $blogs->id_category = $_POST['id_category'];
    $blogs->status = isset($_POST['status'])=="on"?1:0;

    /*Update image*/
    if(!empty($_FILES['image']['name'])){
        if($blogs->image){
            $upload_file_name = updateImage($_FILES['image'],$blogs->image,'../images/blogs/');
        }else{
            $upload_file_name = uploadImage($_FILES['image'],'../images/blogs/');
        }
        
        $blogs->image = $upload_file_name;
    }

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $blogs->updated_at = date("Y-m-d h:i:s",time());

    if($blogs->update()){
        $message = "Blog post updated successfully!";
    }
}
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Blog Post</h1>
   
    <?php if(!empty($message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body">
            <form role="form" method="POST" action="index.php?page=blogs_edit&id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="id_category" class="form-label">Category</label>
                    <select name="id_category" id="id_category" class="form-control">
                        <?php while($row = $stmt_category->fetch()): ?>
                            <option value="<?php echo $row['id']; ?>" <?php echo ($row['id'] == $blogs->id_category) ? 'selected' : ''; ?>><?php echo $row['title']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($blogs->title); ?>">
                </div>
                <div class="mb-3">
                    <?php if(!empty($blogs->image)): ?>
                        <img src="../images/blogs/<?php echo $blogs->image; ?>" width="200px" alt="Blog Image">
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="status" name="status" <?php echo ($blogs->status == 1) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="status">Status</label>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="6"><?php echo htmlspecialchars($blogs->content); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
