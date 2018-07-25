<?php
/*
 * Acme Controller
 */

// Create or access a Session
 session_start();

// Get the database connection file
 require_once 'library/connections.php';
 // Get the acme model for use as needed
 require_once 'model/acme-model.php';
 //Get the products model
require_once 'model/products-model.php';
 // get the library functions
 require_once $_SERVER['DOCUMENT_ROOT'] . '/acme/library/functions.php';
 
 

 
 
 
 
 
 // Get the array of categories
	
 $categories = getCategories();
 
// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
 $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

 // this calls the navigation
  $navList = dynamicNavigation($categories);
//echo $navList;
//exit;
    
$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
switch ($action){
 case 'something':
  
  break;
 
 default:
  $promo = getSelected();
  $featuredDisplay = buildFeaturedDisplay($promo);
  include 'view/home.php';
}