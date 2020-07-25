<?php 
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateTelecons.php");
include(ROOT_PATH . "/app/helpers/middleware.php");

$sp_table = 'specialty';
$dr_id = '';
$dr_name = '';
$dr_email = '';
$dr_phone = '';
$dr_wilaya = '';
$drSp = '';
$errors = array();

function validate_sp($table , $splty) 
{
    $error = array();
    $existing_sp = selectOne($table, ['specialtyname' => $splty['specialtyname']]);
    if($existing_sp)
    {
        array_push($error, "Specialty name already exists");
        return $error;
    }
}

if(isset($_POST['add-sp']))
{
    adminOnly();
    unset($_POST['add-sp']);
    $errors = validate_sp($sp_table, $_POST);

    if (!empty($_FILES['sp_img']['name'])) {  
        
        $img_name = time() . '_' . $_FILES['sp_img']['name'];
        
        $destination = ROOT_PATH . '/assets/img/' . $img_name;

        $upload_result =  move_uploaded_file($_FILES['sp_img']['tmp_name'], $destination);
        
        if ($upload_result) {
            $_POST['sp_img'] = mysqli_real_escape_string($conn, $img_name);
        }else{
            array_push($errors, 'Failed to upload image');
        }
    }
    else{
        array_push($errors, 'Specialty image is required');
    }

    if(count($errors) === 0 )
    {
        $sp_id = create($sp_table, $_POST);
        $_SESSION['type'] = 'success';
        $_SESSION['message'] = 'Specialty created successfully';
        header('location: ' . BASE_URL . '/dashboard/teleconsultation/all_domains/all_specialties.php');
        exit();

    }
    else
    {
        $_SESSION['type'] = 'error';
    }
}

if(isset($_GET['sp_id']))
{
    adminOnly();
    $deleted = delete($sp_table, $_GET['sp_id']);
    $_SESSION['message'] = 'Specialty deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/dashboard/teleconsultation/all_domains/all_specialties.php');
    exit();
    
}

if(isset($_POST['add-dr']))
{
    adminOnly();
    
    unset($_POST['add-dr']);
    $errors = validateDrs();

    if (!empty($_FILES['dr_img']['name'])) {  
        
        $img_name = time() . '_' . $_FILES['dr_img']['name'];
        
        $destination = ROOT_PATH . '/assets/img/' . $img_name;

        $upload_result =  move_uploaded_file($_FILES['dr_img']['tmp_name'], $destination);
        
        if ($upload_result) {
            $_POST['dr_img'] = mysqli_real_escape_string($conn, $img_name);
        }else{
            array_push($errors, 'Failed to upload image');
        }
    }
    else{
        array_push($errors, 'Dr/Pharmacy image is required');
    }

    if(count($errors) === 0 )
    {
        $_POST['drName'] = strtolower($_POST['drName']);
        $_POST['drWilaya'] = strtolower($_POST['drWilaya']);

        if(isset($_POST['drSp']) && $_POST['drSp'] !== 'chooseone')
        {
            unset($_POST['drType']);
            $sp_id = create('doctors', $_POST);
            $_SESSION['type'] = 'success';
            $_SESSION['message'] = 'Doctor created successfully';
            header('location: ' . BASE_URL . '/dashboard/teleconsultation/all_domains/all_drs.php');
            exit();
        }
        elseif(isset($_POST['drType']) && $_POST['drType'] !== 'chooseone')
        {
            $drType = $_POST['drType'];
            unset($_POST['drSp'], $_POST['drType']);
            $sp_id = create($drType, $_POST);
            $_SESSION['type'] = 'success';
            if($drType == "dentists")
            {
                $_SESSION['message'] = 'Dentist created successfully';
                header('location: ' . BASE_URL . '/dashboard/teleconsultation/all_domains/all_dentists.php');
                exit();
            }
            else
            {
                $_SESSION['message'] = 'Pharmacy created successfully';
                header('location: ' . BASE_URL . '/dashboard/teleconsultation/all_domains/all_pharm.php');
                exit();
            }
        }

    }
    else
    {
        $_SESSION['type'] = 'error';
    }
}


// ******* delete dentists & pharmacies & doctors
if(isset($_GET['del_dn_id']))
{
    adminOnly();
    $deleted = delete('dentists', $_GET['del_dn_id']);
    $_SESSION['message'] = 'dentist deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/dashboard/teleconsultation/all_domains/all_dentists.php');
    exit();   
}

if(isset($_GET['del_pharm_id']))
{
    adminOnly();
    $deleted = delete('pharmacies', $_GET['del_pharm_id']);
    $_SESSION['message'] = 'Pharmacy deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/dashboard/teleconsultation/all_domains/all_pharm.php');
    exit();
}

if(isset($_GET['del_dr_id']))
{
    adminOnly();
    $deleted = delete('doctors', $_GET['del_dr_id']);
    $_SESSION['message'] = 'Doctor deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/dashboard/teleconsultation/all_domains/all_drs.php');
    exit();
}
// ******* end of delete dentists & pharmacies & doctors

