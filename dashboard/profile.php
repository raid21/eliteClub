<?php 
include("../path.php");
include(ROOT_PATH . '/app/controllers/users.php');
if(!isset($_SESSION['id']))
{
    usersOnly();
}
// $usr_posts = getUserPosts($_SESSION['id']);
$usr_posts = selectAll('activities', ['user_id' => $_SESSION['id']]);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $user_det['username'] ?> | Elite</title>

    <link rel="stylesheet" href="../assets/css/fontawsome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/users.css">
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

            <?php include(ROOT_PATH . "/app/includes/main_nav.php") ?>

            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-4">

                        <?php include(ROOT_PATH . "/app/helpers/messages.php") ?>
                        <div class="usr-details py-4 mb-4 rounded shadow-lg">
                            <img src="<?php echo BASE_URL . '/assets/img/' . $user_det['profile_pic'] ?>" class="img-fluid rounded-circle mx-auto d-block mb-2" alt="">
                            <h4 class="text-center text-capitalize mb-3"><?php echo $user_det['username'] ?></h4>

                            <div class="per-inf px-4">
                                <h5>Personal Info</h5>
                                <div class="info-box">

                                    <p><i class="fal fa-envelope"></i> Email: <span><?php echo $user_det['email'] ?></span></p>

                                    <?php if(!empty($user_det['user_tel'])): ?>
                                        <p><i class="fal fa-phone-volume"></i> Phone number: <span><?php echo ('0'. $user_det['user_tel']) ?></span></p>
                                    <?php endif; ?>

                                </div>
                            </div>

                        </div>

                        <div class="setting py-4 mb-4 rounded shadow-lg">
                            <h4 class="text-center mb-3"><i class="fal fa-cog"></i> General Settings</h4>

                            <form action="profile.php" method="POST" enctype="multipart/form-data" class="px-4">
                                <input type="hidden" name="id" value="<?php echo $user_det['id']; ?>">
                                <div class="form-group">
                                    <label for="email">Update Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter new email"
                                        id="email">
                                </div>
                                <div class="form-group">
                                    <label for="usrname">Update Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Enter username"
                                        id="usrname">
                                </div>
                                <div class="form-group">
                                    <label for="phonenumber">Update phone number</label>
                                    <input type="tel" class="form-control" name="user_tel"
                                        placeholder="Enter phone number" id="phonenumber">
                                </div>

                                <div class="form-group">
                                    <label for="postImage">Update profile image</label>
                                    <input type="file" class="form-control-file" name="profile_pic" id="postImage">
                                </div>
                                <button type="submit" class="btn btn-primary" name="update-usr-info">Submit</button>
                            </form>

                        </div>

                    </div>
                    <div class="col-sm-12 col-lg-8 posts">
                        <h4 class="posts-head mb-3">My Posts</h4>

                        <?php if(empty($usr_posts)): ?>
                            <?php echo("<p>You don't have any post yet.</p>") ?>
                        <?php else: ?>
                            <?php foreach($usr_posts as $usr_post): ?>
                                <div class="post shadow-lg mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="options d-flex justify-content-around">
                                                <a href="<?php echo("posts/edit.php?del_id=" . $usr_post['id']) ?>" class="delete"><i class="fal fa-trash"></i> Delete this post</a>
                                                <a href="<?php echo("posts/edit.php?edit_id=" . $usr_post['id']) ?>" class="edit"><i class="fal fa-edit"></i> Edit this post</a>
                                            </div>
                                            <p class="card-title mt-4 mb-1 text-primary font-weight-bold text-uppercase"><?php echo $usr_post['act_title'] ?></p>
                                            <p class="card-text mb-1"><?php echo $usr_post['act_desc'] ?></p>
                                            <p class="card-text"><?php echo($usr_post['act_date'] . ' at: ' . $usr_post['act_time'] . '.') ?></p>
                                        </div>
                                        <img class="card-img-bottom img-fluid" src="<?php echo BASE_URL . '/assets/img/' . $usr_post['act_img'] ?>" alt="Card image">
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        <?php endif; ?>

                        
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="overlay"></div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
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