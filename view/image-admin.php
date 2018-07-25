
<?php
if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}
?><!doctype html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Image Management</title>
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

<h1>Image Management</h1>
<h2>Welcome to the image management page. Choose one of the options presented below.</h2><br>	  
 
<h2>Add New Product Image</h2>
<?php
 if (isset($message)) {
  echo $message;
 } ?>

<form action="/acme/uploads/" method="post" enctype="multipart/form-data">
 <label for="invItem">Product</label><br>
 <?php echo $prodSelect; ?><br><br>
 <label>Upload Image:</label><br>
 <input type="file" name="file1"><br>
 <input type="submit" class="regbtn" value="Upload">
 <input type="hidden" name="action" value="upload">
</form>
<hr>

<h2>Existing Images</h2>
<p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>

  <footer>
     <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
     Last Updated: <?php echo date('j F, Y', getlastmod()) ?>
             
        </footer>
     </main> 
    </body>

    
</html>
<?php unset($_SESSION['message']); ?>
