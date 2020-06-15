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
    <title>Create User | Elite</title>
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

                        <h4 class="text-center">Create User</h4>
                        

                        <?php include(ROOT_PATH . '/app/helpers/messages.php'); ?>

                        <form action="create.php" method="POST">
                            <div class="form-group"><small>All fileds with * are required</small></div>

                            <div class="form-group">
                                <label for="username">Username *</label>
                                <input type="text" class="form-control" name="username" placeholder="Username"
                                    id="username">
                            </div>

                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" id="email">
                            </div>

                            <div class="form-group">
                                <label for="password">Password *</label>
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    id="usr-password">
                            </div>

                            <div class="form-group">
                                <label for="password">Confirm Password *</label>
                                <input type="password" class="form-control" name="passwordConf" placeholder="Password"
                                    id="usr-password">
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" name="admin"> Admin</label>
                                </div>
                            </div>

                            <button type="submit" name="add-usr" class="btn btn-primary">Submit</button>

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