<?php 
include("path.php"); 
require(ROOT_PATH . "/app/controllers/users.php");
$all_users = selectAll('users');
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

                <a class="navbar-brand text-uppercase" href="index.html">el<span>i</span>te</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fal fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item"> <a class="nav-link" href="#about">about</a></li>
                        <li class="nav-item"> <a class="nav-link" href="activities/">activities</a></li>
                        <li class="nav-item"> <a class="nav-link" href="#team">team</a></li>
                        <li class="nav-item"> <a class="nav-link" href="#contact">contact</a></li>
                        <!-- <li class="nav-item"> <a class="nav-link" href="#">blog</a></li> -->

                        <?php include(ROOT_PATH . "/app/includes/login_nav.php") ?>

                    </ul>
                </div>
            </nav>
            
            <?php if(empty($_SESSION['type'])): ?>
                <div class="hero">
                <h1 class="text-center text-capitalize">welcome to elite 21</h1>
                <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, harum, eos fuga
                    atque ad iure distinctio, sapiente eaque laborum earum omnis.</p>
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
                                <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod,
                                    praesentium esse? Inventore quasi, necessitatibus fuga, nemo soluta non optio
                                    consequatur aliquid in dolorum voluptatum nostrum! Ut laudantium eaque soluta quos.
                                </p>
                                <a href="#" class="card-link mx-auto">See More&#xa0;&#x203A;</i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-8 col-md-6 sm-12">
                    <div class="content">
                        <div class="card shadow-lg two">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize">what we do</h5>
                                <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod,
                                    praesentium esse? Inventore quasi, necessitatibus fuga, nemo soluta non optio
                                    consequatur aliquid in dolorum voluptatum nostrum! Ut laudantium eaque soluta quos.
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
    <div class="activities" id="activities">
        <div class="container">
            <div class="event-cont" data-aos="fade-left" data-aos-duration="1500">
                <div class="row">

                    <div class="heading col-sm-12 col-md-4" data-aos="fade-right" data-aos-duration="2000">
                        <h5>Upcoming Activities</h5>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit</p>
                        <a href="#">See All&#xa0;<i class="fal fa-chevron-circle-right"></i></a>
                    </div>

                    <div class="col-sm-12 col-md-4 one" data-aos="fade-up" data-aos-duration="3000">
                        <div class="card">
                            <div class="test">
                                <p>June 7, 2020</p>
                                <img src="assets/img/event2.jpg" class="card-img-top" alt="event pic">
                            </div>
                            <div class="card-body">
                                <a href="#">Lorem ipsum dolor sit amet.</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4" data-aos="fade-up" data-aos-duration="3000">
                        <div class="card">
                            <div class="test">
                                <p>June 6, 2020</p>
                                <img src="assets/img/event2.jpg" class="card-img-top" alt="event pic">
                            </div>
                            <div class="card-body">
                                <a href="#">Lorem ipsum dolor sit amet</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
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
                        <i class="fal fa-map-marker-alt"></i>
                        <h3>Our Address</h3>
                        <p>A108 Adam Street, New York, NY 535022</p>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4" data-aos="zoom-in" data-aos-duration="2000">
                    <div class="info-box">
                        <i class="fal fa-envelope"></i>
                        <h3>Email Us</h3>
                        <p>boulahdidraid18@gmail.com</p>
                        <p>raidski20@gmail.com</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4" data-aos="fade-left" data-aos-duration="2000">
                    <div class="info-box">
                        <i class="fal fa-phone-volume"></i>
                        <h3>Call Us</h3>
                        <p>+213 (0) 794766196</p>
                        <p>+213 (0) 674587326</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 mt-5 shadow-lg p-5" data-aos="zoom-out-down" data-aos-duration="2500">
                    <form action="#" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="inputName" placeholder="Your Name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" id="inputEmail" placeholder="Your Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="inputSubject" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="inputMessage" placeholder="Your Message"
                                rows="3"></textarea>
                        </div>
                        <div class="text-center"><button type="submit" class="btn">Send Message</button></div>
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
                            <a href="https://www.facebook.com/Mandalore21/"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/raid_boulahdid/"><i class="fab fa-instagram ml-3"></i></a>
                            <a href="https://www.linkedin.com/in/raid-boulahdid-0752a0140/"><i class="fab fa-linkedin-in ml-3"></i></a>
                            <a href="https://github.com/raid21"><i class="fab fa-github ml-3"></i></a>
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