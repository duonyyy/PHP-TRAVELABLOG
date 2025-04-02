<?php
include "admin/database/database.php";
include "admin/database/blogcategories.php";
include "admin/database/blogs.php";
include "admin/database/settings.php";
include "admin/database/sliders.php";
include "admin/database/socials.php";
include "admin/database/about.php";
include "admin/database/links.php";
include "admin/database/subscribers.php";
include "admin/database/users.php";
//include "admin/helper/help_function.php";

$database = new database();
$db = $database->connect();

$settings = new settings($db);
$settings->id = 1;
$settings->read();

$blogcategories = new blogcategories($db);
$stmt_blogcategories = $blogcategories->readAll();

$socials = new socials($db);
$stmt_socials = $socials->readAll();

$links = new links($db);
$stmt_links = $links->readAll();

$about = new about($db);
$about->id = 1;
$about->read();

$blogs = new blogs($db);
$stmt_blogs = $blogs->readAll();
$all_blogs = $stmt_blogs->fetchAll() ?: []; // Khởi tạo giá trị mặc định là mảng rỗng nếu fetchAll trả về null

$total_blogs = count($all_blogs);
$blogs_per_page = 6;
$num_pages = ceil($total_blogs / $blogs_per_page);

$users = new users($db);

/* verify code */
if (!empty($_GET['verify'])) {
    $subscribers = new subscribers($db);
    $subscribers->verified_token = $_GET['verify'];
    $stmt_subscribers = $subscribers->checkRequestVerified();
    
    /* Verification matched */
    if ($stmt_subscribers->rowCount() > 0) {
        $row = $stmt_subscribers->fetch();
        $subscribers->status = 1;
        $subscribers->verified_token = "verified";
        $subscribers->email = $row['email'];
        $subscribers->updated_at = date("Y-m-d h:i:s", time());
        $subscribers->id = $row['id'];
        $subscribers->update();
    }
}

$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_index = ($current_page - 1) * $blogs_per_page;
$current_blogs = array_slice($all_blogs, $start_index, $blogs_per_page);

// Functions to get next and previous pages
function nextPage($current_page, $num_pages) {
    return $current_page < $num_pages ? $current_page + 1 : false;
}

function previousPage($current_page, $num_pages) {
    return $current_page > 1 ? $current_page - 1 : false;
}

// Get next and previous page numbers
$next_page = nextPage($current_page, $num_pages);
$previous_page = previousPage($current_page, $num_pages);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($settings->site_name); ?></title>
    <link rel="icon" href="<?php echo "./images/" . htmlspecialchars($settings->site_favicon); ?>">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <?php include "includes/header_top.php"; ?>
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <?php include "includes/header.php"; ?>
        <!-- Carousel Start -->
        <?php include "includes/slider.php"; ?>
        <!-- Carousel End -->
    </div>
    <!-- Navbar & Hero End -->

    <!-- About Start -->
    <?php include "includes/about.php"; ?>
    <!-- About End -->

    <!-- Destination Start -->
    <?php include "includes/desimg.php"; ?>
    <!-- Destination End -->

    <?php include "includes/content.php"; ?>
    <?php include "includes/comment.php"; ?>

    <!-- Subscribe Start -->
    <?php include "includes/subscriber.php"; ?>
    <!-- Subscribe End -->

    <!-- Footer Start -->
    <?php include "includes/footer.php"; ?>
    <!-- Footer End -->

    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>   

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>
