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
                            <?php if($user_det['admin'] === 1): ?>
                                <a href="<?php echo BASE_URL . '/dashboard/posts/createEvent.php' ?>">Create Event</a>
                            <?php endif; ?>
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

                    <li>
                        <a href="#doctorSubmenu" data-toggle="collapse" aria-expanded="false"><i class="fas fa-user"></i>
                            Manage Doctors <i class="fas fa-chevron-down"></i></a>
                        <ul class="collapse list-unstyled" id="doctorSubmenu">
                            <li>
                                <a href="<?php echo BASE_URL . '/dashboard/teleconsultation/all_domains/all_drs.php' ?>">All Doctors</a>
                            </li>
                            <li>
                                <a href="<?php echo BASE_URL . '/dashboard/teleconsultation/all_domains/all_dentists.php' ?>">All Dentists</a>
                            </li>
                            <li>
                                <a href="<?php echo BASE_URL . '/dashboard/teleconsultation/all_domains/all_pharm.php' ?>">All Pharmacies</a>
                            </li>
                            <li>
                                <a href="<?php echo BASE_URL . '/dashboard/teleconsultation/creation/addDoctor.php' ?>">Add Doctor</a>
                            </li>

                            <li>
                                <a href="<?php echo BASE_URL . '/dashboard/teleconsultation/creation/createMedicalSp.php' ?>">Add Specialty</a>
                            </li>
                            <li>
                                <a href="<?php echo BASE_URL . '/dashboard/teleconsultation/all_domains/all_specialties.php' ?>">All Specialties</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

            </ul>

        </nav>
