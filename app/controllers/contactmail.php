<?php
session_start();
$errors = array();

include(ROOT_PATH . "/app/helpers/validateEmail.php");

if (isset($_POST['submt-msg'])) {

    $errors = validateEmail($_POST);

    if(count($errors) === 0 )
    {
        $msg_owner = $_POST['contact-name'];
        $msg = $_POST['contact-msg'];
        $msg_email = $_POST['contact-email'];
        require_once(ROOT_PATH . '/vendor/autoload.php');
        try {
            // Create the SMTP Transport
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                    ->setUsername('elite.skikda@gmail.com')
                    ->setPassword('eliteskikda123');
                
            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);
                
            // Create a message
            $message = new Swift_Message();
                
            // Set a "subject"
            $message->setSubject($_POST['contact-sub']);
                
            // Set the "From address"
            $message->setFrom(['elite.skikda@gmail.com' => $_POST['contact-name']]);
                
            // Set the "To address" [Use setTo method for multiple recipients, argument should be array]
            $message->addTo('elite.skikda@gmail.com');
    
            $message->setBody("From:  $msg_email\n \nHello Elite team.\n \n$msg .\n \nThanks,\n");
                
            // Send the message
    
            if ($mailer->send($message)) {
                $_SESSION['message'] = "Your message successfully sent";
                $_SESSION['type'] = "success";
                header('location: ' . BASE_URL . '/');
                exit();

            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    else
    {
        $_SESSION['type'] = 'error';
    }
}
?>