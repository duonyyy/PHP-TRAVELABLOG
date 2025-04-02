<?php
$blogcategories = new blogcategories($db);
$blogs = new blogs($db);

/*Delete blog post*/
if(!empty($_GET['id'])){
    $blogs->id = $_GET['id'];
    $blogs->read();

    /*Delete image*/
    if($blogs->image){
        deleteImage($blogs->image,"../images/blogs/");
    }
    /*Delete blog*/
    if($blogs->delete()){
        $message = "Deleted successfully!";
    }
}

if($_SESSION['user_role']==0){
    /*Read all blog posts by id_user*/
    $blogs->id_user = $_SESSION['user_id'];
    $stmt_categories = $blogs->readUserId();
}else{
    /*Read all blog posts*/
    $stmt_categories = $blogs->readAll();
}
?>


    <div class="container-fluid px-4">
        <h1 class="mt-4">Blogs</h1>
       

        <?php if (!empty($message)): ?>
            <div class="alert alert-<?php echo ($message == "Deleted successfully!") ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
               
            </div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-header">
                <a class="btn btn-primary btn-sm" href="index.php?page=blogs_add">Add</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th style="width: 50px; text-align: center;">Id</th>
                                <th style="text-align: center;">Image</th>
                                <th style="text-align: center;width: 150px;">Blog Category</th>
                                <th style="text-align: center;">Title</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Created Date</th>
                                <th style="text-align: center;width: 200px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($rows = $stmt_categories->fetch()): ?>
                            <tr class="odd gradeX">
                                <td style="text-align: center;"><?php echo $rows['id'] ?></td>
                                <td style="text-align: center;">
                                    <img src="<?php echo "../images/blogs/" . $rows['image'] ?>" alt="" style="width: 80px;">
                                </td>
                                <td style="text-align: center;">
                                    <?php 
                                        $blogcategories->id = $rows['id_category']; 
                                        $blogcategories->read();
                                        echo htmlspecialchars($blogcategories->title);
                                    ?>
                                </td>
                                <td><?php echo htmlspecialchars($rows['title']) ?></td>
                                <td style="text-align: center;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="status<?php echo $rows['id'] ?>" <?php echo $rows['status'] ? "checked" : "" ?>>
                                        <label class="custom-control-label" for="status<?php echo $rows['id'] ?>"></label>
                                    </div>
                                </td>
                                <td class="center" style="text-align: center;"><?php echo $rows['created_at'] ?></td>
                                <td class="center" style="text-align: center;">
                                    <a href="index.php?page=blogs_edit&id=<?php echo $rows['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="index.php?page=blogs&id=<?php echo $rows['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>

   
