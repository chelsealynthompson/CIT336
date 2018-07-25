<?php

function acmeConnect(){
$server = 'localhost';
$dbname= 'acme';
$username = 'iClient';
$password = '9jZIukQy42ut5thc';
$dsn = "mysql:host=$server;dbname=$dbname";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

// Create the actual connection object and assign it to a variable
try {
$db = new PDO($dsn, $username, $password, $options);
return $db;
} catch(PDOException $e) {
header('location: /acme/view/500.php');
exit;
}
}
