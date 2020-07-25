<?php

    // $ipaddress = getenv("REMOTE_ADDR") ; 
    // echo "Your IP Address is " . $ipaddress; 

    echo '<br>';

//     $localIP = getHostByName(getHostName()); 
//   // Displaying the address  
//     echo $localIP; 

    $IP = $_SERVER['REMOTE_ADDR'];
    $computerName = gethostbyaddr($IP);
    echo $computerName;
?>