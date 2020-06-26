<?php 
include("../path.php");
include(ROOT_PATH . '/app/controllers/teleconsultation.php');
//include(ROOT_PATH . '/app/controllers/users.php');
$user_det = selectOne('users', ['id' => $_SESSION['id']]);
$all_sps = selectAll('specialty');
$i = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Specialties</title>
    <link rel="stylesheet" href="../assets/css/fontawsome/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.main.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg act bg-light">
        <div class="container">

            <a class="navbar-brand text-uppercase" href="../index.php"><img src="../assets/img/elite_logo.png" alt="">  el<span>i</span>te<small>21</small></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fal fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"> <a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../index.php#about">about</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../activities/index.php">Blog</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../index.php#team">team</a></li>
                    <li class="nav-item"> <a class="nav-link" href="../index.php##contact">contact</a></li>
                    <li class="nav-item"> <a class="nav-link active" href="index.php">Specialties</a></li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="slider">
        <div id="mainSlider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner text-uppercase">
                <div class="overlay"></div>
                <div class="carousel-item carousel-one active"></div>
                <div class="carousel-item carousel-two"></div>
            </div>
            <ol class="carousel-indicators">
                <li data-target="#mainSlider" data-slide-to="0" class="active"></li>
                <li data-target="#mainSlider" data-slide-to="1"></li>
            </ol>
        </div>
    </div>
    
    <div class="med-wrapper">
        <div class="container">
            <h2 class="font-weight-bold text-center">All Medical Domains</h2>
            <div class="row justify-content-center">
                
                <div class="domain col-sm-12 col-md-4">
                    <i class="fal fa-user-md fa-3x rounded-circle"></i>
                    <h3><a href="#" data-toggle="modal" data-target="#sptlModal">Doctors</a></h3>
                </div>

                <div class="domain col-sm-12 col-md-4">
                    <i class="fal fa-tooth fa-3x rounded-circle"></i>
                    <h3><a href="#" data-toggle="modal" data-target="#stateModal">Dentists</a></h3>
                </div>

                <div class="domain col-sm-12 col-md-4">
                    <i class="fal fa-capsules fa-3x rounded-circle"></i>
                    <h3><a href="#" data-toggle="modal" data-target="#stateModal">Pharmacies</a></h3>
                </div>


            </div>
            <!-- dentists & pharmacies modal -->
            <div class="modal fade" id="stateModal" tabindex="-1" role="dialog" aria-labelledby="stateModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action="#" method="post">
                                <div class="form-group">
                                    <label for="inputDomain">You're searching for</label>
                                    <select id="inputDomain" class="form-control selectpicker" name="inputDomain">
                                        <option selcted>Choose one...</option>
                                        <option>Dentists</option>
                                        <option>Pharmacies</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="drInWilaya">Choose City</label>
                                    <input type="text" class="form-control" name="drInWilaya" id="drInWilaya" placeholder="Ex: skikda">
                                </div>

                                <button type="submit" name="add-sp" class="btn modal-btn">Search</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end of modal -->

            <!-- doctors modal -->
            <div class="modal fade" id="sptlModal" tabindex="-1" role="dialog" aria-labelledby="sptlModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="two modal-body">
                            <div class="row">
                                
                                <?php foreach($all_sps as $sps): ?>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="card">
                                            <img src="<?php echo BASE_URL . '/assets/img/' . $sps['sp_img'] ?>"  alt="">
                                            <div class="card-body">
                                                <p class="text-center mt-2 mb-0"><a href="<?php echo BASE_URL . '/medical/all_med/all_med.php?sps_id=' . $sps['id'] ?>"><?php echo $sps['specialtyname'] ?></a></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- modal -->
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

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="../assets/js/script.main.js"></script>
</body>
</html>