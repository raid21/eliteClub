<?php 
include("path.php"); 
include(ROOT_PATH . "/app/database/db.php");
require(ROOT_PATH . "/app/controllers/contactmail.php");
// require(ROOT_PATH . "/app/controllers/users.php");
$all_users = selectAll('users', ['admin' => 1]);
$latest_events = latest_events('events');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite - Skikda</title>
    <link rel="stylesheet" href="assets/css/fontawsome/css/all.min.css">
    <link href="assets/css/aos_animation.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.main.css">
</head>

<body>
    <!-- start of navbar -->
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-light" data-aos="fade-left" data-aos-duration="2000">

                <a class="navbar-brand text-uppercase" href="index.php"><img src="assets/img/elite_logo.png" alt="">  el<span>i</span>te<small>21</small></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fal fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item"> <a class="nav-link" href="#about">about</a></li>
                        <?php if(!empty($latest_events)): ?>
                            <li class="nav-item"> <a class="nav-link" href="#activities">events</a></li>
                        <?php endif; ?>
                        <li class="nav-item"> <a class="nav-link" href="activities/">Blog</a></li>
                        <li class="nav-item"> <a class="nav-link" href="#team">team</a></li>
                        <li class="nav-item"> <a class="nav-link" href="#contact">contact</a></li>

                        <?php include(ROOT_PATH . "/app/includes/login_nav.php") ?>

                    </ul>
                </div>
            </nav>
            
            <?php if(empty($_SESSION['type'])): ?>
                <div class="hero">
                <h2 class="text-center text-capitalize">welcome to elite 21</h2>
                <h4 class="text-center">Being an Elite is a responsibility more than an advantage! <br>Be the best be the Elite</h4>
            </div>
            <?php else: ?>
                <div class="mt-5">
                    <?php include(ROOT_PATH . "/app/helpers/messages.php") ?>
                </div>
            <?php endif; ?>
            
        </div>
    </header>
    <!-- start of navbar -->

    <!-- start of who are we section -->
    <div class="who-are-we" id="about" data-aos="fade-right" data-aos-duration="2500" data-aos-easing="ease-in-sine">
        <div class="container">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-5 col-lg-4 col-md-6 sm-12 mb-sm-5 mb-xm-6">
                    <div class="content">
                        <div class="card shadow-lg one">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize">who are we</h5>
                                <p class="card-text">We are a non-profit medical association, created in July 25, 2019, includs medical students and health personnel, pharmacy and dental surgery.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-8 col-md-6 sm-12">
                    <div class="content">
                        <div class="card shadow-lg two">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize">what we do</h5>
                                <p class="card-text">We aim to promote the medical sector in Skikda, educate citizens about the various health problems and ensuring the best possible environment for the personal and educational development of our members.
                                    We attach great importance to students so they can: enrich their scientific knowledge through training and targeted days, sculpt and exploit their talents in different areas.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end of who are we section -->

    <!-- start of events section -->
    <?php if(!empty($latest_events)): ?>
        <div class="activities" id="activities">
            <div class="container">
                <div class="event-cont" data-aos="fade-left" data-aos-duration="1500">
                    <div class="row">

                        <div class="heading col-sm-12 col-md-4" data-aos="fade-right" data-aos-duration="2000">
                            <h5>Upcoming Events</h5>
                            <p>Here you can find our upcoming events.</p>
                        </div>

                        <?php foreach($latest_events as $event): ?>

                            <div class="col-sm-12 col-md-4 " data-aos="fade-up" data-aos-duration="3000">
                                <div class="card">
                                    <div class="test">
                                        <p class="text-capitalize"><?php echo $event['event_date'] ?></p>
                                        <img src="<?php echo BASE_URL . '/assets/img/' . $event['event_img'] ?>" class="card-img-top" alt="event pic">
                                    </div>
                                    <div class="card-body">
                                        <a href="<?php echo("activities/read.php?p_id=" . $event['id'] . "&usr_id=" . $event['user_id'] . "&t=events"); ?>" class="text-capitalize"><?php echo $event['event_title'] ?></a>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    </div>
                </div>

            </div>
        </div>
    <?php endif; ?>
    <!-- end of events section -->

    <!-- start of our team section -->
    <?php if(!empty($all_users)): ?>
        <div class="our-team" id="team" data-aos="flip-down" data-aos-duration="2000">
            <div class="container">
                <h2 class="text-center">Our Team</h2>
                <p class="text-center heading-p">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Non itaque velit
                    impedit
                    quae.</p>

                <!-- Swiper -->
                <div class="swiper-container">
                    <div class="swiper-wrapper">

                        <?php foreach($all_users as $single_usr): ?>
                            <div class="swiper-slide">
                                <div class="card">
                                    <img src="<?php echo BASE_URL . '/assets/img/' . $single_usr['profile_pic'] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title text-center text-capitalize"><?php echo $single_usr['username'] ?></h5>

                                        <?php if($single_usr['admin'] == 0): ?>
                                            <p class="card-text text-center">Member</p>
                                        <?php else: ?>
                                            <p class="card-text text-center">Admin</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- end of our team section -->

    <!-- start of contact us section -->
    <div class="contact-us" id="contact">
        <div class="container">
            <h2 class="text-center" data-aos="fade-down" data-aos-duration="1500">Contact Us</h2>
            <p class="text-center" data-aos="fade-down" data-aos-duration="1500">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Non itaque velit impedit
                quae.</p>

            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4" data-aos="fade-right" data-aos-duration="2000">
                    <div class="info-box">
                        <i class="fab fa-facebook-f"></i>
                        <h3>Our Facebook</h3>
                        <p>Nems Skikda</p>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4" data-aos="zoom-in" data-aos-duration="2000">
                    <div class="info-box">
                        <i class="fal fa-envelope"></i>
                        <h3>Email Us</h3>
                        <p>elite_skikda@outlook.fr</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4" data-aos="fade-left" data-aos-duration="2000">
                    <div class="info-box">
                        <i class="fal fa-phone-volume"></i>
                        <h3>Call Us</h3>
                        <p>+213 (0) 671000795</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 mt-5 shadow-lg p-5">
                    <form action="index.php" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="contact-name" id="inputName" placeholder="Your Full Name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" name="contact-email" id="inputEmail" placeholder="Your Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="contact-sub" id="inputSubject" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="inputMessage" name="contact-msg" placeholder="Your Message"
                                rows="3"></textarea>
                        </div>
                        <div class="text-center"><button type="submit" name="submt-msg" class="btn">Send Message</button></div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- end of contact us section -->

    <div class="footer" id="footer">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 footer-links">
                    <div class="row">
                        <div class="col-xm-12 col-sm-6 col-md-7">
                            <div class="copyright mb-sm-3 mb-md-0">Copyright &copy; <strong><span>Elite</span></strong>. All Rights
                                Reserved</div>
                        </div>
                        <div class="col-xm-12 col-sm-6 col-md-5 social-links">
                            <a href="https://www.facebook.com/nems.skikda.1"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/elite_skikda_21_/"><i class="fab fa-instagram ml-3"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/aos_animation.js"></script>
    <script src="assets/js/swiper.min.js"></script>
    <script src="assets/js/script.main.js"></script>
</body>

</html>