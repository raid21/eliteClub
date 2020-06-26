<?php

include("../../path.php");
include(ROOT_PATH . '/app/controllers/teleconsultation.php');
$user_det = selectOne('users', ['id' => $_SESSION['id']]);
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
            <h2 class="font-weight-bold hd">All Doctors</h2>

            <div class="row justify-content-center sp-doctors">
                <div class="col-sm-12 p-3 ">
                    <div class="row justify-content-center">
                        
                        <?php foreach($all_med as $med): ?>
                            <div class="col-sm-6">
                                <div class="card doctor">
                                        <img src="<?php echo BASE_URL . '/assets/img/' . $med['dr_img']?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                        <h5 class="card-title">Dr. <span class="text-uppercase"><?php echo $med['drName'] ?></span></h5>
                                        <p class="card-text"><i class="fal fa-phone-alt"></i><?php echo $med['drPhone'] ?></p>
                                        <p class="card-text"><i class="fal fa-map-marker-alt"></i><?php echo $med['drWilaya'] ?></p>
                                        </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

            <nav aria-label="Page navigation example" class="mt-lg-4">
                <ul class="pagination justify-content-center mb-lg-0">

                    <li class="page-item">
                        <a class="page-link" href="index.php?page=<?php echo $prev ?>"><i class="fal fa-chevron-double-left"></i></a>
                    </li>

                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>

                    <li class="page-item">
                        <a class="page-link" href="index.php?page=<?php echo $next ?>"><i class="fal fa-chevron-double-right"></i></a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/popper.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/script.main.js"></script>
</body>
</html>