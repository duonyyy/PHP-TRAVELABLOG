<?php  
$sliders = new sliders($db);
$stmt_sliders = $sliders->readAll();
?>

<div class="carousel-header">
    <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $slideIndex = 0;
            while($row = $stmt_sliders->fetch()) {
                $activeClass = ($slideIndex === 0) ? 'class="active"' : '';
                echo '<li data-bs-target="#carouselId" data-bs-slide-to="'.$slideIndex.'" '.$activeClass.'></li>';
                $slideIndex++;
            }
            ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php
            $stmt_sliders->execute(); // Re-execute the statement to reset the fetch pointer
            $slideIndex = 0;
            while($row = $stmt_sliders->fetch()) {
                $activeClass = ($slideIndex === 0) ? 'active' : '';
                echo '
                <div class="carousel-item '.$activeClass.'">
                    <img src="images/sliders/'.$row['image'].'" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Explore The World</h4>
                            <h1 class="display-2 text-capitalize text-white mb-4">Let\'s The World Together!</h1>
                            <p class="mb-5 fs-5">'.$row['title'].'</p>
                        </div>
                    </div>
                </div>';
                $slideIndex++;
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
            <span class="carousel-control-prev-icon btn bg-primary" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
            <span class="carousel-control-next-icon btn bg-primary" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>








































<!-- <?php  
$sliders = new sliders($db);
$stmt_sliders = $sliders->readAll();


?>


 <div class="carousel-header">
                <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                         
                        <div class="carousel-item active">
                            <?php  
                            while($rows = $stmt_sliders->fetch()){
                            ?>
                            <img src="images/sliders/<?php echo $rows['image'] ?>" class="img-fluid" alt="Image">
                            <div class="carousel-caption">
                                <div class="p-3" style="max-width: 900px;">
                                    <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Explore The World</h4>
                                    <h1 class="display-2 text-capitalize text-white mb-4">Let's The World Together!</h1>
                                    <p class="mb-5 fs-5"> <?php echo $rows['title'] ?>
                                    </p>
                                   
                                </div>
                            </div>
                              <?php  
                        }
                        ?>
                        </div>
                     
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon btn bg-primary" aria-hidden="false"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                        <span class="carousel-control-next-icon btn bg-primary" aria-hidden="false"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div> -->