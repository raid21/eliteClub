<?php 
include("path.php");
include(ROOT_PATH . "/app/controllers/users.php");
guestsOnly();
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/fontawsome/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/blog.main.css">
</head>

<body>
    <!-- inculde menu bar -->
    <?php include(ROOT_PATH . "/app/includes/header.php") ?>

    <!-- start of form -->
    <div class="auth-content">
        
        <form action="login.php" method="post">
            <h2 class="form-title">Login</h2>

            <?php include(ROOT_PATH . "/app/helpers/formErrors.php") ?>

            <div>
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>"  class="text-input">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" value="<?php echo $password; ?>"  class="text-input">
            </div>
            <div>
                <button type="submit" name="login-btn" class="btn btn-big">Login</button>
            </div>

        </form>
    </div>
    <!-- end of form -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>