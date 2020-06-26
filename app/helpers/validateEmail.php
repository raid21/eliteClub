<?php
function validateEmail($email)
{
    $errors = array();

    if(empty($email['contact-name']))
    {
        array_push($errors, "Your name is required");
    }

    if(empty($email['contact-email']))
    {
        array_push($errors, "Email is required");
    }

    if(!filter_var($email['contact-email'],FILTER_VALIDATE_EMAIL))
    {
        array_push($errors, "Email is not valid");
    }

    if(empty($email['contact-sub']))
    {
        array_push($errors, "Email subject is required");
    }

    if(empty($email['contact-msg']))
    {
        array_push($errors, "Message is required");
    }

    return $errors;
}

?>