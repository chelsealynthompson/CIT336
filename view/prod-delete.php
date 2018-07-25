<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}
?>
<!doctype html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";} ?> | Acme, Inc.</title>
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
 
<h1><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";} ?></h1>
<p>Confirm Product Deletion. The delete is permanent.</p>
<?php
    if (isset($_POST{'submit'})) {
     echo "<div class='message'>$message</div>";
}
?>
<form method="post" action="/acme/products/">
 <fieldset>

    <label for="invName"><span>Product Name</span></label>
  <input type="text" readonly name="invName" id="invName" <?php if(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>>

  <label for="invDescription"><span>Product Description</span></label>
  <textarea name="invDescription" readonly id="invDescription"><?php if(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; } ?></textarea>

  <label>&nbsp;</label> 
  <input type="submit" class="regbtn" name="submit" value="Delete Product">

  <input type="hidden" name="action" value="deleteProd">
  <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} ?>">

 </fieldset>
</form> 
  
    
  <footer>
     <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
     Last Updated: <?php echo date('j F, Y', getlastmod()) ?>
             
        </footer>
     </main>
    </body>
    </html>