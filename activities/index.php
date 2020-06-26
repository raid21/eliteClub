<?php 
include("../path.php");
include(ROOT_PATH . '/app/controllers/users.php');

$postsTitle = 'Blog';
$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;



if(isset($_POST['search-term']))
{
    $search_term = $_POST['search-term'];
    $postsTitle = "You searched for: '" . $_POST['search-term'] . "'";
    $all_acts = searchActivitiesPosts($_POST['search-term'], $start, $limit);
    $all = count($all_acts);
}
else
{
    $result = $conn->query("SELECT * FROM activities LIMIT $start, $limit");
    $all_acts = $result->fetch_all(MYSQLI_ASSOC);
    $all = count(selectAll('activities'));

}

$first_arr = array();
$second_arr = array();
$third_arr = array();

$prev = $page - 1;
$next = $page + 1;

$num_pages = ceil($all / $limit);

for($i=0; $i < count($all_acts); $i++)
{
    if($i==0)
    {
        array_push($first_arr, $all_acts[$i]);
    }
    if($i>=1 && $i<=2)
    {
        array_push($second_arr, $all_acts[$i]);
    }
    if($i>=3 && $i<=4)
    {
        array_push($third_arr, $all_acts[$i]);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog | Elite</title>
    <link rel="stylesheet" href="../assets/css/fontawsome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.main.css">
</head>

<body>

    <!-- start of navbar -->
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg" data-aos="fade-left" data-aos-duration="2000">

                <a class="navbar-brand text-uppercase" href="../index.php"><img src="../assets/img/elite_logo.png" alt="">  el<span>i</span>te<small>21</small></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fal fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"> <a class="nav-link" href="../index.php">Home</a></li>
                        <li class="nav-item"> <a class="nav-link" href="../index.php#about">about</a></li>
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Blog</a></li>
                        <li class="nav-item"> <a class="nav-link" href="../index.php#team">team</a></li>
                        <li class="nav-item"> <a class="nav-link" href="../index.php##contact">contact</a></li>

                        <?php include(ROOT_PATH . "/app/includes/login_nav.php") ?>
                        
                    </ul>
                </div>
            </nav>

            <?php if(empty($_SESSION['type'])): ?>
                <div class="hero-search">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-8">
                            <form class="hero-search-dark rounded" action="index.php" method="post">
                                <div class="form-group">
                                    <label for="inputSearch">Search</label>
                                    <input type="text" class="form-control" id="inputSearch" name="search-term" placeholder="Search ...">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="mt-5">
                <?php include(ROOT_PATH . "/app/helpers/messages.php") ?>
            </div>
            <?php endif; ?>

        </div>
    </header>
    <!-- start of navbar -->

    <!-- start of activities section -->
    <div class="post-wrapper">
        <div class="container">
            <h2 class="font-weight-bold"><?php echo $postsTitle ?></h2>
            
            <?php if(!empty($all_acts)): ?>
                <div class="row justify-content-center py-3">
                    
                    <div class="col-sm-12 col-md-12 col-lg-6 <?php if(!empty($second_arr)) {echo 'col-border';} ?>">
                        <div class="card">
                            <img class="card-img-top" src="<?php echo BASE_URL . '/assets/img/' . $first_arr[0]['act_img'] ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize"><a href="<?php echo("read.php?p_id=" . $first_arr[0]['id'] . '&usr_id=' . $first_arr[0]['user_id'] . "&t=activities") ?>"><?php echo $first_arr[0]['act_title'] ?></a></h5>
                                <p class="card-text"><?php echo html_entity_decode(substr($first_arr[0]['act_desc'], 0, 50)) . '...' ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-3 col-border mt-sm-0 mt-md-3">
                        <?php $j=0; ?>
                        <?php foreach($second_arr as $arr): ?>
                            <div class="card">
                                <img class="card-img-top" src="<?php echo BASE_URL . '/assets/img/' . $arr['act_img'] ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><a href="<?php echo("read.php?p_id=" . $arr['id'] . '&usr_id=' . $arr['user_id'] . "&t=activities") ?>"><?php echo $arr['act_title'] ?></a></h5>
                                    <p class="card-text"><?php echo html_entity_decode(substr($arr['act_desc'], 0, 100)) . '...' ?></p>
                                </div>
                            </div>
                            <?php if($j== 0): ?>
                                <hr>
                            <?php endif; ?>
                            <?php $j++ ?>
                        <?php endforeach; ?>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-3 mt-sm-0 mt-md-5">
                        <?php $j=0; ?>
                        <?php foreach($third_arr as $arr): ?>
                            <div class="card">
                                <img class="card-img-top" src="<?php echo BASE_URL . '/assets/img/' . $arr['act_img'] ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize"><a href="<?php echo("read.php?p_id=" . $arr['id'] . '&usr_id=' . $arr['user_id'] . "&t=activities") ?>"><?php echo $arr['act_title'] ?></a></h5>
                                    <p class="card-text"><?php echo html_entity_decode(substr($arr['act_desc'], 0, 100)) . '...' ?></p>
                                </div>
                            </div>
                            <?php if($j== 0): ?>
                                <hr>
                            <?php endif; ?>
                            <?php $j++ ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <h2>There is no posts yet !</h2>
            <?php endif; ?>

        </div>

            <nav aria-label="Page navigation example" class="mt-lg-4">
                <ul class="pagination justify-content-center mb-lg-0">

                    <?php if($prev !== 0): ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?page=<?php echo $prev ?>"><i class="fal fa-chevron-double-left"></i></a>
                        </li>
                    <?php endif; ?>

                    <?php for($i=1; $i <= $num_pages; $i++): ?>
                        <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i ?>"><?php echo $i; ?></a></li>
                    <?php endfor; ?>

                    <?php if($next <= $num_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?page=<?php echo $next ?>"><i class="fal fa-chevron-double-right"></i></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
    <!-- end of activities section -->

    <div class="footer">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 footer-links">
                    <div class="row">
                        <div class="col-xm-12 col-sm-6 col-md-7">
                            <div class="copyright mb-sm-3 mb-md-0">Copyright &copy; <strong><span>Elite</span></strong>.
                                All Rights
                                Reserved</div>
                        </div>
                        <div class="col-xm-12 col-sm-6 col-md-5 social-links">
                            <a href="https://www.facebook.com/Mandalore21/"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/raid_boulahdid/"><i
                                    class="fab fa-instagram ml-3"></i></a>
                            <a href="https://www.linkedin.com/in/raid-boulahdid-0752a0140/"><i
                                    class="fab fa-linkedin-in ml-3"></i></a>
                            <a href="https://github.com/raid21"><i class="fab fa-github ml-3"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/script.main.js"></script>
</body>

</html>