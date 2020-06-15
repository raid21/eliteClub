<?php 
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validatePosts.php");
include(ROOT_PATH . "/app/helpers/middleware.php");

$posts_table = 'activities';


$id = '';
$title = '';
$act_desc = '';
$act_date = '';
$act_time = '';
$act_img = '';

$errors = array();

// update posts
if(isset($_GET['edit_id']))
{
    $post_ele = selectOne($posts_table, ['id' => $_GET['edit_id']]);
    $id = $post_ele['id'];
    $title = $post_ele['act_title'];
    $act_desc = $post_ele['act_desc'];
    $act_date = $post_ele['act_date'];
    $act_time = $post_ele['act_time'];
    $act_img = $post_ele['act_img'];
}

// delete posts
if(isset($_GET['del_id']))
{
    usersOnly();
    $deleted = delete($posts_table, $_GET['del_id']);
    $_SESSION['message'] = 'Post deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/dashboard/profile.php');
    exit();
}

if(isset($_POST['create-act']))
{
    usersOnly();
    $errors = validatePosts($_POST);

    // uploading post image
    if (!empty($_FILES['act_img']['name'])) {        
        
        $img_name = time() . '_' . $_FILES['act_img']['name'];
        
        $destination = ROOT_PATH . '/assets/img/' . $img_name;

        $upload_result =  move_uploaded_file($_FILES['act_img']['tmp_name'], $destination);
        
        if ($upload_result) {
            $_POST['act_img'] = $img_name;
        }else{
            array_push($errors, 'Failed to upload image');
        }
    }
    else{
        array_push($errors, 'Post image is required');
    }
    // end of uploading post image

    if(count($errors) === 0 )
    {
        unset($_POST['create-act']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['act_desc'] = htmlentities($_POST['act_desc']);

        $post_id = create($posts_table, $_POST);
        
        $_SESSION['message'] = 'Activity created successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/dashboard/profile.php');
        exit();
    }
    else
    {
        $title = $_POST['act_title'];
        $act_desc = $_POST['act_desc'];
    }
}

if(isset($_POST['update-act']))
{
    usersOnly();
    $errors = validatePosts($_POST);

    if(count($errors) === 0 )
    {
        $id = $_POST['id'];
        unset($_POST['update-act'], $_POST['id']);
        $_POST['act_desc'] = htmlentities($_POST['act_desc']);
        $post_id = update($posts_table, $id, $_POST);
        $_SESSION['message'] = 'Post updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/dashboard/profile.php');
        exit();
    }
    else
    {
        $_SESSION['type'] = 'error';
        $title = $_POST['act_title'];
        $act_desc = $_POST['act_desc'];
    }
}

?>