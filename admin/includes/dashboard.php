<?php  
$blogs = new blogs($db);
$users = new users($db);
$comments = new comments($db);
$subscribers = new subscribers($db);
?>
<div class="container-fluid">
   <h1 class="mt-4 text-primary">DASHBOARD</h1>
   

    <div class="row">
       <div class="col-md-3 col-sm-6 mb-4">
    <div class="card border-primary ">
        <div class="card-header text-white text-center">
             <i class="fa fa-bar-chart-o fa-5x" style="color: darkblue;"></i>
        </div>
        <div class="card-body bg-white text-center d-flex flex-column justify-content-center">
            <h3 class="card-title mb-0"><?php echo $blogs->readAll()->rowCount(); ?></h3>
        </div>
        <div class="card-footer bg-white text-center">
            <h5 class="mb-0 ">Blogs</h5>
        </div>
    </div>
</div>

       <div class="col-md-3 col-sm-6 mb-4">
    <div class="card border-primary">
        <div class="card-header  text-white text-center">
            <i class="fa fa-user-friends fa-5x" style="color: darkblue;"aria-hidden="true"></i>
        </div>
        <div class="card-body bg-white text-center d-flex flex-column justify-content-center">
            <h3 class="card-title mb-0"><?php echo $users->readAll()->rowCount(); ?></h3>
        </div>
        <div class="card-footer bg-white text-center">
            <h5 class="mb-0">Users</h5>
        </div>
    </div>
</div>

<div class="col-md-3 col-sm-6 mb-4">
    <div class="card border-primary">
        <div class="card-header  text-white text-center">
            <i class="fa fa-comments fa-5x" style="color: darkblue;"></i>
        </div>
        <div class="card-body bg-white text-center d-flex flex-column justify-content-center">
            <h3 class="card-title mb-0"><?php echo $comments->readAll()->rowCount(); ?></h3>
        </div>
        <div class="card-footer bg-white text-center">
            <h5 class="mb-0">Comments</h5>
        </div>
    </div>
</div>

<div class="col-md-3 col-sm-6 mb-4">
    <div class="card border-primary">
        <div class="card-header  text-white text-center">
            <i class="fa fa-user-plus fa-5x" style="color: darkblue;"></i>
        </div>
        <div class="card-body bg-white text-center d-flex flex-column justify-content-center">
            <h3 class="card-title mb-0"><?php echo $subscribers->readAll()->rowCount(); ?></h3>
        </div>
        <div class="card-footer bg-white text-center">
            <h5 class="mb-0">Subscribers</h5>
        </div>
    </div>
</div>


</div>
