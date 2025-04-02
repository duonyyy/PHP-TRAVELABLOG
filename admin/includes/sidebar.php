 <div class="sidebar"  data-color="green" data-background-color="white" data-image="../images/tải xuống.png">
      <div class="logo"><a href="#" class="simple-text logo-normal">
          ADMIN WEBSITE
        </a></div>
      <div class="sidebar-wrapper" style="background-color:#FF9900 ;">
        <ul class="nav">
          <li class="nav-item <?php echo setActive('dashboard') ?>">
            <a class="nav-link" href="index.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item <?php echo setActive('blogs') ?> ">
            <a class="nav-link" href="index.php?page=blogs">
              <i class="material-icons">library_books</i>
              <p>Blogs</p>
            </a>
          </li>
          <?php
          /*Admin - Mod menu*/
            if($_SESSION['user_role']>=1){
          ?>
          <li class="nav-item <?php echo setActive('blogcategories') ?> ">
            <a class="nav-link" href="index.php?page=blogcategories">
              <i class="material-icons">bar_chart</i>
              <p>Blog Categories</p>
            </a>
          </li>
          <li class="nav-item <?php echo setActive('subscribers') ?> ">
            <a class="nav-link" href="index.php?page=subscribers">
              <i class="material-icons">subscriptions</i>
              <p>Subscribers</p>
            </a>
          </li>
          <li class="nav-item <?php echo setActive('comments') ?> ">
            <a class="nav-link" href="index.php?page=comments">
              <i class="material-icons">forum</i>
              <p>Comments</p>
            </a>
          </li>
          <li class="nav-item <?php echo setActive('users') ?> ">
            <a class="nav-link" href="index.php?page=users">
              <i class="material-icons">person</i>
              <p>User</p>
            </a>
          </li>
          <?php
          }
          /*Admin menu*/
           if($_SESSION['user_role']==2){
          ?>
          <li class="nav-item">
              <a class="nav-link dropdown" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">lan</i>
              <p>Manage Website</p>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item <?php echo setActive('sliders') ?>" href="index.php?page=sliders">Slider</a>
                  <a class="dropdown-item <?php echo setActive('socials') ?>" href="index.php?page=socials">Socials</a>
                  <a class="dropdown-item <?php echo setActive('links') ?>" href="index.php?page=links">Link Menu</a>
                  <a class="dropdown-item <?php echo setActive('abouts') ?>" href="index.php?page=abouts">About</a>
                  <a class="dropdown-item <?php echo setActive('contact') ?>" href="index.php?page=contact">Contact</a>
                  <a class="dropdown-item <?php echo setActive('terms') ?>" href="index.php?page=terms">Terms</a>
                  <a class="dropdown-item <?php echo setActive('settings') ?>" href="index.php?page=settings">Settings</a>
                  <a class="dropdown-item <?php echo setActive('mailsettings') ?>" href="index.php?page=mailsettings">Settings Mail</a>
              </div>
          </li>
          <?php  
            }
          ?>
        </ul>
      </div>
    </div>