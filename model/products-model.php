<?php

/* 
 * Products model
 */

  function newCategory($categoryName){
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 $sql = 'INSERT INTO categories (categoryName) VALUES (:categoryName)';
 // Create the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // statement with the actual values in the variables
 // and tells the database the type of data it is
$stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Close the database interaction
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}



function newProd($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle) {
// Create a connection object from the acme connection function 
 $db = acmeConnect();
//SQL
 $sql = 'INSERT INTO inventory (categoryId, invName, invDescription, invImage, invThumbnail, invPrice, invStock, invSize, invWeight, invLocation, invVendor, invStyle) VALUES (:categoryId, :invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invSize, :invWeight, :invLocation, :invVendor, :invStyle)';
// Create the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
// The next 11 lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
 $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
 $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
 $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
 $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
 $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
 $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
 $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
 $stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);
 $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
 $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
 $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
 $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
 //this runs the statements above and inserts the data into the database
 $stmt->execute();
 //this checks to see how many rows were added as a result of the above statements
 $rowsChanged = $stmt->rowCount();
 //this closes the interaction between the function and the database server
 $stmt->closeCursor();
 //This sends the results from the rowCount above to the controller (used in showing a success message I assume)
 return $rowsChanged;
}

//the following function will get basic product information from the inventory table for starting an update process

function getProductBasics() {
 $db = acmeConnect();
 $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
 $stmt = $db->prepare($sql);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;
}
// Get product information by invId
function getProductInfo($invId){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $prodInfo;
}

function updateProduct($catType, $invName, $invDescription, $invImg, $invThumb, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId) {
// Create a connection
$db = acmeConnect();
// The SQL statement to be used with the database
$sql = 'UPDATE inventory SET invName = :invName, invDescription = :invDescription, invImage = :invImg, invThumbnail = :invThumb, invPrice = :invPrice, invStock = :invStock, invSize = :invSize, invWeight = :invWeight, invLocation = :invLocation, categoryId = :catType, invVendor = :invVendor, invStyle = :invStyle WHERE invId = :invId';
$stmt = $db->prepare($sql);
$stmt->bindValue(':catType', $catType, PDO::PARAM_INT);
$stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
$stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
$stmt->bindValue(':invImg', $invImg, PDO::PARAM_STR);
$stmt->bindValue(':invThumb', $invThumb, PDO::PARAM_STR);
$stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
$stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
$stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
$stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
$stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
$stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
$stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
$stmt->execute();
$rowsChanged = $stmt->rowCount();
$stmt->closeCursor();
return $rowsChanged;
}


//the following function will get basic product information from the inventory table for starting a delete process
function deleteProduct($invId) {
 $db = acmeConnect();
 $sql = 'DELETE FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $rowsChanged = $stmt->rowCount();
 $stmt->closeCursor();
 return $rowsChanged;
}

//this gets a list of products based on the category
function getProductsByCategory($type){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :catType)';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':catType', $type, PDO::PARAM_STR);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;
}






//this gets the featured item
function getSelected() {
   $db = acmeConnect();
   $sql = 'SELECT * FROM inventory WHERE invFeatured = 1';
   $stmt = $db->prepare($sql);
   $stmt->execute();
   $previouslySelected = $stmt->fetch(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $previouslySelected;  
}


function removeFeature($previousId) {
   $db = acmeConnect();
   $sql = 'UPDATE inventory SET invFeatured = null WHERE invId = :invId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':invId', $previousId, PDO::PARAM_INT);
   $stmt->execute();
   $rowsChanged = $stmt->rowCount();
   $stmt->closeCursor();
   return $rowsChanged;
}


function featureSelected($invId) {
   $db = acmeConnect();
   $sql = 'UPDATE inventory SET invFeatured = 1 WHERE invId = :invId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
   $stmt->execute();
   $rowsChanged = $stmt->rowCount();
   $stmt->closeCursor();
   return $rowsChanged;
}