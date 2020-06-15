<?php 
$host = 'localhost';
$user = 'raid';
$pass = 'rootuser';
$db_name = 'elite';

$conn = new MySQLi($host, $user, $pass, $db_name);

if($conn->connect_error) {
    die('Database connection error: ' . $conn->connect_error);
}

?>