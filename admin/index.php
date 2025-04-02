<?php
session_start();
include "database/database.php";
include "database/blogcategories.php";
include "database/blogs.php";
include "database/sliders.php";
include "database/socials.php";
include "database/links.php";
include "database/about.php";
include "database/contact.php";
include "database/terms.php";
include "database/settings.php";
include "database/mailsettings.php";
include "database/subscribers.php";
include "database/comments.php";
include "database/users.php";
include "helper/help_function.php";

/*Check session user_id*/
if(empty($_SESSION['user_id'])){
    header("location:login.php");
}

$database = new database();
$db = $database->connect();

$settings = new settings($db);
$settings->id = 1;
$settings->read();

$page = isset($_GET['page'])?$_GET['page']:'dashboard';
?>  

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title><?php echo $settings->site_name ?></title>
  <link rel="icon" href="<?php echo "../images/".$settings->site_favicon ?>">
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    
  <!-- CSS Files -->
  <link href="./assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
 
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

</head>

<body class="">
  <div class="wrapper ">
    <!-- Slidebar -->
      <?php  
        include "includes/sidebar.php";
      ?>
    <!-- End Slidebar -->

    <div class="main-panel ">
      <!-- Header -->
      <?php  
        include "includes/header.php";
      ?>
      <!-- End Header -->

      <!-- Nav Slide -->
      <?php  
      if($page == 'dashboard'){
                    include "includes/dashboard.php"; 
                }else if($page == 'blogcategories'){
                    include "includes/blogcategories.php"; 
                }else if($page == 'blogcategories_add'){
                    include "includes/blogcategories_add.php"; 
                }else if($page == 'blogcategories_edit'){
                    include "includes/blogcategories_edit.php"; 
                }
                /*End blogcategories*/
                else if($page == 'blogs'){
                    include "includes/blogs.php"; 
                }else if($page == 'blogs_add'){
                    include "includes/blogs_add.php"; 
                }else if($page == 'blogs_edit'){
                    include "includes/blogs_edit.php"; 
                }
                /*End blogs*/
                else if($page == 'sliders'){
                    include "includes/sliders.php"; 
                }else if($page == 'sliders_add'){
                    include "includes/sliders_add.php"; 
                }else if($page == 'sliders_edit'){
                    include "includes/sliders_edit.php"; 
                }
                /*End sliders*/
                else if($page == 'socials'){
                    include "includes/socials.php"; 
                }else if($page == 'socials_add'){
                    include "includes/socials_add.php"; 
                }else if($page == 'socials_edit'){
                    include "includes/socials_edit.php"; 
                }
                /*End socials*/
                else if($page == 'links'){
                    include "includes/links.php"; 
                }else if($page == 'links_add'){
                    include "includes/links_add.php"; 
                }else if($page == 'links_edit'){
                    include "includes/links_edit.php"; 
                }
                /*End links*/
                else if($page == 'users'){
                    include "includes/users.php"; 
                }else if($page == 'users_add'){
                    include "includes/users_add.php"; 
                }else if($page == 'users_edit'){
                    include "includes/users_edit.php"; 
                }
                /*End users*/
                else if($page == 'abouts'){
                    include "includes/abouts.php"; 
                }else if($page == 'contact'){
                    include "includes/contact.php"; 
                }else if($page == 'terms'){
                    include "includes/terms.php"; 
                }else if($page == 'settings'){
                    include "includes/settings.php"; 
                }else if($page == 'mailsettings'){
                    include "includes/mailsettings.php"; 
                }else if($page == 'subscribers'){
                    include "includes/subscribers.php"; 
                }else if($page == 'subscribers_add'){
                    include "includes/subscribers_add.php"; 
                }else if($page == 'comments'){
                    include "includes/comments.php"; 
                }   
      ?>
      
      <!-- Footer -->
    
      <!-- End Footer -->
     
    </div>

    
  </div>
  <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
   <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
  <!-- Summer note -->
  <!-- include summernote css/js -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script>
    $('#content').summernote({
      placeholder: 'Input content',
      tabsize: 2,
      height: 200
    });
    $('#footer').summernote({
      placeholder: 'Input content footer',
      tabsize: 2,
      height: 100
    });
 
    function sendMail(){
      var title = document.getElementById("title").value;
      var content = document.getElementById("content").value;
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
              //console.log("this.responseText");
              //alert(this.responseText);
              if(this.responseText == "success"){
                  document.getElementById("msg").innerHTML = "<div class='alert alert-success'>Mail has been send to all Users successfully!</div>";
              }else{
                  document.getElementById("msg").innerHTML = "<div class='alert alert-warning'>No user available to send email</div>";
              }                
          }
      }
      xhttp.open("POST","mail/sendmail.php",true);
      xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xhttp.send("title="+title+"&content="+content);
    }
  </script>
</body>

</html>