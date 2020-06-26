<?php 
include("../../path.php");
include(ROOT_PATH . '/app/controllers/posts.php');
usersOnly();
$user_det = selectOne('users', ['id' => $_SESSION['id']]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post | Elite</title>
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
                <div class="row mb-5">
                    <div class="col-sm-12 p-sm-1 p-lg-5 create shadow-lg rounded">

                        <h4 class="text-center">Edit Post</h4>

                        <?php include(ROOT_PATH . "/app/helpers/messages.php") ?>

                        <form action="edit.php" method="POST" enctype="multipart/form-data" class="mb-5">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="form-group">
                                <label for="act_title">Activity Title</label>
                                <input type="text" class="form-control" name="act_title" value="<?php echo $title; ?>" placeholder="Enter title" id="act_title">
                            </div>

                            <div class="form-group">
                                <label for="act_desc">Activity Details</label>
                                <textarea class="form-control" id="act_desc" name="act_desc" rows="3"><?php echo $act_desc ?></textarea>
                            </div>

                            <button type="submit" name="update-act" class="btn btn-primary">Submit</button>

                        </form>
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