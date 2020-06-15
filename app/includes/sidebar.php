<nav id="sidebar">
            <div id="dismiss">
                <i class="fas fa-arrow-left"></i>
            </div>

            <div class="sidebar-header">
                <h3>Elite</h3>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <?php if(isset($_SESSION['id'])): ?>
                        <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false" class="text-capitalize"><i class="fas fa-user"></i>
                        <?php echo $user_det['username']; ?> <i class="fas fa-chevron-down"></i></a>
                        <ul class="collapse list-unstyled" id="userSubmenu">
                            <li>
                                <a href="<?php echo BASE_URL . '/dashboard/profile.php' ?>">My Profile</a>
                            </li>

                            <li>
                                <a href="<?php echo BASE_URL . '/logout.php' ?>"><i class="fas fa-sign-out"></i> Logout</a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </li>

                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"><i class="fas fa-edit"></i>
                        Manage Posts <i class="fas fa-chevron-down"></i></a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="<?php echo BASE_URL . '/dashboard/posts/create.php' ?>">Create Post</a>
                        </li>

                    </ul>
                </li>

                <?php if($user_det['admin'] === 1): ?>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"><i class="fas fa-user"></i>
                            Manage Users <i class="fas fa-chevron-down"></i></a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="<?php echo BASE_URL . '/dashboard/users/' ?>">All Users</a>
                            </li>
                            <li>
                                <a href="<?php echo BASE_URL . '/dashboard/users/create.php' ?>">Add User</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li>
                    <a href="#searchSubmenu" data-toggle="collapse" aria-expanded="false"><i class="fas fa-search"></i>
                        Search <i class="fas fa-chevron-down"></i></a>
                    <ul class="collapse list-unstyled" id="searchSubmenu">
                        <li class="m-2">
                            <form action="#" method="POST">
                                <input type="text" class="form-control" name="search" placeholder="Search ..." id="search">
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>

        </nav>
