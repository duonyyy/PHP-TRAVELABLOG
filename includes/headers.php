 <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <h1 class="m-0">
            <img style="width: 75px; height: 75px;" src="images/<?php echo htmlspecialchars($settings->site_logo); ?>" alt="Homepage">
            Travela
        </h1>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                  <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <?php
            $current_page = basename($_SERVER['PHP_SELF']); // Get the current page filename
            ?>
            <a href="index.php" class="nav-item nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>">Home</a>
            <a href="about.php" class="nav-item nav-link <?php echo $current_page == 'about.php' ? 'active' : ''; ?>">About</a>
            <a href="contact.php" class="nav-item nav-link <?php echo $current_page == 'contact.php' ? 'active' : ''; ?>">Contact</a>
            <a href="terms.php" class="nav-item nav-link <?php echo $current_page == 'terms.php' ? 'active' : ''; ?>">Terms</a>
            
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Categories</a>
                <div class="dropdown-menu m-0">
                    <?php
                    if ($stmt_blogcategories->rowCount() > 0) {
                        while ($rows = $stmt_blogcategories->fetch()) {
                            echo '<a href="category.php?cate=' . htmlspecialchars($rows['id']) . '" class="dropdown-item">' . htmlspecialchars($rows['title']) . '</a>';
                        }
                    } else {
                        echo '<li><a href="#">No categories available</a></li>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- <a href="" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Book Now</a> -->
    </div>
            </nav>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">  Travela</h1>
               
            </div>
        </div>