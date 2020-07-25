<?php 
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");

$all_med = array();
$page_title = 'All Doctors';
$limit = '';
$page = '';
$start = '';
$all = '';
$drWilaya = '';
$t = '';
$check = 0;
$check_dr = 0;
$sp= '';

$errors = array();

function searchByDrName($table, $term)
{
    global $conn;
    $match = '%' . $term . '%';
    $sql = "SELECT p.* FROM $table AS p WHERE p.drName LIKE ?";

    $stmt = executeQuery($sql, ['drName' => $match]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}



function all_rq_dr($table, $wilaya, $startt, $limite)
{
    global $conn;
    $match = '%' . $wilaya . '%';
    $sql = "SELECT p.* FROM $table AS p WHERE p.drWilaya= ? LIMIT $startt, $limite";

    $stmt = executeQuery($sql, ['drWilaya' => $wilaya]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}


if(isset($_GET['sps_id']))
{

    $limit = 1;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;
    $sp = $_GET['sps_id'];

    $result = $conn->query("SELECT * FROM doctors WHERE drSp=$sp LIMIT $start, $limit");
    $all_med = $result->fetch_all(MYSQLI_ASSOC);

    $all = count(selectAll('doctors', ['drSp' => $_GET['sps_id']]));
    $check_dr = 1;
    

    //$all_med = all_rq_drs($_GET['sps_id'], $start, $limit);
    //display($all_med);
    //$all = count(selectAll($_GET['t'], ['drWilaya' => $_GET['w']]));

    //$all_med = selectAll('doctors', ['drSp' => $_GET['sps_id']]);
}

if(isset($_POST['search_dr_dom']))
{
    if($_POST['drType'] == 'chooseone')
    {
        array_push($errors, 'choose one is just a placeholder. Please select an other options');
    }
    if(count($errors) == 0)
    {
        unset($_POST['search_dr_dom']);
        $_POST['drWilaya'] = mysqli_real_escape_string($conn ,trim(strtolower($_POST['drWilaya'])));
        header('location: ' . BASE_URL . '/medical/all_med/all_med.php?t=' . $_POST['drType']. '&w=' . $_POST['drWilaya']);
    }
    else
    {
        $_SESSION['type'] = 'error';
    }
}

if(isset($_GET['t']) && isset($_GET['w']))
{
    $drWilaya = $_GET['w'];
    $t = $_GET['t'];

    $limit = 3;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $all_med = all_rq_dr($_GET['t'], $_GET['w'], $start, $limit);
    $all = count(selectAll($_GET['t'], ['drWilaya' => $_GET['w']]));


    if($_GET['t'] == 'dentists')
    {
        $page_title = 'All Dentists';
    }
    if($_GET['t'] == 'pharmacies')
    {
        $page_title = 'All Pharmacies';
    }
}


if(isset($_POST['search_dr_doms']))
{
    if($_POST['drType'] == 'chooseone')
    {
        array_push($errors, 'choose one is just a place holder. Please select an other option');
    }
    if(count($errors) == 0)
    {
        unset($_POST['search_dr_doms']);
        $all_med = searchByDrName($_POST['drType'],  $_POST['drPh_name']);
    
        $page_title = "You searched for: '" . $_POST['drPh_name'] . "'";
        $check = 1;
    }
    else
    {
        $_SESSION['type'] = 'error';
    }
}
?>