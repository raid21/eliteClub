<?php


function validateUser($user)
{
    $errors = array();

    if(empty($user['username']))
    {
        array_push($errors, "Username is required");
    }

    $existingUser = selectOne('users', ['username' => $user['username']]);
    if($existingUser['username'] == $user['username'])
    {
        array_push($errors, "Username already exists");
    }

    if(empty($user['email']))
    {
        array_push($errors, "Email is required");
    }

    if(empty($user['password']))
    {
        array_push($errors, "Password is required");
    }

    if(empty($user['passwordConf']))
    {
        array_push($errors, "Password confirmation is required");
    }

    if($user['passwordConf'] !== $user['password'])
    {
        array_push($errors, "Passwords don't match");
    }


    $existingUser = selectOne('users', ['email' => $user['email']]);
    if ($existingUser) {
        if(isset($_POST['update-usr']) && $existingUser['id'] != $user['id'])
        {
            array_push($errors, "Email already exists");
        }

        if(isset($_POST['add-usr']))
        {
            array_push($errors, "Email already exists");
        }
        
    }
    return $errors;
}

function validateUpdateUserInfo($user){
    $errors = array();

    if(empty($user["email"]))
    {
        unset($_POST['email']);
    }
    else
    {
        $existingEmail = selectOne('users', ['email' => $user['email']]);
        if ($existingEmail) {
            array_push($errors, "Email already exists");
        }
    }

    if(empty($_POST["username"]))
    {
        unset($_POST['username']);
    }
    else
    {   
        if(selectOne('users', ['username' => $user['username']]))
        {
            array_push($errors, "Username already taken");
        }
    }
    if(empty($_POST["user_tel"]))
    {
        unset($_POST['user_tel']);
    }


    return $errors;
}

function validateLogin($user)
{
    $errors = array();

    if(empty($user['username']))
    {
        array_push($errors, "Username is required");
    }

    if(empty($user['password']))
    {
        array_push($errors, "Password is required");
    }
    return $errors;
}

?>