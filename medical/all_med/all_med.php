<?php

include("../../path.php");
include(ROOT_PATH . '/app/controllers/dr_send_mail.php');
include(ROOT_PATH . '/app/controllers/filterDom.php');
$user_det = selectOne('users', ['id' => $_SESSION['id']]);

$prev = $page - 1;
$next = $page + 1;

$num_pages = ceil($all / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors | Elite</title>
    <link rel="stylesheet" href="../../assets/css/fontawsome/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.main.css">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg act bg-light">
            <div class="container">

                <a class="navbar-brand text-uppercase" href="<?php echo BASE_URL . '/' ?>"><img src="../../assets/img/elite_logo.png" alt="">  el<span>i</span>te<small>21</small></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fal fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"> <a class="nav-link" href="<?php echo BASE_URL . '/' ?>">Home</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?php echo BASE_URL . '/index.php#about' ?>">about</a></li>
                        <li class="nav-item"> <a class="nav-link" href="../../activities/index.php">Blog</a></li>
                        <li class="nav-item"> <a class="nav-link" href="../index.php#team">team</a></li>
                        <li class="nav-item"> <a class="nav-link" href="../index.php##contact">contact</a></li>
                        <li class="nav-item"> <a class="nav-link active" href="../index.php">Specialties</a></li>

                    </ul>
                </div>
            </div>
    </nav>

    <div class="read-wrapper">
        <div class="container">
            <h2 class="font-weight-bold mb-0"><?php echo $page_title?></h2>

            <div class="all_dm_form">
                <form class="rounded mb-4 mt-2" action="all_med.php" method="post">
                    <div class="form-row justify-content-center">
                        <div class="form-group col-md-6">
                            <label for="inputSearch">Doctor/Pharmacy Name</label>
                            <input type="text" class="form-control" id="inputSearch" name="drPh_name" placeholder="Search ..." required>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="searchD">You're searching for</label>
                            <select id="searchD" class="form-control" name="drType">
                                <option value="chooseone" selcted>Choose one...</option>
                                <option value="dentists">Dentist</option>
                                <option value="pharmacies" >Pharmacy</option>
                                <option value="doctors" >Doctor</option>
                            </select>
                            <div>
                                <?php include(ROOT_PATH . "/app/helpers/messages.php") ?>
                            </div>
                        </div>
                                    
                        <button type="submit" name="search_dr_doms" class="btn all_dm_form_btn">Search</button>
                    </div>
                </form>
            </div>

            <div class="row justify-content-center sp-doctors">
                <?php if(count($all_med) > 0): ?>
                    <?php foreach($all_med as $key => $med): ?>

                        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                            <div class="card all">
                                    <div class="img_card">
                                        <img src="<?php echo BASE_URL . '/assets/img/' . $med['dr_img']?>" class="mt-3" alt="">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title text-center text-capitalize"><?php echo ucwords($med['drName']) ?></h4>
                                        <p class="card-text"><span><i class="fas fa-map-marker-alt"></i></span> <?php echo ucwords($med['drWilaya']) ?></p>
                                        <p class="card-text"><span><i class="fas fa-phone-office"></i></span> <?php echo "0" . $med['drPhone'] ?></p>
                                        <p class="card-text"><span><i class="fas fa-envelope-open"></i></span> <a data-toggle="collapse" href="#contact_dr<?php echo $key ?>">Ask him</a></p>

                                        <div id="contact_dr<?php echo $key ?>" class="panel-collapse collapse pl-3">
                                            <form class="usr_contact_dr p-2 pl-2 rounded" action="all_med.php" method="POST">

                                                <input type="hidden" name="dr_email" value="<?php echo $med['drEmail'] ?>">
                                                <div class="form-group">
                                                    <label for="usr_name">Your Full Name</label>
                                                    <input type="text" name="usr_name" class="form-control" id="usr_name" placeholder="Ex: John Doe" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="usr_email">Your Email</label>
                                                    <input type="email" name="usr_email" class="form-control" id="usr_email" placeholder="Enter Email" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="usr_qst">Your Question</label>
                                                    <textarea class="form-control" name="usr_msg" id="usr_qst" rows="3" placeholder="Your Question ..." required></textarea>
                                                </div>
                                                <button type="submit" name="usr_contact_dr" class="btn">Ask</button>

                                            </form>
                                        </div>

                                    </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php else: ?>

                    <?php if(isset($_SESSION['type'])): ?>  
                        <div class="mt-5" style="margin-bottom: 85px;"></div>

                    <?php else:?>
                        <h4 class="empty_f mt-5" style="margin-bottom: 85px;" >There is nothing maches your request.</h4>
                    <?php endif; ?>
                <?php endif; ?>

            </div>

            <?php if($check == 0): ?>
                <nav aria-label="Page navigation example" class="mt-lg-4">
                    <ul class="pagination justify-content-center mb-lg-0">

                        <?php if(isset($check_dr) && $check_dr == 1): ?>
                            <?php if($prev > 0): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo("all_med.php?sps_id=" . $sp . "&page="  . $prev) ?>"><i class="fal fa-chevron-double-left"></i></a>
                                </li>
                            <?php endif; ?>

                            <?php for($i=1; $i <= $num_pages; $i++): ?>
                                <li class="page-item"><a class="page-link" href="<?php echo("all_med.php?sps_id=" . $sp . "&page=" . $i) ?>"><?php echo $i; ?></a></li>
                            <?php endfor; ?>

                            <?php if($next <= $num_pages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo("all_med.php?sps_id=" . $sp . "&page="  . $next) ?>"><i class="fal fa-chevron-double-right"></i></a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                                <?php if($prev > 0): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo("all_med.php?t=" . $t. "&w=" . $drWilaya . "&page="  . $prev) ?>"><i class="fal fa-chevron-double-left"></i></a>
                                </li>
                            <?php endif; ?>

                            <?php for($i=1; $i <= $num_pages; $i++): ?>
                                <li class="page-item"><a class="page-link" href="<?php echo("all_med.php?t=" . $t. "&w=" . $drWilaya . "&page="  . $i) ?>"><?php echo $i; ?></a></li>
                            <?php endfor; ?>

                            <?php if($next <= $num_pages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo("all_med.php?t=" . $t. "&w=" . $drWilaya . "&page="  . $next) ?>"><i class="fal fa-chevron-double-right"></i></a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>

        </div>
    </div>
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
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/popper.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/script.main.js"></script>
</body>
</html>