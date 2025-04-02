<?php  
$sliders = new sliders($db);

/*Delete slider*/
if(!empty($_GET['id'])){
    $sliders->id = $_GET['id'];
    $sliders->read();

    if($sliders->image){
        deleteImage($sliders->image,"../images/sliders/");
    }

    if($sliders->delete()){
        $message = "Deleted successfully!";
    }
}

/*Read all sliders*/
$stmt_sliders = $sliders->readAll();
?>

    <div class="container-fluid px-4">
        <h1 class="mt-4">Sliders</h1>
       

        <?php if(!empty($message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-header">
                <div class="panel-heading">
                    <a href="index.php?page=sliders_add" class="btn btn-primary btn-sm">Create</a>
                </div>
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Created Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($rows = $stmt_sliders->fetch()): ?>
                            <tr>
                                <td class="text-center"><?php echo $rows['id']; ?></td>
                                <td class="text-center">
                                    <img src="<?php echo "../images/sliders/".$rows['image'] ?>" width="80px" alt="">
                                </td>
                                <td class="text-center"><?php echo $rows['title']; ?></td>
                                <td class="text-center"><?php echo $rows['created_at']; ?></td>
                                <td class="text-center">
                                    <a href="index.php?page=sliders_edit&id=<?php echo $rows['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="index.php?page=sliders&id=<?php echo $rows['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

