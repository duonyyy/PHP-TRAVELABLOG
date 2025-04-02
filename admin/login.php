<?php  
include "database/database.php";
include "database/settings.php";
include "database/users.php";
$database = new database();
$db = $database->connect();

$users = new users($db);

$settings = new settings($db);
$settings->id = 1;
$settings->read();

if($_SERVER['REQUEST_METHOD']=='POST'){
  $username = $_POST['username'];
  $password = sha1($_POST['password']);

  $users->username = $username;
  $users->password = $password;
  
  /*Signup admin*/
  if($users->roleAdmin()->rowCount()==0){
    $users->name = $_POST['name'];
    $users->email = $_POST['email'];
    $users->phone = $_POST['phone'];
    $users->role = 2;
    $users->image = "guest.jpg";
    $users->email_verified = "verified";
    $users->status = 1;

    date_default_timezone_set($settings->site_timezone);
    $users->created_at = date("Y-m-d h:i:s",time());
    $users->updated_at = date("Y-m-d h:i:s",time());
    
    $users->create();
  }

  /*Signin user*/
  if($users->userLogin()->rowCount()>0){
    $row = $users->userLogin()->fetch();
    
    session_start();
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_role'] = $row['role'];

    header("location:index.php");
  }else{
    $error = "Login failed!";
  }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <title><?php echo $settings->site_name ?></title>
  <link rel="icon" href="<?php echo "../images/".$settings->site_favicon ?>">

  <!-- Bootstrap core CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #f5f5f5;
      font-family: Arial, sans-serif;
    }
    .form-signin {
      width: 100%;
      max-width: 420px;
      padding: 15px;
      margin: 0 auto;
      background: #CCFFFF;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-signin .form-control {
      height: 45px;
      margin-bottom: 10px;
      border-radius: 5px;
    }
    .form-signin .btn {
      border-radius: 5px;
      padding: 10px;
      font-size: 16px;
    }
    .alert {
      margin-bottom: 15px;
    }
    .form-signin img {
      max-width: 100px;
      margin-bottom: 20px;
    }
    .form-signin h1 {
      margin-bottom: 20px;
    }
    .text-muted {
      font-size: 14px;
    }
  </style>
</head>
<body class="text-center">

<?php
if($users->roleAdmin()->rowCount()>0){
?>
  <!-- Sign in user --> 
  <form class="form-signin" action="" method="POST">
    <?php if(isset($error)): ?>
      <div class="alert alert-danger"><?php echo $error ?></div>    
    <?php endif; ?>
    
    <?php if($settings->site_logo): ?>
      <img class="mb-4" src="<?php echo "../images/".$settings->site_logo; ?>" alt="">
    <?php else: ?>
      <img class="mb-4" src="assets/img/bootstrap-solid.svg" alt="">
    <?php endif; ?>
    
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
    <input type="password" name="password" class="form-control" placeholder="Password" required>
    <div class="form-group">
      <label class="checkbox-inline">
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <div style="padding-top: 15px;">
      <p class="mt-5 mb-3 text-muted"><?php echo $settings->site_footer ?></p>
    </div>
  </form>
<?php } else { ?>
  <!-- Sign up Admin -->
  <form class="form-signin" method="POST" action="">
    <?php if($settings->site_logo): ?>
      <img class="mb-4" src="<?php echo "../images/".$settings->site_logo; ?>" alt="">
    <?php else: ?>
      <img class="mb-4" src="assets/img/bootstrap-solid.svg" alt="">
    <?php endif; ?>
    
    <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
    <input type="text" name="name" class="form-control" placeholder="Name" required>
    <input type="text" name="email" class="form-control" placeholder="Email" required>
    <input type="text" name="phone" class="form-control" placeholder="Phone" required>
    <input type="text" name="username" class="form-control" placeholder="Username" required>
    <input type="password" name="password" class="form-control" placeholder="Password" required>
    <div class="form-group">
      <label class="checkbox-inline">
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
    <div style="padding-top: 15px;">
      <p class="mt-5 mb-3 text-muted"><?php echo $settings->site_footer ?></p>
    </div>
  </form>
<?php } ?>

</body>
</html>
