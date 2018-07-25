<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}
?>
<?php
// Build the categories option list
$catList = '<select name="categoryId" id="categoryId">';
$catList .= "<option>Select a Category</option>";
foreach ($categories as $category) {
   $catList .= "<option id='$category[categoryId]' value='$category[categoryId]'";
  if(isset($categoryId)){$catList .= "<option id='$category[categoryId]' value='$category[categoryId]'";
    if($category['categoryId'] === $categoryId){
      $catList .= ' selected ';
    }
 } elseif(isset($prodInfo['categoryId'])){
  if($category['categoryId'] === $prodInfo['categoryId']){
   $catList .= ' selected ';
  }
  }
  $catList .= ">$category[categoryName]</option>";
}
$catList .='</select>';
?>
<!doctype html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?> | Acme, Inc</title>
    <meta name="author" content="Chelsea Thompson">
    <meta name="description" content="Acme Page">   
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">   
    <link href="/acme/css/main.css" rel="stylesheet">    
    <link href="/acme/css/medium.css" rel="stylesheet">  
    <link href="/acme/css/large.css" rel="stylesheet">
    </head>
<body>
    <main>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
        </header>
    <nav>
       <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/navigation.php'; ?>    
            </nav>
 
<h1><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?></h1>
<?php
    if (isset($_POST{'submit'})) {
     echo "<div class='message'>$message</div>";
}
?>
<form method="post" action="/acme/products/index.php" name="newProd" id="clientRegister">
             
            <label><span>Type:
            <?php echo $catList;?></span></label><br>
             
            <label><span>Product Name: </span><br><input type="text" name="invName" id="invName" required <?php if(isset($invName)){ echo "value='$invName'"; } elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>>
            </label><br>
            
        <label>
           <span>Product Description:</span><br><textarea name="invDescription"  rows="5" cols="47" required><?php if(isset($invDescription)){echo $invDescription;} elseif(isset($prodInfo['invDescription'])) {echo "$prodInfo[invDescription]"; } ?></textarea><br>
      </label><br>
            
      
            <label>
               <span>Product Image (path to image): </span><br><input type="text" name="invImage" id="invImage" required <?php if(isset($invName)){ echo "value='$invName'"; } elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>>
            </label><br>
            
            
           <label>
              <span>Product Thumbnail (path to thumbnail): </span><br><input type="text" name="invThumbnail" id="invThumbnail" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}elseif(isset($prodInfo['invThumbnail'])) {echo "value='$prodInfo[invThumbnail]'"; } ?> required>
           </label><br>
           
           
           <label>
              <span>Price: </span><br><input type="number" name="invPrice" required id="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";}elseif(isset($prodInfo['invPrice'])) {echo "value='$prodInfo[invPrice]'"; } ?> min="1" max="10000000">
           </label><br>
           
           
           <label>
              <span>Stock: </span><br><input type="number" name="invStock" id="invStock" required <?php if(isset($invStock)){echo "value='$invStock'";}elseif(isset($prodInfo['invStock'])) {echo "value='$prodInfo[invStock]'"; } ?> min="1" max="10000000">
           </label><br>
           
           
           <label>
              <span>Size (inches): </span><br><input type="number" name="invSize" <?php if(isset($invSize)){echo "value='$invSize'";}elseif(isset($prodInfo['invSize'])) {echo "value='$prodInfo[invSize]'"; } ?> required id="invSize" min="1" max="10000000">
           </label><br>
           
           
           <label>
              <span>Weight (Lbs): </span><br><input type="number" name="invWeight" id="invWeight" <?php if(isset($invWeight)){echo "value='$invWeight'";}elseif(isset($prodInfo['invWeight'])) {echo "value='$prodInfo[invWeight]'"; } ?> min="1" max="10000000" required >
           </label><br>
           
           
           <label>
              <span>Location: </span><br><input type="text" name="invLocation" id="invLocation" <?php if(isset($invLocation)){echo "value='$invLocation'";}elseif(isset($prodInfo['invLocation'])) {echo "value='$prodInfo[invLocation]'"; } ?> required>
           </label><br>
           
           
           <label>
              <span>Vendor: </span><br><input type="text" name="invVendor" id="invVendor" <?php if(isset($invVendor)){echo "value='$invVendor'";}elseif(isset($prodInfo['invVendor'])) {echo "value='$prodInfo[invVendor]'"; } ?> required>
           </label><br>
           
           
           <label>
              <span>Style: </span><br><input type="text" name="invStyle" id="invStyle" <?php if(isset($invStyle)){echo "value='$invStyle'";}elseif(isset($prodInfo['invStyle'])) {echo "value='$prodInfo[invStyle]'"; } ?> required>
           </label><br><br>
        
        <input type="submit" name="submit" value="Update Product" class="registerbtn">
        
         <input type="hidden" name="action" value="updateProd">
        <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?> ">
        
        
    
    
    
    </form>   
  
    
  <footer>
     <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
     Last Updated: <?php echo date('j F, Y', getlastmod()) ?>
             
        </footer>
     </main>
    </body>
    </html>