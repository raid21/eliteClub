<?php 
include("path.php"); 
require(ROOT_PATH . "/app/controllers/users.php");
guestsOnly();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Elite</title>
    <link rel="stylesheet" href="assets/css/fontawsome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

    <div class="container">
        
        <div class="row shadow justify-content-center inf">
            <div class="col-sm-6 login-section p-4 order-2">

                <h2 class="text-center mb-4"><span>Login</span></h2>
                <?php include(ROOT_PATH . "/app/helpers/messages.php") ?>

                <form class="login-form p-2 rounded" action="login.php" method="POST">

                    <div class="form-group">
                      <label for="username">Username</label>

                      <?php if(isset($_COOKIE['user_login'])): ?>
                        <input type="text" name="username" class="form-control" id="username" value="<?php echo $_COOKIE['user_login']; ?>"                                          placeholder="Ex: John Doe" required>
                      <?php else: ?>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Ex: John Doe" required>
                      <?php endif; ?>
                        
                    </div>


                    <div class="form-group" style="position: relative;">
                      <label for="password">Password</label>

                      <?php if(isset($_COOKIE['user_password'])): ?>
                        <i class="fas fa-eye" id="password_toggler" onclick='password_toggle()' style="position: absolute; top: 48px; right: 10px; font-size: 20px;"></i>
                        <input type="password" name="password" class="form-control" id="password" value="<?php echo $_COOKIE['user_password']; ?>" placeholder="Your Password" required>
                      <?php else: ?>
                        <i class="fas fa-eye" id="password_toggler" onclick='password_toggle()' style="position: absolute; top: 48px; right: 10px; font-size: 20px;"></i>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Your Password" required>
                      <?php endif; ?>

                    </div>

                    <div class="form-group mt-4">
                        <label class="check_box_container">Remmember Me
                            <input type="checkbox" name="keep-logged">
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <button type="submit" name="login" class="btn">Login</button>

                </form>

                <div class="mt-4 text-center">
                  <a href="#" data-toggle="modal" data-target="#recover_psw_modal" style="color: #fff; font-size: 20px">Forgot your password!</a>
                </div>

            </div>

            <div class="col-sm-6 p-5 order-1 intro_txt">
              <div class="row">

                <div class="col-sm-12">
                  <h2 class="login-title text-center mb-0">BE THE BEST BE</h2>
                  <h2 class="login-title text-center mb-4"><span>THE ELITE</span></h2>
                </div>

                <div class="col-sm-12">
                  <img src="assets/img/elite_logo.png" class="d-block mx-auto" alt="elite_logo">
                </div>

              </div>
          </div>
        </div>

        <div class="row copy_sec">
          <div class="col-sm-12 p-4 shadow copyright">
            <p class="m-0 text-center">Copyright &copy; <strong><span>Elite</span></strong>. All Rights Reserved</p>
          </div>
        </div>
    </div>

    <!-- start of modal -->
    <div class="modal fade" id="recover_psw_modal" tabindex="-1" role="dialog" aria-labelledby="recover_psw_modal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <form class="login-form p-2 rounded" action="login.php" method="POST">

              <div class="form-group">
                <label for="email">Enter your email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Ex: ex@example.com" required>              
              </div>
              
              <button type="submit" name="recover_psw" value="recover_psw" class="btn">Recover</button>

            </form>
          </div>

        </div>
      </div>
    </div>
    <!-- modal -->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script>
      function password_toggle() {
        var x = document.getElementById("password");
        var y = document.getElementById("password_toggler");
        if (x.type === "password") {
          x.type = "text";
          y.className = 'fas fa-eye-slash';
        } else {
          x.type = "password";
          y.className = 'fas fa-eye';
        }
      }
    </script>
</body>
</html>