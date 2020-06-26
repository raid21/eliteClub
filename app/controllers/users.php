<?php 

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateUser.php");
include(ROOT_PATH . "/app/helpers/middleware.php");


$errors = array();
$username = '';
$id = '';
$email = '';
$admin = '';
$usersTable = 'users';
$super_admin = '';
 
function LoginUser($user)
{
    guestsOnly();
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['message'] = 'You are now logged in';
    $_SESSION['type'] = 'success';

    header('location: ' . BASE_URL . '/dashboard/profile.php');
    exit();
}

if(isset($_POST['add-usr']))
{
    adminOnly();
    $errors = validateUser($_POST);
    
    if(count($errors) === 0)
    {
        unset($_POST['add-usr'], $_POST['passwordConf']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $_POST['profile_pic'] = 'usr.png';
        $_POST['username'] = mysqli_real_escape_string($conn, $_POST['username']);
        $_POST['email'] = mysqli_real_escape_string($conn, $_POST['email']);

        $_POST['super_admin'] = isset($_POST['super_admin']) ? 1 : 0;

        if(isset($_POST['admin']))
        {
            $_POST['admin'] = 1;
            $user_id = create($usersTable, $_POST);
            $_SESSION['message'] = 'Admin user created successfully';
            $_SESSION['type'] = 'success';
            header('location: ' . BASE_URL . '/dashboard/users/');
            exit();
        }
        else{
            $_POST['admin'] = 0;
            $user_id = create($usersTable, $_POST);
            $_SESSION['message'] = 'User created successfully';
            $_SESSION['type'] = 'success';
            header('location: ' . BASE_URL . '/dashboard/users/');
            exit();
        }
    }
    else
    {
        $_SESSION['type'] = 'error';
    }
}

if(isset($_POST['login']))
{
    $errors = validateLogin($_POST);
    
    if (count($errors) === 0) {
        $user = selectOne($usersTable, ['username' => $_POST['username']]);
        if ($user && password_verify($_POST['password'], $user['password'])) 
        {
            // login the user
            LoginUser($user);
        }
        else
        {
            array_push($errors, "Wrong credetials");
            $_SESSION['type'] = 'error';
        }
    }
    {
        $_SESSION['type'] = 'error'; 
    }

}

if(isset($_GET['del_id']))
{
    adminOnly();
    $deleted = delete($usersTable, $_GET['del_id']);
    header('location: ' . BASE_URL . '/dashboard/users/');
    $_SESSION['message'] = 'User deleted successfully';
    $_SESSION['type'] = 'success';
    exit();
}

// update user
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $username = $_GET['usr'];
    $email = $_GET['admin'];
    $admin = $_GET['admin'] == 1 ? 1 : 0;
    $super_admin = $_GET['spr_ad'] == 1 ? 1 : 0;

}

if(isset($_POST['update-usr']))
{
    adminOnly();

    $id = $_POST['id'];
    unset($_POST['update-usr'], $_POST['id']);

    $_POST['admin'] = isset($_POST['admin']) ? 1 : 0;
    $_POST['super_admin'] = isset($_POST['super_admin']) ? 1 : 0;
    $user_id = update($usersTable, $id, $_POST);

    $_SESSION['message'] = 'User updated successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/dashboard/users/index.php');
    exit();
}

if(isset($_POST['update-usr-info']))
{
    usersOnly();
    $errors = validateUpdateUserInfo($_POST);

    if (!empty($_FILES['profile_pic']['name'])) {

        $img_name = time() . '_' . $_FILES['profile_pic']['name'];

        $destination = ROOT_PATH . '/assets/img/' . $img_name;

        $upload_result =  move_uploaded_file($_FILES['profile_pic']['tmp_name'], $destination);

        if ($upload_result) {
            $_POST['profile_pic'] = mysqli_real_escape_string($conn, $img_name);
        }else{
            array_push($errors, 'Failed to upload image');
        }
    }

    if(count($errors) === 0)
    {
        $id = $_POST['id'];
        unset($_POST['update-usr-info'],$_POST['id']);
        
        $user_id = update($usersTable, $id, $_POST);

        $_SESSION['message'] = 'Your details has been updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/dashboard/profile.php');
        exit();
    }
    else
    {
        $_SESSION['type'] = 'error';
    }
}

if(isset($_POST['update-usr-psw']))
{
    $check_usr_psw = selectOne($usersTable, ['id' => $_POST['id']]);

    if (password_verify($_POST['old_psw'], $check_usr_psw['password'])) 
    {
        $id = $_POST['id'];
        unset($_POST['update-usr-psw'], $_POST['old_psw'], $_POST['id']);

        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user_id = update($usersTable, $id, $_POST);
        $_SESSION['message'] = 'Password updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/dashboard/profile.php');
        exit();
        
    }
    else
    {
        array_push($errors, "Wrong credentials");
        $_SESSION['type'] = 'error';
    }
    
}

$user_det = selectOne('users', ['id' => $_SESSION['id']]);

?>