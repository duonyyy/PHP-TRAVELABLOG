
<?php
$categories = new blogcategories($db);
$categories->id = $_GET['cate'];
$categories->read();

$blogs = new blogs($db);
$blogs->id_category = $_GET['cate'];
$page_start = isset($_GET['pg']) ? $_GET['pg'] : 0;
$blogs->page_start = (8 * $page_start);
$blogs->page_record = 8;

$num_blogs = $blogs->showAllCategories()->rowCount();
$num_pages = ceil($num_blogs / 8);

$stmt_blogs = $blogs->showAllCategories();

$users = new users($db);
?>



<div class="container-fluid blog py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Our Blog</h5>
            <h1 class="mb-4">Popular Travel Blogs</h1>
            <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti deserunt tenetur sapiente atque. Magni non explicabo beatae sit, vel reiciendis consectetur numquam id similique sunt error obcaecati ducimus officia maiores.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <?php if ($stmt_blogs): ?>
                <?php while ($rows = $stmt_blogs->fetch()): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-item">
                        <div class="blog-img">
                            <div class="blog-img-inner">
                                <img class="img-fluid w-100 rounded-top fixed-size-img " src="images/blogs/<?php echo htmlspecialchars($rows['image']); ?>" alt="Image">
                                <div class="blog-icon">
                                    <a href="details.php?id=<?php echo htmlspecialchars($rows['id']); ?>" class="my-auto"><i class="fas fa-link fa-2x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content border border-top-0 rounded-bottom p-4">
                            <a href="blog-details.php?id=<?php echo htmlspecialchars($rows['id']); ?>" class="h4"><?php echo htmlspecialchars($rows['title']); ?></a>
                            <p class="my-3"><?php echo shortText($rows['content'], 150); ?></p>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No blogs found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($page_start > 0): ?>
                    <li class="page-item">
                        <a class="page-link" href="?cate=<?php echo htmlspecialchars($_GET['cate']); ?>&pg=<?php echo $page_start - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="page-item disabled">
                        <span class="page-link" aria-hidden="true">&laquo;</span>
                    </li>
                <?php endif; ?>
                
                <?php for ($i = 0; $i < $num_pages; $i++): ?>
                    <li class="page-item <?php echo ($i == $page_start) ? 'active' : ''; ?>">
                        <a class="page-link" href="?cate=<?php echo htmlspecialchars($_GET['cate']); ?>&pg=<?php echo $i; ?>"><?php echo $i + 1; ?></a>
                    </li>
                <?php endfor; ?>
                
                <?php if ($page_start < $num_pages - 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?cate=<?php echo htmlspecialchars($_GET['cate']); ?>&pg=<?php echo $page_start + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="page-item disabled">
                        <span class="page-link" aria-hidden="true">&raquo;</span>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>
<style type="text/css">
    .fixed-size-img {
    width: 100%;
    height: 300px; /* Set your desired height */
    object-fit: cover; /* This ensures the image covers the container while maintaining aspect ratio */
}

</style>