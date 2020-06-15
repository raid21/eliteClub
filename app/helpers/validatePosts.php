<?php

function validatePosts($post)
{
    $errors = array();

    if(empty($post['act_title']))
    {
        array_push($errors, "Activity title is required");
    }

    if(empty($post['act_desc']))
    {
        array_push($errors, "Activity details is required");
    }

    $existingPost = selectOne('activities', ['act_title' => $post['act_title']]);
    if ($existingPost) {
        if(isset($_POST['update-post']) && $existingPost['id'] != $post['id'])
        {
            array_push($errors, "Activity title already exists");
        }

        if(isset($_POST['add-post']))
        {
            array_push($errors, "Activity title already exists");
        }
    }

    if(empty($post['act_date']))
    {
        array_push($errors, "Activity date is required");
    }

    if(empty($post['act_time']))
    {
        array_push($errors, "Activity time is required");
    }

    return $errors;
}

?>