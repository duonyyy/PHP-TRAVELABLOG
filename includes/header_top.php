 <div class="container-fluid bg-primary px-5 d-none d-lg-block">
            <div class="row gx-0">
                <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                     <?php  
                        while($rows = $stmt_socials->fetch()){
                        ?>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="<?php echo $rows['url'] ?>">
                            <?php echo $rows['icon'] ?>
                        </a>
                          <?php  
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                       
                       
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle text-light" data-bs-toggle="dropdown"><small><i class="fa fa-home me-2"></i> My Dashboard</small></a>
                            <div class="dropdown-menu rounded">
                               
                                <a href="#" class="dropdown-item"><i class="fa fa-sign-in-alt me-2"></i> Login</a>
                                
                                <a href="#" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        