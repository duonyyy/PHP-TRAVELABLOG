<?php
include "admin/database/database.php";
include "admin/database/settings.php";
include "admin/database/contact.php";
include "admin/database/blogcategories.php";
include "admin/database/sliders.php";
include "admin/database/links.php";
include "admin/database/socials.php";
include "admin/database/about.php";
include "admin/database/blogs.php";
include "admin/database/comments.php";
include "admin/helper/help_function.php";
include "admin/database/users.php";

$database = new database();
$db = $database->connect();

$blogs = new blogs($db);
$stmt_blogs = $blogs->readAll();

$links = new links($db);
$stmt_links = $links->readAll();

$blogcategories = new blogcategories($db);
$stmt_blogcategories = $blogcategories->readAll();

$settings = new settings($db);
$settings->id = 1;
$settings->read();

$socials = new socials($db);
$stmt_socials = $socials->readAll();

$about = new about($db);
$about->id = 1;
$about->read();

$contact = new contact($db);
$contact->id = 1;
$contact->read();

if (isset($_GET['id'])) {
    $blogs->id = $_GET['id'];
    $blogs->read();

    if ($blogs->title != null) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $comment = new comments($db);
            $comment->id_parent_comment = $_POST['id_parent_comment'] == '0' ? NULL : $_POST['id_parent_comment'];
            $comment->comment = $_POST['comment'];
            $comment->id_blog = $_POST['id_blog'];
            $comment->name = $_POST['name'];
            $comment->email = $_POST['email'];
            $comment->created_at = date('Y-m-d H:i:s');
            $comment->updated_at = date('Y-m-d H:i:s');
            if ($comment->create()) {
                $message = "Comment added successfully.";
            } else {
                echo "Failed to add comment.";
            }
        }

        $next_blog = $blogs->getNextBlogByUser($blogs->id, $blogs->id_user);
        $previous_blog = $blogs->getPreviousBlogByUser($blogs->id, $blogs->id_user);
        
        $users = new users($db);
        $users->id = $blogs->id_user;
        $users->read();
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo $settings->site_name ?></title>
<link rel="icon" href="<?php echo "./images/".$settings->site_favicon ?>"  type="image/png">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/fontAwesome.css">
<link rel="stylesheet" href="css/hero-slider.css">
<link rel="stylesheet" href="css/owl-carousel.css">
<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
 <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<style>
