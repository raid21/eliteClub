<?php 
    include("../../../path.php");
    include(ROOT_PATH . "/app/controllers/teleconsultation.php");
    adminOnly();
    $user_det = selectOne('users', ['id' => $_SESSION['id']]);
    $all_sps = selectAll('specialty');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit doctor | Elite</title>
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

                        <h4 class="text-center">Edit Doctor</h4>

                        <?php require(ROOT_PATH . '/app/helpers/messages.php') ?>

                        <div class="form-group"><small>Change the field that you want and let the others as they are</small></div>
                        <form action="edit_dr.php" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="id" value="<?php echo $dr_id; ?>">

                            <div class="form-group">
                                <label for="drName">Dr Name</label>
                                <input type="text" class="form-control" name="drName" value="<?php echo $dr_name ?>" placeholder="Doctor Name"
                                    id="drName" required>
                            </div>

                            <div class="form-group">
                                <label for="drEmail">Dr Email</label>
                                <input type="text" class="form-control" name="drEmail" value="<?php echo $dr_email ?>" placeholder="Doctor Email"
                                    id="drEmail" required>
                            </div>

                            <div class="form-group">
                                <label for="drPhone">Dr Phone</label>
                                <input type="tel" class="form-control" name="drPhone" value="<?php echo $dr_phone ?>" placeholder="Doctor Phone"
                                    id="drPhone" required>
                            </div>

                            <div class="form-group">
                                <label for="drWilaya">Dr City <small>(wilaya) </small></label>
                                <input type="text" class="form-control" name="drWilaya" value="<?php echo $dr_wilaya ?>" placeholder="Doctor City"
                                    id="drWilaya" required>
                            </div>

                            <div class="form-group">
                                <label for="dr_img">Dr image </label>
                                <small>(if you don't want to change doctor's photo leave this field empty)</small>
                                <input type="file" class="form-control-file" name="dr_img" id="dr_img">
                            </div>

                            <div class="form-group">
                                <label for="drSp">Dr Specialty</label> <small>(leave this field empty if you are adding a dentist or pharmacy)</small>
                                <select id="drSp" class="form-control" name="drSp">
                                    <option value="chooseone">Choose One ...</option>


                                    <?php foreach($all_sps as $sps): ?>

                                        <?php if(!empty($drSp) && ($drSp == $sps['id'])): ?>

                                            <option selected value="<?php echo $sps['id']; ?>"><?php echo $sps['specialtyname']; ?></option>

                                        <?php else: ?>

                                            <option value="<?php echo $sps['id']; ?>"><?php echo $sps['specialtyname']; ?></option>

                                        <?php endif; ?>

                                    <?php endforeach; ?>
                                    
                                </select>
                            </div>
                            
                            <button type="submit" name="update-dr" class="btn btn-primary">Update</button>

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