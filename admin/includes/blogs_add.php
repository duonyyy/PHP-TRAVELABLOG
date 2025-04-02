<?php
$blogcategories = new blogcategories($db);
$stmt_category = $blogcategories->readAll();

$blogs = new blogs($db);

if($_SERVER['REQUEST_METHOD']=='POST'){
    
    $blogs->id_user = $_SESSION['user_id'];

    $blogs->title = $_POST['title'];
    $blogs->content = $_POST['content'];
    $blogs->id_category = $_POST['id_category'];
    
    /*Upload image*/
    if(!empty($_FILES['image']['name'])){
        $upload_file_name = uploadImage($_FILES['image'],'../images/blogs/');
        $blogs->image = $upload_file_name;
    }

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $blogs->created_at = date("Y-m-d h:i:s",time());
    $blogs->updated_at = date("Y-m-d h:i:s",time());

    if($blogs->create()){
        $message = "New blog post added successfully!";
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Add New Blog Post</h1>
   

    <?php if (!empty($message)): ?>
        <div class="alert alert-<?php echo isset($message) ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body">
            <form role="form" method="POST" action="index.php?page=blogs_add" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" id="blogTitle" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Select Category</label>
                    <select name="id_category" id="blogCategory" class="form-control">
                        <?php while ($rows = $stmt_category->fetch()): ?>
                            <option value="<?php echo $rows['id']; ?>"><?php echo $rows['title']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Image</label>
                    <input type="file" name="image" id="blogImage" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea id="blogContent" name="content" class="form-control" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#blogContent').summernote({
            placeholder: 'Input content',
            tabsize: 2,
            height: 200
        });
    });
</script>
