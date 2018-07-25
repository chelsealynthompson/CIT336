<?php

/*
 * Products Controller 
 */
// Create or access a Session
 session_start();
// Get the database connections file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
//Get the products model
require_once '../model/products-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the array of categories
$categories = getCategories();
//Dynamic Nagigation
$navList = dynamicNavigation();


//Build category list here
//$catList = '<select name="categoryId" id="categoryId">';
//foreach ($categories as $category) {
//$catList .= '<option value="' .urlencode($category['categoryId']). '">' .$category['categoryName'] . '</option>';
//}
//$catList .= '</select>';

//$action is a variable used to store the type of content being requested.
//function that sifts the content to eliminate code that could do the website harm
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action');
}
 // Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
 $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}
switch ($action) {
 case'catForm':
 include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/add-category.php';
     break;
 
 case 'prodForm':
     include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/add-products.php';
     break;
 
 //new product option in the prod-mgmt.php
 case 'newProd':
  
  $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
  $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
  $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
  $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
  $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
  $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
  $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
  $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
  $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
  $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
  $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);

  //Check for missing data
  if (empty($invName) || empty($invDescription) || empty($invImage) ||
          empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) ||
          empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) ||
          empty($invStyle)) {
   $message = '<p class="notice">Please provide information for all empty form fields.</p>';
   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/add-product.php';
   exit;
  }
  // Send the data to the model
  $newProductOutcome = newProd($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle);
  // Check and report the result
  if ($newProductOutcome === 1) {
   $message = "<p>Thank you. The product has been added to the inventory.</p>";
   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/add-product.php';
   exit;
  } else {
   $message = '<p class="notice">Sorry, new product was not created. Please try again.</p>';
   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/add-product.php';
   exit;
  }
  break;


 // new category option in the prod-mgmt.php
 case 'newCat':
  // Filter and store the data
  $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
  //Check for missing data
  if (empty($categoryName)) {
   $message = '<p class="notice">Please provide information for all empty form fields.</p>';
   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/add-category.php';
   exit;
  }
  //Send data to the model
  $newCategoryOutcome = newCat($categoryName);
  //Check and report the result
  if ($newCategoryOutcome === 1) {
   header("location: /acme/products/index.php");
   exit;
  } else {
   $message = '<p class="notice">Sorry, new category was not created. Please try again.</p>';
   include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/add-category.php';
   exit;
  }
  break;
  
  case 'mod':
      $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
      $prodInfo = getProductInfo($invId);
      if(count($prodInfo)<1){
         $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-update.php';
         exit;
        break;
        
        
   case 'updateProd':
         $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
         $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
         $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
         $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
         $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
         $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
         $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
         $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
         $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
         $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
         $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
         $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
         $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

         //Check for missing data
         if (empty($invName) || empty($invDescription) || empty($invImage) ||
                 empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) ||
                 empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) ||
                 empty($invStyle)) {
          $message = '<p class="notice">Please complete all information for the updated item! Double check the category of the item.</p>';
          include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/prod-update.php';
          exit;
         }
         // Send the data to the model
         $updateResult = updateProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId);
         // Check and report the result
        if ($updateResult) {
            $message = "<p class='notify'>Congratulations, $invName was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
           }
           else {
                     $message = '<p class="notice">Sorry, the product was not updated. Please try again.</p>';
                     include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/prod-update.php';
                     exit;
                    }
 break;
      
case 'category':
            $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
            $products = getProductsByCategory($type);
            if(!count($products)){
             $message = "<p class='notice'>Sorry, no $type products could be found.</p>";
            } else {
             $prodDisplay = buildProductsDisplay($products);
            }
            //echo $prodDisplay;
            //exit;
            
            include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/category.php';
break;
  

    
    
    
    
    
    
      case 'deta':
 $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
//var_dump(getThumbnailImages($id));
//  exit;
 $theProduct = getProductInfo($id);
 if(!count($theProduct)){
  $message = "<p class='notice'>Sorry, no product was found.</p>";
 } else {
  $prod=$theProduct['invName'];
  $prodId=$theProduct['invId'];
  $theProdDisplay = ProductInformation($theProduct);
//get array with all thumbnail images
  //$thumb = getThumbnailImages($id);
//create html with previous array  
 // $aThumbDisplay = buildImageDisplayThumbnail($thumb);
 
 include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-detail.php';
 break;
}
 
    
    
    

case 'del':
 $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
 $prodInfo = getProductInfo($invId);
 if (count($prodInfo) < 1) {
  $message = 'Sorry, no product information could be found.';
 }
 include '../view/prod-delete.php';
 exit;
 break;
    
 
 
case 'deleteProd':
 $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
 $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

 $deleteResult = deleteProduct($invId);
 if ($deleteResult) {
  $message = "<p class='notice'>Congratulations, $invName was successfully deleted.</p>";
  $_SESSION['message'] = $message;
  header('location: /acme/products/');
  exit;
 } else {
  $message = "<p class='notice'>Error: $invName was not deleted.</p>";
  $_SESSION['message'] = $message;
  header('location: /acme/products/');
  exit;
 }
 break;
    
   



   
      
      
       
        
         case 'feat':
         $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
         $previouslySelected = getSelected();
         
         $previousId = $previouslySelected['invId'];
         $previousItem = $previouslySelected['invName'];
         $oldFeature = removeFeature($previousId);
         $featured = featureSelected($invId);
         
         $newFeature = getSelected($promo);
         $newItem = $newFeature['invName'];
         
         $featuredMessage = "<p>Previously featured item: " .$previousItem. " was cleared.<br>New featured item: " .$newItem. " was set.</p>";
            $_SESSION['featuredMessage'] = $featuredMessage;
            header('location: /acme/products/');
            exit;
         break;
      
      
      
      
      



         
 
      
      
      
      
      
        
   default:
    $products = getProductBasics();
    if(count($products) > 0){
  $prodList = '<table>';
  $prodList .= '<thead>';
  $prodList .= '<tr><th>Product Name</th></tr>';
  $prodList .= '</thead>';
  $prodList .= '<tbody>';
  foreach ($products as $product) {
   $prodList .= "<tr><td>$product[invName]</td>";
   $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
   $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td>";
   $prodList .= "<td><a href='/acme/products?action=feat&id=$product[invId]' title='Click to feature'>Feature</a></td></tr>";
  }
   $prodList .= '</tbody></table>';
  } else {
   $message = '<p class="notify">Sorry, no products were returned.</p>';
}
    
    include $_SERVER['DOCUMENT_ROOT'] . '/acme/view/product-management.php';
    break;
    
  }
