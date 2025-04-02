<?php
// Include necessary PHP files
include "admin/database/database.php";
include "admin/database/blogcategories.php";
include "admin/database/settings.php";
include "admin/database/sliders.php";
include "admin/database/socials.php";
include "admin/database/contact.php";
include "admin/database/about.php";
include "admin/database/links.php";
include "admin/database/subscribers.php";

// Initialize database connection
$database = new database();
$db = $database->connect();

// Initialize objects for different database tables
$settings = new settings($db);
$settings->id = 1;
$settings->read();

$blogcategories = new blogcategories($db);
$stmt_blogcategories = $blogcategories->readAll();

$socials = new socials($db);
$stmt_socials = $socials->readAll();

$links = new links($db);
$stmt_links = $links->readAll();

$contact = new contact($db);
$contact->id = 1;
$contact->read();

$about = new about($db);
$about->id = 1;
$about->read();

/* Verification code */
if (!empty($_GET['verify'])) {
    $subscribers = new subscribers($db);
    $subscribers->verified_token = $_GET['verify'];
    $stmt_subscribers = $subscribers->checkRequestVerified();
    
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($settings->site_name); ?></title>
    <link rel="icon" href="<?php echo "./images/" . htmlspecialchars($settings->site_favicon); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">

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

 <?php
       include "includes/header_top.php";

       include "includes/headers.php"; 
       ?> 
<!-- Navbar & Hero Start -->
<div class="container-fluid position-relative p-0">
   
</div>
<!-- Navbar & Hero End -->

<!-- Contact Start -->
<div class="container-fluid contact bg-light py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Contact Us</h5>
            <h1 class="mb-0">Contact For Any Query</h1>
        </div>
        <div class="row g-5 align-items-center">
            <div class="col-lg-4">
                <div class="bg-white rounded p-4">
                    <div class="text-center mb-4">
                        <i class="fa fa-map-marker-alt fa-3x text-primary"></i>
                        <h4 class="text-primary">Address</h4>
                        <p class="mb-0">123 Ranking Street, <br> New York, USA</p>
                    </div>
                    <div class="text-center mb-4">
                        <i class="fa fa-phone-alt fa-3x text-primary mb-3"></i>
                        <h4 class="text-primary">Mobile</h4>
                        <p class="mb-0">+012 345 67890</p>
                    </div>
                    <div class="text-center">
                        <i class="fa fa-envelope-open fa-3x text-primary mb-3"></i>
                        <h4 class="text-primary">Email</h4>
                        <p class="mb-0">info@example.com</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <h3 class="mb-2">Send us a message</h3>
                <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
                <form>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                
                                <input name="name" type="text" id="name" class="form-control border-0" placeholder="Your Name" value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                 <input name="email" type="text" id="email" class="form-control border-0" placeholder="Your Email" value="">
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="message" id="message" class="form-control border-0" placeholder="Your Message"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" onclick="mailContact()" type="button">Send Message</button>
                        </div>
                    </div>
                </form>
                 <div id="contact_send"></div>
            </div>
        </div>
        <!-- Assuming this section is for displaying a site map -->
        <div class="row mt-5">
             <?php 
                  echo  $settings->site_map;
            ?>
        </div>
    </div>
</div>
<!-- Contact End -->

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
<script type="text/javascript">
   function mailContact(){
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var message = document.getElementById("message").value;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText.trim() == "success") {
                        document.getElementById('name').value = "";
                        document.getElementById('email').value = "";
                        document.getElementById('message').value = "";
                        document.getElementById('contact_send').innerHTML = "Your message has been sent to Admin!";
                    } else {
                        document.getElementById('contact_send').innerHTML = "There was an error sending your message.";
                    }
                }
            };
            xhttp.open("POST", "sendmailcontact.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send('name=' + encodeURIComponent(name) + '&email=' + encodeURIComponent(email) + '&message=' + encodeURIComponent(message));
        }
</script>
<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>
</html>
