<?php 
include("../../../path.php");
include(ROOT_PATH . '/app/controllers/teleconsultation.php');
adminOnly();
$user_det = selectOne('users', ['id' => $_SESSION['id']]);
$all_pharms = selectAll('pharmacies');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Pharmacies | Elite</title>
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
                    <div class="col-sm-12 p-sm-1 p-lg-5 create">

                        <h4 class="text-center mb-3">All Pharmacies</h4>
                        <?php include(ROOT_PATH . "/app/helpers/messages.php") ?>
                        <table class="table shadow-lg rounded">
                            <thead>
                                <tr>
                                    <th scope="col">N</th>
                                    <th scope="col">Pharmacies Name</th>
                                    <th colspan="2" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($all_pharms)): ?>
                                    <?php foreach ($all_pharms as $key => $pharm):?>
                                        <tr>
                                            <th scope="row"><?php echo $key + 1 ?></th>
                                            <td><?php echo $pharm['drName'] ?></td>
                                            <td><a href="<?php echo(BASE_URL . "/dashboard/teleconsultation/edit_domains/edit_pharm.php?edt_pharm_id=" . $pharm['id']) ?>" class="text-primary">Edit</a></td>
                                            <td><a href="<?php echo(BASE_URL . "/dashboard/teleconsultation/all_domains/all_pharm.php?del_pharm_id=" . $pharm['id']) ?>" class="text-danger">Delete</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td>There is no any pharmacy yet</td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>

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