<?php 

    function validateDrs()
    {
        $errors = array();

        if(isset($_POST['drSp']) && $_POST['drSp'] !== 'chooseone')
        {   
            $existingEmail = selectOne('doctors', ['drEmail' => $_POST['drEmail']]);
            if($existingEmail)
            {
                array_push($errors, 'Email already taken');
            }

            // if(isset($_POST['drSp']) && $_POST['drSp'] == 'chooseone')
            // {
            //     $errors = array_push($errors, 'Please select one from the options');  
            // }
        }


        if(isset($_POST['drType']) && $_POST['drType'] !== 'chooseone')
        {
            $existingEmail = selectOne($_POST['drType'], ['drEmail' => $_POST['drEmail']]);
            if($existingEmail)
            {
                array_push($errors, 'Email already taken');
            }

            // if(isset($_POST['drType']) && $_POST['drType'] == 'chooseone')
            // {
            //     array_push($errors, 'Please select one from the options');   
            // }
        }

        return $errors;
    }

    function validateUpdateDr($dr)
    {
        $errors = array();
        $existingEmail = selectOne('doctors', ['drEmail' => $dr['drEmail']]);
        if($existingEmail)
        {
            if(isset($_POST['update-dr']) && $existingEmail['id'] != $dr['id'])
            {
                array_push($errors, 'Email already taken');
            }
        }

        return $errors;
    }

    function validate_dnt($dn)
    {
        $errors = array();
        
        $existingEmail = selectOne('dentists', ['drEmail' => $dn['drEmail']]);
        if($existingEmail)
        {
            if(isset($_POST['update-Dentist']) && $existingEmail['id'] != $dn['id'])
            {
                array_push($errors, 'Email already taken');
            }
        }

        return $errors;
    }

    function validate_pharm($dn)
    {
        $errors = array();
        
        $existingEmail = selectOne('pharmacies', ['drEmail' => $dn['drEmail']]);
        if($existingEmail)
        {
            if(isset($_POST['update-Pharmacy']) && $existingEmail['id'] != $dn['id'])
            {
                array_push($errors, 'Email already taken');
            }
        }
        return $errors;
    }

?>