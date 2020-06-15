<?php 
    function usersOnly($redirect = '/')
    {
        if(empty($_SESSION['id']))
        {
            $_SESSION['message'] = 'You need to login';
            $_SESSION['type'] = 'error';
            header('location: ' . BASE_URL . $redirect);
            exit(0);
        }

    }

    function adminOnly($redirect = '/dashboard/profile.php')
    {
        if(empty($_SESSION['id']) || empty($_SESSION['admin']))
        {
            $_SESSION['message'] = 'You are not authorized';
            $_SESSION['type'] = 'error';
            header('location: ' . BASE_URL . $redirect);
            exit(0);
        }
        
    }

    function guestsOnly($redirect = '/dashboard/profile.php')
    {
        if(isset($_SESSION['id']))
        {
            $_SESSION['message'] = "You can't login or register while you already logged in";
            $_SESSION['type'] = 'error';
            header('location: ' . BASE_URL . $redirect);
            exit(0);
        }
        
    }
    function noInfo($redirect = '/dashboard/profile.php')
    {
        if(!isset($_GET['p_id']))
        {
            $_SESSION['message'] = "You can't access this page directly";
            $_SESSION['type'] = 'error';
            header('location: ' . BASE_URL . $redirect);
            exit(0);
        }
        
    }
?>