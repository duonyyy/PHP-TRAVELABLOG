<?php 
// Assuming the blogs class and $db connection are already defined somewhere in your code
$blogs = new blogs($db);
$stmt_blogs = $blogs->readAll();

// Function to shorten text
function shortText($text, $length) {
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . '...';
}
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
                                <img class="img-fluid w-100 fixed-size-img" src="images/blogs/<?php echo htmlspecialchars($rows['image']); ?>" alt="Image">
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
<div class="pagination text-center justify-content-center">
    <?php if ($previous_page) { ?>
        <a href="?page=<?php echo $previous_page; ?>" class="btn btn-outline-primary">Previous</a>
    <?php } ?>
    
    <?php for ($i = 1; $i <= $num_pages; $i++) { ?>
        <a style="margin: 0 6px;" href="?page=<?php echo $i; ?>" class="btn <?php echo $i == $current_page ? 'btn-primary' : 'btn-outline-primary'; ?>"><?php echo $i; ?></a>
    <?php } ?>

    <?php if ($next_page) { ?>
        <a href="?page=<?php echo $next_page; ?>" class="btn btn-outline-primary">Next</a>
    <?php } ?>
</div>




<style type="text/css">
    .fixed-size-img {
    width: 100%;
    height: 300px; /* Set your desired height */
    object-fit: cover; /* This ensures the image covers the container while maintaining aspect ratio */
}

</style>

