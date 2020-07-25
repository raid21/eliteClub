<?php 
include("path.php"); 
include(ROOT_PATH . "/app/database/db.php");
$errors = array();
$usr_id = '';

if(isset($_GET['ui']) && isset($_GET['to']))
{
    $usr_id = mysqli_real_escape_string($conn, $_GET['ui']);
    $_SESSION['token'] = mysqli_real_escape_string($conn, $_GET['to']);
}

if(isset($_POST['change_psw']))
{
    if($_POST['password'] !== $_POST['c_password'])
    {
        array_push($errors, "Passwords doesn't mach");
    }
    
    if (count($errors) === 0)
    {
        $_POST['password'] = mysqli_real_escape_string($conn, $_POST['password']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $usr_id = $_POST['id'];

        unset($_POST['c_password'], $_POST['change_psw'], $_POST['id']);
        $record = selectOne('password_reset', ['token' => $_SESSION['token']]);

        if($record)
        {
            if($record['verified'] == 0)
            {
                update('users', $usr_id, $_POST);
                $_SESSION['message'] = 'Your password has been changed';
                $_SESSION['type'] = 'success';

                unset($_POST['password']);
                $rq_id = $record['id'];

                $_POST['verified'] = 1;  
                update('password_reset', $rq_id, $_POST);

                header('location: ' . BASE_URL . '/login.php');
                exit();
            }
            else
            {
                array_push($errors, "Sorry, this link is expired");
                $_SESSION['type'] = 'error';
            }
        }
        else
        {
            array_push($errors, "Sorry, we couldn't verify you, try again from the beginnig");
            $_SESSION['type'] = 'error';
        }
    }
    else
    {
        $_SESSION['type'] = 'error';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body{background: #ddd;}
        .reset_psw{margin-top: 100px;}
        .reset_psw h2{color: #08526d;}
        .reset_psw label{color: #08526d;}
        .reset_psw form button{background: #08526d; color: #fff; width: 100%; text-align: center; border: none;}
        .reset_psw form button:hover{background: #fdc134; color: #fff; transition: 1s;}
        .msg {
            width: 85%;
            margin: 5px auto;
            padding: 8px;
            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            -ms-border-radius: 5px;
            -o-border-radius: 5px;
            list-style: none;
        }

        .msg.success {
            color: #3a6e3a;
            border: none;
            background: #bcf5bc;
        }

        .msg.error {
            color: #884b4b;
            border: none;
            background: #f5bcbc;
        }

    </style>
</head>
<body>

    <div class="reset_psw">
        <div class="container">

            <div class="row justify-content-center px-2">
                <div class="col-sm-8 p-4 shadow" style="background: #fff;">
                    <h2 class="text-center">Reset Password</h2>

                    <?php include(ROOT_PATH . "/app/helpers/messages.php") ?>

                    <form action="reset_psw.php" method="POST" class="mt-3">

                        <input type="hidden" name="id" value="<?php echo $usr_id ?>">

                        <div class="form-group">
                            <label for="password">New password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Your new password" required>
                        </div>

                        <div class="form-group">
                            <label for="c_password">Confirm password</label>
                            <input type="password" name="c_password" class="form-control" id="c_password" placeholder="" required>
                        </div>

                        <button type="submit" name="change_psw" value="new_psw" class="btn">Reset password</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    
    

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>