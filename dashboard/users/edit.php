<?php 
include("../../path.php");
include(ROOT_PATH . "/app/controllers/users.php");
adminOnly();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User | Elite</title>
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
                    <div class="col-sm-12 p-sm-1 p-lg-5 create shadow-lg rounded">

                        <h4 class="text-center">Edit User</h4>

                        <?php include(ROOT_PATH . '/app/includes/messages.php') ?>

                        <div class="form-group"><small>All fileds with * are required</small></div>
                        <form action="edit.php" method="POST">
                            
                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                            <div class="form-group">
                                <label for="username">Username *</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $username ?>" placeholder="Username"
                                    id="username" readonly>
                            </div>

                            <div class="form-group">
                                <?php if(isset($admin) && $admin == 1): ?>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="admin" checked> Admin *</label>
                                    </div>
                                <?php else: ?>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="admin"> Admin</label>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <button type="submit" name="update-usr" class="btn btn-primary">Submit</button>

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

    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
</body>

</html>