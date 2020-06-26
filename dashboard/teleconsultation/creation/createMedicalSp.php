<?php 
include("../../../path.php");
include(ROOT_PATH . "/app/controllers/teleconsultation.php");
adminOnly();
$user_det = selectOne('users', ['id' => $_SESSION['id']]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Specialty | Elite</title>
    <link rel="stylesheet" href="../../../assets/css/fontawsome/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../../../assets/css/users.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include(ROOT_PATH . '/app/includes/sidebar.php'); ?>

        <!-- Page Content  -->
        <div id="content">

        <?php include(ROOT_PATH . '/app/includes/main_nav.php') ?>

            <div class="container">
                <div class="row">
                    <div class="col-sm-12 p-sm-1 p-lg-5 create shadow-lg rounded">

                        <h4 class="text-center">Create Specialty</h4>

                        <?php require(ROOT_PATH . '/app/helpers/messages.php') ?>

                        <div class="form-group"><small>All fileds with * are required</small></div>
                        <form action="createMedicalSp.php" method="POST" enctype="multipart/form-data">
                        
                            <div class="form-group">
                                <label for="specialtyname">Specialty Name *</label>
                                <input type="text" class="form-control" name="specialtyname" placeholder="Specialty Name"
                                    id="specialtyname" required>
                            </div>

                            <div class="form-group">
                                <label for="sp_img">Specialty image</label>
                                <input type="file" class="form-control-file" name="sp_img" id="sp_img">
                            </div>
                            
                            <button type="submit" name="add-sp" class="btn btn-primary">Create</button>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="overlay"></div>

    <script src="../../../assets/js/jquery.min.js"></script>
    <script src="../../../assets/js/popper.js"></script>
    <script src="../../../assets/js/bootstrap.min.js"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

        <script src="../../../assets/js/script.main.js"></script>
</body>

</html>