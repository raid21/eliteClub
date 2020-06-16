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
    return $errors;
}

function validateEvent($event)
{
    $errors = array();

    if(empty($event['event_title']))
    {
        array_push($errors, "Event title is required");
    }

    if(empty($event['event_desc']))
    {
        array_push($errors, "Event details is required");
    }

    $existingEvent = selectOne('events', ['event_title' => $event['event_title']]);
    if ($existingEvent) {
        if(isset($_POST['update-event']) && $existingEvent['id'] != $event['id'])
        {
            array_push($errors, "Event title already exists");
        }

        if(isset($_POST['add-event']))
        {
            array_push($errors, "Event title already exists");
        }
    }

    if(empty($event['event_date']))
    {
        array_push($errors, "Event date is required");
    }

    if(empty($event['event_time']))
    {
        array_push($errors, "Event time is required");
    }

    return $errors;
}

?>