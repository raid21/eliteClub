<?php 
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validatePosts.php");
include(ROOT_PATH . "/app/helpers/middleware.php");

$events_table = 'events';

$id = '';
$title = '';
$event_desc = '';
$event_date = '';
$event_time = '';

$errors = array();

function reArrayFiles($file_post)
{
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++)
    {
        foreach($file_keys as $key)
        {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
}


// update posts
if(isset($_GET['edit_event_id']))
{
    $post_ele = selectOne($events_table, ['id' => $_GET['edit_event_id']]);
    $id = $post_ele['id'];
    $title = $post_ele['event_title'];
    $event_desc = $post_ele['event_desc'];
    $event_date = $post_ele['event_date'];
    $event_time = $post_ele['event_time'];
}

// delete posts
if(isset($_GET['del_event_id']))
{
    adminOnly();
    $deleted = delete($events_table, $_GET['del_event_id']);
    $_SESSION['message'] = 'Event deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/dashboard/profile.php');
    exit();
}

if(isset($_POST['create-event']))
{
    adminOnly();
    $errors = validateEvent($_POST);

    // uploading post image
    if (!empty($_FILES['event_img']['name'])) {        
        
        $img_name = time() . '_' . $_FILES['event_img']['name'];
        
        $destination = ROOT_PATH . '/assets/img/' . $img_name;

        $upload_result =  move_uploaded_file($_FILES['event_img']['tmp_name'], $destination);
        
        if ($upload_result) {
            $_POST['event_img'] = mysqli_real_escape_string($conn, $img_name);
        }else{
            array_push($errors, 'Failed to upload image');
        }
    }
    else{
        array_push($errors, 'Post image is required');
    }

    if(count($errors) === 0 )
    {
        unset($_POST['create-event']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['event_desc'] = mysqli_real_escape_string($conn, htmlentities($_POST['event_desc']));
        $_POST['event_title'] = mysqli_real_escape_string($conn, $_POST['event_title']);
        $_POST['event_date'] = mysqli_real_escape_string($conn, $_POST['event_date']);
        $_POST['event_time'] = mysqli_real_escape_string($conn, $_POST['event_time']);

        if(!empty($_POST['event_video']))
        {
            $_POST['event_video'] = mysqli_real_escape_string($conn, htmlentities($_POST['event_video']));
        }
        else
        {
            unset($_POST['event_video']);
        }

        $post_id = create($events_table, $_POST);
        
        $_SESSION['message'] = 'Activity created successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/dashboard/profile.php');
        exit();
    }
    else
    {
        $_SESSION['type'] = 'error';
        $title = $_POST['event_title'];
        $event_desc = $_POST['event_desc'];
    }
}

if(isset($_POST['update-event']))
{
    adminOnly();
    $errors = validateEvent($_POST);

    // if (!empty($_FILES['event_img']['name'])) {        
        
    //     $img_name = time() . '_' . $_FILES['event_img']['name'];
        
    //     $destination = ROOT_PATH . '/assets/img/' . $img_name;

    //     $upload_result =  move_uploaded_file($_FILES['event_img']['tmp_name'], $destination);
        
    //     if ($upload_result) {
    //         $_POST['event_img'] = mysqli_real_escape_string($conn, $img_name);
    //     }else{
    //         array_push($errors, 'Failed to upload image');
    //     }
    // }

    if (count($_FILES['event_imgs']['name']) > 0) {
        $all_img_files = reArrayFiles($_FILES['event_imgs']);
        $uploaded_files = array();

        foreach ($all_img_files as $file) {
            $img_name = "ELITE_ASSOCIATION_" . time() . '_' . $file['name'];
                
            $destination = ROOT_PATH . '/assets/img/' . $img_name;
        
            $upload_result =  move_uploaded_file($file['tmp_name'], $destination);
                
            if ($upload_result) {
                array_push($uploaded_files, $img_name);
            } else {
                echo('error');
            }
        }
        $_POST['event_imgs'] = htmlentities(json_encode($uploaded_files));
    }

    if(count($errors) === 0 )
    {
        $id = $_POST['id'];
        unset($_POST['update-event'], $_POST['id']);
        $_POST['event_desc'] = mysqli_real_escape_string($conn, htmlentities($_POST['event_desc']));
        $_POST['event_title'] = mysqli_real_escape_string($conn, $_POST['event_title']);
        $_POST['event_date'] = mysqli_real_escape_string($conn, $_POST['event_date']);
        $_POST['event_time'] = mysqli_real_escape_string($conn, $_POST['event_time']);

        if(!empty($_POST['event_video']))
        {
            $_POST['event_video'] = mysqli_real_escape_string($conn, htmlentities($_POST['event_video']));
        }
        else
        {
            unset($_POST['event_video']);
        }
        $post_id = update($events_table, $id, $_POST);
        $_SESSION['message'] = 'Event updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/dashboard/profile.php');
        exit();
    }
    else
    {
        $_SESSION['type'] = 'error';
        $title = $_POST['event_title'];
        $event_desc = $_POST['event_desc'];
    }
}

?>