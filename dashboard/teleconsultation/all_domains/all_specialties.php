<?php 
include("../../path.php");
include(ROOT_PATH . '/app/controllers/teleconsultation.php');
adminOnly();
$user_det = selectOne('users', ['id' => $_SESSION['id']]);
$users = selectAll('specialty');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Specialties | Elite</title>
    <link rel="stylesheet" href="../../assets/css/fontawsome/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../../assets/css/users.css">
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

                        <h4 class="text-center mb-3">All Specialties</h4>
                        <?php include(ROOT_PATH . "/app/helpers/messages.php") ?>
                        <table class="table shadow-lg rounded">
                            <thead>
                                <tr>
                                    <th scope="col">N</th>
                                    <th scope="col">Specialty Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($users)): ?>
                                    <?php foreach ($users as $key => $user):?>
                                        <tr>
                                            <th scope="row"><?php echo $key + 1 ?></th>
                                            <td><?php echo $user['specialtyname'] ?></td>
                                            <td><a href="<?php echo("createMedicalSp.php?sp_id=" . $user['id']) ?>" class="text-primary">Delete</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td>There is no specialty yet</td>
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

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/popper.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

        <script src="../../assets/js/script.main.js"></script>
</body>

</html>