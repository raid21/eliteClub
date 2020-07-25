<?php if (isset($_SESSION['id'])): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fal fa-user"></i>
                                    <?php echo $_SESSION['username']; ?>    
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item text-capitalize" href="<?php echo BASE_URL . '/dashboard/profile.php' ?>">My Profile</a>
                                    <a class="dropdown-item text-capitalize" href="<?php echo BASE_URL . '/logout.php' ?>">Logout</a>
                                </div>
                            </li>
                        <?php else: ?>
                            <li class="nav-item login_link"><a class="nav-link" href="<?php echo BASE_URL . '/login.php' ?>">Login</a></li>
                        <?php endif;?>