// ******* edit dentists & pharmacies & doctors
if(isset($_GET['edt_dr_id']))
{
    $edit_dr = selectOne('doctors', ['id' => $_GET['edt_dr_id']]);
    $dr_id = $edit_dr['id'];
    $dr_name = $edit_dr['drName'];
    $dr_email = $edit_dr['drEmail'];
    $dr_phone = $edit_dr['drPhone'];
    $dr_wilaya = $edit_dr['drWilaya'];
    $drSp = $edit_dr['drSp'];
}
if(isset($_POST['update-dr']))
{
    $_POST['drEmail'] = trim($_POST['drEmail']);

    $errors = validateUpdateDr($_POST);

    $dr_id = $_POST['id'];
    unset($_POST['update-dr'], $_POST['id']);

    if (!empty($_FILES['dr_img']['name'])) {  
        
        $img_name = time() . '_' . $_FILES['dr_img']['name'];
        
        $destination = ROOT_PATH . '/assets/img/' . $img_name;

        $upload_result =  move_uploaded_file($_FILES['dr_img']['tmp_name'], $destination);
        
        if ($upload_result) {
            $_POST['dr_img'] = mysqli_real_escape_string($conn, $img_name);
        }else{
            array_push($errors, 'Failed to upload image');
        }
    }
    

    if(count($errors) === 0)
    {
        $_POST['drName'] = strtolower($_POST['drName']);
        $_POST['drWilaya'] = strtolower($_POST['drWilaya']);
        $sp_id = update('doctors', $dr_id, $_POST);
        $_SESSION['type'] = 'success';
        $_SESSION['message'] = 'Doctor updates successfully';
        header('location: ' . BASE_URL . '/dashboard/teleconsultation/all_domains/all_drs.php');
        exit();
    }
    else
    {
        $_SESSION['type'] = 'error';
        $dr_id = $_POST['id'];
        $dr_name = $_POST['drName'];
        $dr_email = $_POST['drEmail'];
        $dr_phone = $_POST['drPhone'];
        $dr_wilaya = $_POST['drWilaya'];
        $drSp = $_POST['drSp'];
    }
    
}

if(isset($_GET['edt_dn_id']))
{
    $edit_dr = selectOne('dentists', ['id' => $_GET['edt_dn_id']]);
    $dr_id = $edit_dr['id'];
    $dr_name = $edit_dr['drName'];
    $dr_email = $edit_dr['drEmail'];
    $dr_phone = $edit_dr['drPhone'];
    $dr_wilaya = $edit_dr['drWilaya'];
}

if(isset($_GET['edt_pharm_id']))
{
    $edit_dr = selectOne('pharmacies', ['id' => $_GET['edt_pharm_id']]);
    $dr_id = $edit_dr['id'];
    $dr_name = $edit_dr['drName'];
    $dr_email = $edit_dr['drEmail'];
    $dr_phone = $edit_dr['drPhone'];
    $dr_wilaya = $edit_dr['drWilaya'];
}

if(isset($_POST['update-Dentist']))
{
    $dr_id = $_POST['id'];
    $_POST['drEmail'] = trim($_POST['drEmail']);

    $errors = validate_dnt($_POST);
    unset($_POST['update-Dentist'], $_POST['id'], $_POST['drType']);

    if (!empty($_FILES['dr_img']['name'])) {  
        
        $img_name = time() . '_' . $_FILES['dr_img']['name'];
        
        $destination = ROOT_PATH . '/assets/img/' . $img_name;

        $upload_result =  move_uploaded_file($_FILES['dr_img']['tmp_name'], $destination);
        
        if ($upload_result) {
            $_POST['dr_img'] = mysqli_real_escape_string($conn, $img_name);
        }else{
            array_push($errors, 'Failed to upload image');
        }
    }

    if(count($errors) === 0)
    {
        $_POST['drName'] = strtolower($_POST['drName']);
        $_POST['drWilaya'] = strtolower($_POST['drWilaya']);
        $sp_id = update('dentists' , $dr_id, $_POST);
        $_SESSION['type'] = 'success';

        $_SESSION['message'] = 'Dentist updated successfully';
        header('location: ' . BASE_URL . '/dashboard/teleconsultation/all_domains/all_dentists.php');
        exit();
    }
    else
    {
        $_SESSION['type'] = 'error';
        $dr_id = $dr_id;
        $dr_name = $_POST['drName'];
        $dr_email = $_POST['drEmail'];
        $dr_phone = $_POST['drPhone'];
        $dr_wilaya = $_POST['drWilaya'];
    }

}

if(isset($_POST['update-Pharmacy']))
{
    $dr_id = $_POST['id'];
    $_POST['drEmail'] = trim($_POST['drEmail']);

    $errors = validate_pharm($_POST);
    unset($_POST['update-Pharmacy'], $_POST['id'], $_POST['drType']);

    if (!empty($_FILES['dr_img']['name'])) {  
        
        $img_name = time() . '_' . $_FILES['dr_img']['name'];
        
        $destination = ROOT_PATH . '/assets/img/' . $img_name;

        $upload_result =  move_uploaded_file($_FILES['dr_img']['tmp_name'], $destination);
        
        if ($upload_result) {
            $_POST['dr_img'] = mysqli_real_escape_string($conn, $img_name);
        }else{
            array_push($errors, 'Failed to upload image');
        }
    }

    if(count($errors) === 0)
    {
        $_POST['drName'] = strtolower($_POST['drName']);
        $_POST['drWilaya'] = strtolower($_POST['drWilaya']);
        $sp_id = update('pharmacies' , $dr_id, $_POST);
        $_SESSION['type'] = 'success';

        $_SESSION['message'] = 'Pharmacy updated successfully';
        header('location: ' . BASE_URL . '/dashboard/teleconsultation/all_domains/all_pharm.php');
        exit();
    }
    else
    {
        $_SESSION['type'] = 'error';
        $dr_id = $dr_id;
        $dr_name = $_POST['drName'];
        $dr_email = $_POST['drEmail'];
        $dr_phone = $_POST['drPhone'];
        $dr_wilaya = $_POST['drWilaya'];
    }

}
// ******* end of editt dentists & pharmacies & doctors
?>