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
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="loginDropDown" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">Login</a>
                                <div class="dropdown-menu" aria-labelledby="loginDropDown">

                                    <form class="m-2 m-sm-2" action="index.php" method="post">
                                        <input type="text" class="form-control mr-2 mb-2" placeholder="Username"
                                            name="username">
                                        <input type="password" class="form-control mr-2 mb-2" placeholder="Password"
                                            name="password">
                                        <button class="btn btn-outline-success" name="login" type="submit">Login</button>
                                    </form>

                                </div>
                            </li>
                        <?php endif;?>