/* Custom styles specific to this page */
.blog-title {
    font-size: 2.5rem;
    margin-top: 20px;
}
.blog-image.img {
    margin-top: 20px;
    border-radius: 8px;
    text-align: center;
}
.blog-content {
    margin-top: 20px;
}
.blog-date, .blog-author {
    margin-top: 10px;
}
.nav-buttons {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
}
.comment {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    background-color: #f0f2f5;
    border-radius: 24px;
    padding: 14px;
}
.comment-content {
    flex: 1;
}
.reply-button {
    margin-left: 10px;
    padding: 8px 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
.reply-button:hover {
    background-color: #0056b3;
}
.form-group {
    margin-bottom: 15px;
}
.form-group label {
    font-weight: bold;
}
.btn-submit {
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    cursor: pointer;
}
.btn-submit:hover {
    background-color: #218838;
}
.s-footer__subscribe {
    background-color: #f8f9fa;
    padding: 30px;
    border: 1px solid #dee2e6;
}
.s-footer__subscribe h2 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

.s-footer__subscribe p {
    color: #666;
    font-size: 14px;
    line-height: 1.6;
}
.subscribe-form {
    margin-top: 20px;
}
.subscribe-form input[type="email"] {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 10px;
}
.subscribe-form input[type="button"] {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
.subscribe-form input[type="button"]:hover {
    background-color: #0056b3;
}
.subscribe-message {
    display: block;
    margin-top: 10px;
    color: #555;
}
.page-header{
    padding-top:100px;
    width: 100%;
}
.sub-footer{
    text-align: center;
    padding: 24px;
}


/* new css */


@media (max-width: 768px) {
    .comment {
        flex-direction: column;
        align-items: flex-start;
    }
    .comment-content {
        margin-top: 10px;
    }
    .reply-button {
        margin-top: 10px;
    }
}   
</style>
</head>
<body>
      <?php
       include "includes/header_top.php";

       include "includes/headers.php"; 
       ?>   
<div id="wrapper">
   

    <div class="container">
        <!-- Blog Post Title -->
        <h1 class="blog-title text-center"><?php echo htmlspecialchars($blogs->title); ?></h1>
        
        <!-- Blog Post Image -->
        <div class="text-center">
            <img src="./images/blogs/<?php echo htmlspecialchars($blogs->image); ?>" class="blog-image img-fluid" alt="<?php echo htmlspecialchars($blogs->title); ?>">
        </div>

        <!-- Blog Post Content -->
        <div class="blog-content">
            <?php echo $blogs->content; ?>
        </div>

        <!-- Blog Post Meta Information -->
        <p class="blog-date">Ngày đăng: <?php echo htmlspecialchars($blogs->created_at); ?></p>
        <p class="blog-author">Người đăng: <?php echo $users->name; ?></p>
    </div>

    <!-- Navigation Buttons (Next and Previous Blog Posts) -->
    <div class="nav-buttons container mt-4 text-center">

        <?php if ($previous_blog) { ?>
            <a href="details.php?id=<?php echo htmlspecialchars($previous_blog['id']); ?>" class="btn btn-secondary"> <b>Previous</b> </a>
        <?php } ?>
        <?php if ($next_blog) { ?>
            <a href="details.php?id=<?php echo htmlspecialchars($next_blog['id']); ?>" class="btn btn-secondary"> <b>Next</b> </a>
        <?php } ?>
    </div>

    <!-- Comments Section -->
    <div class="container mt-5">
        <h2>Bình luận</h2>
        <?php
        $comments = new comments($db);
        $comments->id_blog = $_GET['id'];
        $stmt_comments = $comments->readCommentByBlogId();
        $all_comments = $stmt_comments->fetchAll(PDO::FETCH_ASSOC);

        if ($stmt_comments->rowCount() > 0) { 
            function display_comments($comments, $parent_id = 0, $level = 0) {
                $counter = 1;
                foreach ($comments as $comment) {
                    if ($comment['id_parent_comment'] == $parent_id) {
                        echo '<div class="comment" style="margin-left: ' . ($level * 40) . 'px;">';
                        echo '<div class="comment-content">';
                        echo '<p><strong>' . htmlspecialchars($comment['name']) . '</strong> - ' . htmlspecialchars($comment['created_at']) . '</p>';
                        echo '<p>' . htmlspecialchars($comment['comment']) . '</p>';
                        echo '</div>';
                        echo '<button class="reply-button" data-id="' . $comment['id'] . '">Reply</button>';
                        echo '</div>';
                        display_comments($comments, $comment['id'], $level + 1);
                        $counter++;
                    }
                }
            }
            display_comments($all_comments);
            ?>
        <?php } else { ?>
            <p>Chưa có bình luận nào cho bài viết này.</p>
        <?php } ?>
        <!-- Form to Add New Comment -->
        <h3>Thêm bình luận mới</h3>
        <?php if (isset($message)) { ?>
            <div class="alert alert-success" role="alert"><?php echo $message ?></div>
        <?php } ?>
        <form method="post" action="" style="padding-bottom:40px;">
            <input type="hidden" name="id_blog" value="<?php echo htmlspecialchars($_GET['id']); ?>">
            <input type="hidden" id="id_parent_comment" name="id_parent_comment" value="0">
            <div class="form-group">
                <label for="name">Tên của bạn</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email của bạn</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="comment">Nội dung bình luận</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-submit">Gửi bình luận</button>
        </form>
    </div>

</div>
<footer>
    <?php include "includes/footer.php"; ?>
</footer>
<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Your custom scripts -->
<script>
// JavaScript code here
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.reply-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var parentId = this.getAttribute('data-id');
            document.getElementById('id_parent_comment').value = parentId;
            document.getElementById('comment').focus();
        });
    });
});
</script>
</body>
</html>
<?php
    } else {
        echo "<p>Bài viết không tồn tại.</p>";
    }
} else {
    echo "<p>Không có ID bài viết được cung cấp.</p>";
}
?>
