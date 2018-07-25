<?php
/*
 * Accounts Controller
 */
// Create or access a Session
 session_start();
// Get the database connection file
 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
 // Get the accounts model
 require_once '../model/accounts-model.php';
 // Get the functions library
 require_once '../library/functions.php';
 
 // Get the array of categories
	
 $categories = getCategories();
 
 
 // this calls the navigation
$navList = dynamicNavigation($categories);
 //var_dump($categories);
	//exit;


$action= filter_input(INPUT_POST, 'action');
if ($action == NULL) {
           $action = filter_input(INPUT_GET, 'action');
        }
 //Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
 $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

switch ($action){
 case 'login':
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
   break;
   case 'registration':
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/registration.php';
  break;
  case 'register':
 // Filter and store the data
$clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
$clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
$clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
$clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

$clientEmail = checkEmail($clientEmail);
$checkPassword = checkPassword($clientPassword);

$existingEmail = checkExistingEmail($clientEmail);

// Check for existing email address in the table
if($existingEmail){
 $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
 include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
 exit;
}

// Check for missing data
if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
 $message = '<p>Please provide information for all form fields.</p>';
 include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/registration.php';
 exit; 
}

// Hash the checked password
$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);


// Send the data to the model
$regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
// Check and report the result
if($regOutcome === 1){
  setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
 $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
 header('Location: /acme/accounts/?action=login');
 exit;
} else {
 $message = '<p class="notice">Sorry $clientFirstname, but the registration failed. Please try again.</p>';
 include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/registration.php';
 exit;
}
break;

case 'Login':
$clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
$clientEmail = checkEmail($clientEmail);
$clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
$passwordCheck = checkPassword($clientPassword);

// Run basic checks, return if errors
if (empty($clientEmail) || empty($passwordCheck)) {
 $message = '<p class="notice">Please provide a valid email address and password.</p>';
 include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
 exit;
}
  
$clientData = getClient($clientEmail);

$hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

if(!$hashCheck) {
  $message = '<p class="notice">Please check your password and try again.</p>';
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
  exit;
}
// A valid user exists, log them in
$_SESSION['loggedin'] = TRUE;

array_pop($clientData);
// Store the array into the session
$_SESSION['clientData'] = $clientData;
// Send them to the admin view
$clientFirstname=$clientData['clientFirstname'];



setcookie('firstname', $clientFirstname, strtotime('-1 year'), '/');

//setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');

  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
  

  
  default:
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/admin.php';
   exit;
   
   break;
   
 
   
   
case 'Logout':
session_unset();  
session_destroy(); 
setcookie('firstname', $clientFirstname, strtotime('-1 year'), '/');
header("Location: http://localhost/acme/" );
exit;









case 'changeAccount':
// Filter and store the data
  $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
  $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
  $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
  $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

$infoClient = ($_SESSION['clientData']);
if($clientEmail != $infoClient['clientEmail']){
  $existingEmail = checkExistingEmail($clientEmail);
if($existingEmail){
    $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/login.php';
    exit;
    }
}
  
// Check for missing data
if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
  if(!is_null($clientFirstname)){
        $message = '<p>Please provide information for all empty form fields.</p>';
  }
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/client-update.php';
  exit;
}

$regUpdateClient = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

if($regUpdateClient){  
  $message = "<p>$clientFirstname, your update was successful.</p>";
 
  
  $clientData = getClientById($clientId);
  $_SESSION['loggedin'] = TRUE;

array_pop($clientData);
// Store the array into the session
$_SESSION['clientData'] = $clientData;
// Send them to the admin view
  $clientFirstname=$clientData['clientFirstname'];
  setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/'); 
  $cookieFirstname=$clientFirstname;
 
//-----------------------------------------
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/admin.php';
  //header("Location: http://localhost/acme/view/client-update.php" );
  exit;
} else {
  $message = "<p>Sorry $clientFirstname, but the update failed. Please try again.</p>";
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/client-update.php';
  exit;
}
break;
case 'changePassword':
// Filter and store the data
  $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
  $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
$infoClient = ($_SESSION['clientData']);
$cname=$infoClient['clientFirstname'];
//$clientEmail = checkEmail($clientEmail);
$checkPassword = checkPassword($clientPassword);
// Check for missing data
if(empty($checkPassword)){
  $messagePassword = "<p>Password doesn't match requested format. Please try again.</p>";
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/client-update.php';
  exit;
}
$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT); 
$regOutcome = updatePass($clientId, $hashedPassword);
if($regOutcome === 1){
  setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');  
  $messagePassword = "<p>Your password was successfully changed.</p>";
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/admin.php';
  exit;
} else {
  $messagePassword = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
  include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/client-update.php';
  exit;
}
break;





case 'welcomenamelink':

if (isset($_SESSION['loggedin'])) {
 include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/admin.php';
 exit;
}
else {
 include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/home.php';
   
}



}


