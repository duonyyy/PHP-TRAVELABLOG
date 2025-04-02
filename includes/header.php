<nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
    <a href="index.php" class="navbar-brand p-0">
        <h1 class="m-0">
            <img style="width: 75px; height: 75px;" src="images/<?php echo htmlspecialchars($settings->site_logo); ?>" alt="Homepage">
            Travela
        </h1>
        <!-- <img src="img/logo.png" alt="Logo"> -->
    </a>
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
