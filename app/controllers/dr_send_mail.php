<?php
session_start();
$errors = array();

if (isset($_POST['usr_contact_dr'])) {
    // display($_POST);
    $msg_owner = $_POST['usr_name'];
    $msg = $_POST['usr_msg'];
    $msg_email = $_POST['usr_email'];
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
        //$message->setSubject($_POST['contact-sub']);
                
        // Set the "From address"
        $message->setFrom(['elite.skikda@gmail.com' => $_POST['contact-name']]);
                
        // Set the "To address" [Use setTo method for multiple recipients, argument should be array]
        $message->addTo($_POST['dr_email']);
    
        $message->setBody("From:  $msg_email\n \nHello Doctor/Pharmacy.\n \n$msg .\n \nThanks,\n");
                
        // Send the message
    
        if ($mailer->send($message)) 
        {
            $_SESSION['message'] = "Your message successfully sent";
            $_SESSION['type'] = "success";
            header('location: ' . BASE_URL . '/medical/domains.php#succ_notif');
            exit();
            }
        } 
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
}
?>