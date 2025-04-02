


<?php 

// Retrieve about content
$about = new about($db);
$about->id = 1;
$about->read();
 ?>


<div class="container-fluid about py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <div class="h-100" style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                    <img src="images/<?php echo $settings->site_logo ?>" class="img-fluid w-100 h-100" alt="">
                </div>
            </div>
            <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(img/about-img-1.png);">
                <p class="mb-4">
                    <?php 
                        echo $about->content;
                    ?>
                </p>
                <!-- <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="">Read More</a> -->
            </div>
        </div>
    </div>
</div>
