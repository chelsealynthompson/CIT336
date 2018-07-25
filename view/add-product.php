<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}
?>
<?php
$catList = '<select name="categoryId" id="categoryId">';
$catList .= "<option>Select a Category</option>";
foreach ($categories as $category) {
   $catList .= "<option id='$category[categoryId]' value='$category[categoryId]'";
  if(isset($categoryId)){$catList .= "<option id='$category[categoryId]' value='$category[categoryId]'";
    if($category['categoryId'] === $categoryId){
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
    <title>Add Product</title>
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
 
<h1>Add Product</h1>
<?php
    if (isset($_POST{'submit'})) {
     echo "<div class='message'>$message</div>";
}
?>
<form method="post" action="/acme/products/index.php" name="newProd" id="clientRegister">
             
            <label><span>Type:
            <?php echo $catList;?></span></label><br>
             
            <label><span>Product Name: </span><br><input name="invName" id="invName" <?php if(isset($invName)){echo "value='$invName'";} ?> type="text" required></label><br>
            
            <label><span>Product Description: </span><br><textarea name="invDescription" id="invDescription" rows="5" cols="20" required><?php if(isset($invDescription)){echo $invDescription;} ?></textarea></label><br>
            
            <label><span>Product Image (path to image): </span><br><input name="invImage" id="invImage" <?php if(isset($invImage)){echo "value='$invImage'";} ?> type="text" required></label><br>
            
           <label><span>Product Thumbnail (path to thumbnail): </span><br><input name="invThumbnail" id="invThumbnail" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} ?> type="text" required></label><br>
           
           <label><span>Price: </span><br><input name="invPrice" id="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} ?> type="number" required></label><br>
           
           <label><span>Stock: </span><br><input name="invStock" id="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} ?> type="number" required></label><br>
           
           <label><span>Size (inches): </span><br><input name="invSize" id="invSize" <?php if(isset($invSize)){echo "value='$invSize'";} ?> type="number" required></label><br>
           
           <label><span>Weight (Lbs): </span><br><input name="invWeight" id="invWeight" <?php if(isset($invWeight)){echo "value='$invWeight'";} ?> type="number" required></label><br>
           
           <label><span>Location: </span><br><input name="invLocation" id="invLocation" <?php if(isset($invLocation)){echo "value='$invLocation'";} ?> type="text" required></label><br>
           
           <label><span>Vendor: </span><br><input name="invVendor" id="invVendor" <?php if(isset($invVendor)){echo "value='$invVendor'";} ?> type="text" required></label><br>
           
           <label><span>Style: </span><br><input name="invStyle" id="invStyle" <?php if(isset($invStyle)){echo "value='$invStyle'";} ?> type="text" required></label><br><br>
        
        <input type="submit" name="submit" value="Add Product" class="registerbtn">
        
         <input type="hidden" name="action" value="newProd">
        
        
        
    
    
    
    </form>   
  
    
  <footer>
     <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
     Last Updated: <?php echo date('j F, Y', getlastmod()) ?>
             
        </footer>
     </main>
    </body>

    
</html>

