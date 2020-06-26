<?php 
include("../../path.php");
include(ROOT_PATH . '/app/controllers/events.php');
adminOnly();
$user_det = selectOne('users', ['id' => $_SESSION['id']]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event | Elite</title>
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

                        <h4 class="text-center">Edit Event</h4>

                        <?php include(ROOT_PATH . "/app/helpers/messages.php") ?>

                        <form action="editEvent.php" method="POST" enctype="multipart/form-data" class="mb-5">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="form-group">
                                <label for="event_title">Event Title</label>
                                <input type="text" class="form-control" name="event_title" value="<?php echo $title; ?>" placeholder="Enter title" id="event_title">
                            </div>

                            <div class="form-group">
                                <label for="event_desc">Event Details</label>
                                <textarea class="form-control" id="event_desc" name="event_desc" rows="3"><?php echo $event_desc ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="event_img">Select image</label>
                                <small> (If you don't want to update event image leave this field empty )</small>
                                <input type="file" class="form-control-file" name="event_img" id="event_img">
                            </div>

                            <div class="form-group">
                                <label for="event_video">Event video url</label>
                                <small> (If you're not updating or adding new video url leave this field empty )</small>
                                <textarea class="form-control" id="event_video" name="event_video" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="event_date">Event Date</label>
                                <input type="text" class="form-control" value="<?php echo $event_date ?>" name="event_date" placeholder="Ex: june 7, 2020" id="event_date">
                            </div>

                            <div class="form-group">
                                <label for="event_time">Event Time</label>
                                <input type="text" class="form-control" value="<?php echo $event_time ?>" name="event_time" placeholder="Ex: 7:00 AM" id="event_time">
                            </div>

                            <button type="submit" name="update-event" class="btn btn-primary">Submit</button>

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